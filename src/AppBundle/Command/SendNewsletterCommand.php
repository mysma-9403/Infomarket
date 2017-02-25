<?php

namespace AppBundle\Command;

use AppBundle\Entity\NewsletterUserNewsletterPageAssignment;
use AppBundle\Repository\Admin\Assignments\NewsletterUserNewsletterPageAssignmentRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\LockHandler;

class SendNewsletterCommand extends ContainerAwareCommand
{	
	protected function configure()
	{
		$this
		->setName('krk:newsletter:send')
		->setDescription('Send newsletter for not sent newsletter user - page assignments and update their states.')
		->setHelp('Send newsletter for not sent newsletter user - page assignments and update their states. Possible assignments states:
				- waiting
				- sending
				- sent
				- error')
		;
	}
	
	protected function execute(InputInterface $input, OutputInterface $output)
	{	
		$lockHandler = new LockHandler('newsletter.lock');
		if (!$lockHandler->lock()) {
			return 0;
		}
		
		$container = $this->getContainer();
		
		$doctrine = $container->get('doctrine');
		$sender = $container->getParameter('mailer_user');
		
		/** @var \Swift_Mailer $mailer */
		$mailer = $container->get('mailer');
		
		/** @var ObjectManager $em */
		$em = $doctrine->getManager();
		
		/** @var NewsletterUserNewsletterPageAssignmentRepository $repository */
		$repository = $doctrine->getRepository(NewsletterUserNewsletterPageAssignment::class);
		$assignments = $repository->findBy(['state' => NewsletterUserNewsletterPageAssignment::WAITING_STATE]);
		
		$assignmentsCount = count($assignments); 
		if($assignmentsCount > 0) {
			$output->writeln('//------------------------------------------------------------------------------');
			$this->logMessage($output, 'Start sending mails: ' . $assignmentsCount . '.');
			
			$sentCount = 0;
			$errorCount = 0;
			foreach ($assignments as $assignment) {
				/** @var NewsletterUserNewsletterPageAssignment $assignment */
				
				$assignment->setState(NewsletterUserNewsletterPageAssignment::SENDING_STATE);
				$em->persist($assignment);
				$em->flush();
				
				$user = $assignment->getNewsletterUser();
				$page = $assignment->getNewsletterPage();
				
				$start = new \DateTime();
				
				//create message
				$message = \Swift_Message::newInstance()
				->setSubject($page->getDisplayName())
				->setFrom($sender, 'InfoMarket')
				->setTo($user->getName());
		
				//embed images
				$body = $assignment->getNewsletterPage()->getNewsletterCode();
		
				if($assignment->getEmbedImages()) {
					$newBody = $body;
			
					while(true) {
						$index = strpos($body, 'src="http://infomarket.edu.pl');
						if($index == false) break;
		
						$body = substr($body, $index+5);
		
						$index = strpos($body, '"');
						if($index == false) break;
		
						$path = substr($body, 0, $index);
						$body = substr($body, $index+1);
		
						$filePath = str_replace('http://infomarket.edu.pl/', 'web/', $path);
						$embededPath = $message->embed(\Swift_Image::fromPath($filePath));
						$newBody = str_replace($path, $embededPath, $newBody);
						$body = str_replace($path, '', $body);
					}
			
					$body = $newBody;
				}
		
				$message->setBody($body, 'text/html');
		
				//send
				try {
					$mailer->send($message);
					$sentCount++;
				} catch(\Swift_TransportException $e) {
					$this->logMessage($output, 'Cannot send mail to ' . $assignment->getNewsletterUser()->getName() . 
							' due to the following error: ' . $e->getMessage() . '.');
					$errorCount++;
				}
				
				$end = new \DateTime();
				
				$interval = date_diff($start, $end);
				$processingTime = new \DateTime('0000-01-01');
				$processingTime->add($interval);
				
				$assignment->setProcessingTime($processingTime);
				$assignment->setState(NewsletterUserNewsletterPageAssignment::SENT_STATE);
				$em->persist($assignment);
				$em->flush();
			}
			
			$this->logMessage($output, 'Newsletter sending finished. Successfully sent: ' . $sentCount . 
					' / Ended with error: ' . $errorCount . '.');
		}
		
		$lockHandler->release();
	}
	
	protected function logMessage(OutputInterface $output, $message) {
		$date = new \DateTime();
		$output->writeln($date->format('Y-m-d h:i:s: ') . $message);
	}
}
