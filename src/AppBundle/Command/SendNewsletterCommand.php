<?php

namespace AppBundle\Command;

use AppBundle\Entity\Assignments\NewsletterUserNewsletterPageAssignment;
use AppBundle\Repository\Admin\Assignments\NewsletterUserNewsletterPageAssignmentRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\LockHandler;

class SendNewsletterCommand extends ContainerAwareCommand {

	protected function configure() {
		$this->setName('krk:newsletter:send')->setDescription(
				'Send newsletter for not sent newsletter user - page assignments and update their states.')->setHelp(
				'Send newsletter for not sent newsletter user - page assignments and update their states. Possible assignments states:
				- waiting
				- sending
				- sent
				- error');
		
		$this->addOption('package_size', null, InputOption::VALUE_REQUIRED, 'Package size', 100);
		$this->addOption('timeout', null, InputOption::VALUE_REQUIRED, 'Timeout [s]', 280);
		$this->addOption('sleep_time', null, InputOption::VALUE_REQUIRED, 'Sleep time [us]', 50000);
	}

	protected function execute(InputInterface $input, OutputInterface $output) {
		$lockHandler = new LockHandler('newsletter.lock');
		if (! $lockHandler->lock()) {
			return 0;
		}
		
		$packageSize = $input->getOption('package_size');
		$timeout = $input->getOption('timeout');
		$sleepTime = $input->getOption('sleep_time');
		
		set_error_handler(self::class . '::exception_error_handler');
		
		$commandStart = new \DateTime();
		
		$container = $this->getContainer();
		
		$doctrine = $container->get('doctrine');
		$sender = $container->getParameter('mailer_user');
		
		/** @var \Swift_Mailer $mailer */
		$mailer = $container->get('mailer');
		
		/** @var NewsletterUserNewsletterPageAssignmentRepository $repository */
		$repository = $doctrine->getRepository(NewsletterUserNewsletterPageAssignment::class);
		$assignments = $repository->findBy(
				['state' => NewsletterUserNewsletterPageAssignment::WAITING_STATE], null, $packageSize);
		
		$assignmentsCount = count($assignments);
		if ($assignmentsCount > 0) {
			$output->writeln('//------------------------------------------------------------------------------');
			$this->logMessage($output, 'Start sending mails: ' . $assignmentsCount . '.');
			
			/** @var ObjectManager $em */
			$em = $doctrine->getManager();
			
			$sentCount = 0;
			$errorCount = 0;
			foreach ($assignments as $assignment) {
				/** @var NewsletterUserNewsletterPageAssignment $assignment */
				
				$assignment->setState(NewsletterUserNewsletterPageAssignment::SENDING_STATE);
				$em->persist($assignment);
				
				$user = $assignment->getNewsletterUser();
				$page = $assignment->getNewsletterPage();
				
				$start = new \DateTime();
				
				try {
					// create message
					$message = \Swift_Message::newInstance()->setSubject($page->getDisplayName())->setFrom(
							$sender, 'InfoMarket')->setTo($user->getName());
					
					// embed images
					$body = $assignment->getNewsletterPage()->getNewsletterCode();
					
					if ($assignment->getEmbedImages()) {
						$newBody = $body;
						
						while (true) {
							$index = strpos($body, 'src="http://infomarket.edu.pl');
							if ($index == false)
								break;
							
							$body = substr($body, $index + 5);
							
							$index = strpos($body, '"');
							if ($index == false)
								break;
							
							$path = substr($body, 0, $index);
							$body = substr($body, $index + 1);
							
							$embededPath = $message->embed(\Swift_Image::fromPath($path));
							$newBody = str_replace($path, $embededPath, $newBody);
							$body = str_replace($path, '', $body);
						}
						
						$body = $newBody;
					}
					
					$message->setBody($body, 'text/html');
					
					// send
					$mailer->send($message);
					$sentCount ++;
				} catch (\Swift_TransportException $ex) {
					$this->logMessage($output, 
							'Cannot send mail to \'' . $assignment->getNewsletterUser()->getName() .
									 '\' due to Swiftmailer transport error: ' . $ex->getMessage() . '.');
					$errorCount ++;
				} catch (\Swift_RfcComplianceException $ex) {
					$this->logMessage($output, 
							'Cannot send mail to \'' . $assignment->getNewsletterUser()->getName() .
									 '\' due to Swiftmailer RFC compliance error: ' . $ex->getMessage() . '.');
					$errorCount ++;
				} catch (\Swift_SwiftException $ex) {
					$this->logMessage($output, 
							'Cannot send mail to \'' . $assignment->getNewsletterUser()->getName() .
									 '\' due to Swiftmailer error: ' . $ex->getMessage() . '.');
					$errorCount ++;
				} catch (\Exception $ex) {
					$this->logMessage($output, 
							'Cannot send mail to \'' . $assignment->getNewsletterUser()->getName() .
									 '\' due to unknown error: ' . $ex->getMessage() . '.');
					$errorCount ++;
				}
				
				$end = new \DateTime();
				
				$interval = date_diff($start, $end);
				$processingTime = new \DateTime('0000-01-01');
				$processingTime->add($interval);
				
				$assignment->setProcessingTime($processingTime);
				$assignment->setState(NewsletterUserNewsletterPageAssignment::SENT_STATE);
				$em->persist($assignment);
				
				$commandInterval = $end->getTimestamp() - $commandStart->getTimestamp();
				
				if ($commandInterval > $timeout) {
					break;
				}
				
				usleep($sleepTime);
			}
			$em->flush();
			
			$this->logMessage($output, 
					'Newsletter sending finished. Successfully sent: ' . $sentCount . ' / Ended with error: ' .
							 $errorCount . '.');
		}
		
		$lockHandler->release();
	}

	protected function logMessage(OutputInterface $output, $message) {
		$date = new \DateTime();
		$output->writeln($date->format('Y-m-d H:i:s: ') . $message);
	}

	public static function exception_error_handler($severity, $message, $file, $line) {
		if (! (error_reporting() & $severity)) {
			return;
		}
		throw new \ErrorException($message, 0, $severity, $file, $line);
	}
}
