<?php

namespace AppBundle\Controller\Admin\Main;

use AppBundle\Controller\Admin\Base\SimpleEntityController;
use AppBundle\Entity\NewsletterPage;
use AppBundle\Entity\NewsletterPageTemplate;
use AppBundle\Entity\NewsletterUser;
use AppBundle\Entity\NewsletterUserNewsletterPageAssignment;
use AppBundle\Filter\Admin\Main\NewsletterPageFilter;
use AppBundle\Filter\Admin\Other\SendNewsletterFilter;
use AppBundle\Form\Editor\Main\NewsletterPageEditorType;
use AppBundle\Form\Filter\Admin\Main\NewsletterPageFilterType;
use AppBundle\Form\Filter\Admin\Other\SendNewsletterFilterType;
use AppBundle\Manager\Entity\Base\EntityManager;
use AppBundle\Manager\Entity\Common\NewsletterPageManager;
use AppBundle\Manager\Filter\Base\FilterManager;
use AppBundle\Manager\Params\EntryParams\Admin\NewsletterPageEntryParamsManager;
use AppBundle\Repository\Admin\Main\NewsletterPageTemplateRepository;
use AppBundle\Repository\Admin\Main\NewsletterUserRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class NewsletterPageController extends SimpleEntityController {
	
	//---------------------------------------------------------------------------
	// Actions
	//---------------------------------------------------------------------------
	
	/**
	 *
	 * @param Request $request
	 * @param integer $page
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function indexAction(Request $request, $page)
	{
		return $this->indexActionInternal($request, $page);
	}
	
	/**
	 *
	 * @param Request $request
	 * @param integer $id
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function showAction(Request $request, $id)
	{
		return $this->showActionInternal($request, $id);
	}
	
	/**
	 *
	 * @param Request $request
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function newAction(Request $request)
	{
		return $this->newActionInternal($request);
	}
	
	/**
	 *
	 * @param Request $request
	 * @param integer $id
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function copyAction(Request $request, $id)
	{
		return $this->copyActionInternal($request, $id);
	}
	
	/**
	 *
	 * @param Request $request
	 * @param integer $id
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function editAction(Request $request, $id)
	{
		return $this->editActionInternal($request, $id);
	}
	
	/**
	 *
	 * @param Request $request
	 * @param integer $id
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function deleteAction(Request $request, $id)
	{
		return $this->deleteActionInternal($request, $id);
	}
	
	/**
	 * 
	 * @param Request $request
	 * @param integer $id
	 * 
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function setIMPublishedAction(Request $request, $id)
	{
		return $this->setIMPublishedActionInternal($request, $id);
	}
	
	/**
	 *
	 * @param Request $request
	 * @param integer $id
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function setIPPublishedAction(Request $request, $id)
	{
		return $this->setIPPublishedActionInternal($request, $id);
	}
	
	
	
	public function previewAction(Request $request, $id)
	{
		return $this->previewActionInternal($request, $id);
	}
	
	public function saveFileAction(Request $request, $id)
	{
		return $this->saveFileActionInternal($request, $id);
	}
	
	public function sendNewsletterFormAction(Request $request, $id)
	{
		return $this->sendNewsletterFormActionInternal($request, $id);
	}
	
	public function sendNewsletterListAction(Request $request, $id)
	{
		return $this->sendNewsletterListActionInternal($request, $id);
	}
	
	public function sendNewsletterAction(Request $request, $id)
	{
		return $this->sendNewsletterActionInternal($request, $id);
	}
	
	//---------------------------------------------------------------------------
	// Actions internal
	//---------------------------------------------------------------------------
	
	protected function previewActionInternal(Request $request, $id)
	{
		/** @var NewsletterPage $entry */
		$entry = $this->getEntry($id);
		
		if($entry) {
			$response = new StreamedResponse();
			
			$response->setCallback(function() use (&$entry) {
				$handle = fopen('php://output', 'w+');
				
				fputs($handle, $entry->getNewsletterCode());
			
				fclose($handle);
			});
			
			$response->setStatusCode(200);
			$response->headers->set('Content-Type', 'text/html; charset=utf-8');
		
			return $response;
		} else {
			//TODO error
			return $this->redirectToReferer($request);
		}
	}
	
	protected function saveFileActionInternal(Request $request, $id)
	{
		/** @var NewsletterPage $entry */
		$entry = $this->getEntry($id);
		
		if($entry) {
			$response = new StreamedResponse();
			
			$response->setCallback(function() use (&$entry) {
				$handle = fopen('php://output', 'w+');
				
				fputs($handle, $entry->getNewsletterCode());
			
				fclose($handle);
			});
			
			$fileName = $entry->getDisplayName() . '.html';
			
			$response->setStatusCode(200);
			$response->headers->set('Content-Type', 'text/html; charset=utf-8');
			$response->headers->set('Content-Disposition', 'attachment; filename="' . $fileName . '"');
		
			return $response;
		} else {
			//TODO error
			return $this->redirectToReferer($request);
		}
	}
	
	protected function sendNewsletterFormActionInternal(Request $request, $id)
	{
		$this->denyAccessUnlessGranted($this->getEditRole(), null, 'Unable to access this page!');
		
		$params = $this->createParams($this->getSendNewsletterFormRoute());
		$params = $this->getSendNewsletterFormParams($request, $params, $id);
		
		$rm = $this->getRouteManager();
		$rm->register($request, $params['route'], $params['routeParams']);
		
		$am = $this->getAnalyticsManager();
		$am->sendPageviewAnalytics($params['domain'], $params['route']);
		
		
		$viewParams = $params['viewParams'];
		
		
		$filter = $viewParams['sendNewsletterFilter'];
		
		$filterForm = $this->createForm(SendNewsletterFilterType::class, $filter);
		$filterForm->handleRequest($request);
		
		if ($filterForm->isSubmitted() && $filterForm->isValid()) {
				
			if ($filterForm->get('submit')->isClicked()) {
				$newParams = $filter->getRequestValues();
				$newParams['id'] = $id;
				return $this->redirectToRoute($this->getSendNewsletterListRoute(), $newParams);
			}
		}
		
		$viewParams['sendNewsletterFilterForm'] = $filterForm->createView();
		
		
		return $this->render($this->getSendNewsletterFormView(), $viewParams);
	}
	
	protected function sendNewsletterListActionInternal(Request $request, $id)
	{
		$this->denyAccessUnlessGranted($this->getEditRole(), null, 'Unable to access this page!');
		
		$params = $this->createParams($this->getSendNewsletterListRoute());
		$params = $this->getSendNewsletterListParams($request, $params, $id);
		
		$rm = $this->getRouteManager();
		$rm->register($request, $params['route'], $params['routeParams']);
		
		$am = $this->getAnalyticsManager();
		$am->sendPageviewAnalytics($params['domain'], $params['route']);
		
		
		$viewParams = $params['viewParams'];
		
		
		return $this->render($this->getSendNewsletterListView(), $viewParams);
	}
	
	protected function sendNewsletterActionInternal(Request $request, $id)
	{
		$this->denyAccessUnlessGranted($this->getEditRole(), null, 'Unable to access this page!');
		
		$params = $this->createParams($this->getSendNewsletterRoute());
		$params = $this->getSendNewsletterParams($request, $params, $id);
		
		$rm = $this->getRouteManager();
		$rm->register($request, $params['route'], $params['routeParams']);
		
		$am = $this->getAnalyticsManager();
		$am->sendPageviewAnalytics($params['domain'], $params['route']);
		
		
		$viewParams = $params['viewParams'];
		
		/** @var NewsletterPage $entry */
		$entry = $viewParams['entry'];
		
		/** @var SendNewsletterFilter $sendNewsletterFilter */
		$sendNewsletterFilter = $viewParams['sendNewsletterFilter'];
		
		$recipients = $viewParams['recipients'];
		$bcc = array();
		$bccIds = array();
		foreach($recipients as $recipient) {
			$bcc[] = $recipient['name'];
			$bccIds[] = $recipient['id'];
		}
		
		//get existing assignments
		/** @var ObjectManager $em */
		$em = $this->getDoctrine()->getManager();
		$newsletterUserRepository = new NewsletterUserRepository($em, $em->getClassMetadata(NewsletterUser::class));
		$secondTimeRecipientsIds = $newsletterUserRepository->findItemsIdsByNewsletterPage($bccIds, $id);
		
		//remove second timers
		if(!$sendNewsletterFilter->getForceSend()) {
			foreach ($secondTimeRecipientsIds as $secondTimeRecipientId) {
				if(($key = array_search($secondTimeRecipientId, $bccIds)) !== false) {
					unset($bccIds[$key]);
					unset($bcc[$key]);
				}	
			}
			
			$secondCount = 0;
		} else {
			$secondCount = count($secondTimeRecipientsIds);
		}
		
		$totalCount = count($bcc);
		$firstCount = $totalCount - $secondCount;
		
		$sender = $this->container->getParameter('newsletter_sender');
		$recipient = $this->container->getParameter('newsletter_recipient');
		
		//send
		$message = \Swift_Message::newInstance()
		->setSubject('Newsletter send test')
		->setFrom($sender, 'InfoMarket')
		->setTo($recipient, 'InfoMarket')
		->setBcc($bcc);
		
		//embed images
		$body = $entry->getNewsletterCode();
		
		if($sendNewsletterFilter->getEmbedImages()) {
			$newBody = $body;
			
			while(true) {
				$index = strpos($body, 'src="http://infomarket.edu.pl');
				if($index == false) break;
				
				$body = substr($body, $index+5);
				
				$index = strpos($body, '"');
				if($index == false) break;
				
				$path = substr($body, 0, $index);
				$body = substr($body, $index+1);
				
				$filePath = str_replace('http://infomarket.edu.pl/', '../web/', $path);
				$embededPath = $message->embed(\Swift_Image::fromPath($filePath));
				$newBody = str_replace($path, $embededPath, $newBody);
				$body = str_replace($path, '', $body);
			}
			
			$body = $newBody;
		}
		
		$message->setBody($body, 'text/html');
	
		$this->get('mailer')->send($message);
		
		//insert assignments
		foreach ($bccIds as $bccId) {
			if(array_search($bccId, $secondTimeRecipientsIds) === false) {
				$assignment = new NewsletterUserNewsletterPageAssignment();
				$assignment->setNewsletterUser($em->getReference(NewsletterUser::class, $bccId));
				$assignment->setNewsletterPage($em->getReference(NewsletterPage::class, $id));
				
				$em->persist($assignment);
			}
		}
		
		$em->flush();
		
		//success message
		
		
		$translator = $this->get('translator');
			
		$msg = $translator->trans('success.newsletterPage.newsletterSent');
		$msg = nl2br($msg);
			
		$msg = str_replace('%firstCount%', $firstCount, $msg);
		$msg = str_replace('%secondCount%', $secondCount, $msg);
		$msg = str_replace('%totalCount%', $totalCount, $msg);
		$this->addFlash('success', $msg);
	
		return $this->redirectToReferer($request);
	}
	
	//---------------------------------------------------------------------------
	// Internal logic
	//---------------------------------------------------------------------------
	
	protected function getSendNewsletterFormParams(Request $request, array $params, $id) {
		$params = $this->getShowParams($request, $params, $id);
	
		$em = $this->getEntryParamsManager();
		$params = $em->getSendNewsletterFormParams($request, $params, $id);
	
		return $params;
	}
	
	protected function getSendNewsletterListParams(Request $request, array $params, $id) {
		$params = $this->getShowParams($request, $params, $id);
	
		$em = $this->getEntryParamsManager();
		$params = $em->getSendNewsletterListParams($request, $params, $id);
	
		return $params;
	}
	
	protected function getSendNewsletterParams(Request $request, array $params, $id) {
		$params = $this->getShowParams($request, $params, $id);
	
		$em = $this->getEntryParamsManager();
		$params = $em->getSendNewsletterParams($request, $params, $id);
	
		return $params;
	}
	
	protected function getFormOptions() {
		$options = parent::getFormOptions();
	
		/** @var NewsletterPageTemplateRepository $newsletterPageTemplateRepository */
		$newsletterPageTemplateRepository = $this->getDoctrine()->getRepository(NewsletterPageTemplate::class);
		$options['newsletterPageTemplates'] = $newsletterPageTemplateRepository->findFilterItems();
	
		return $options;
	}
	
	//---------------------------------------------------------------------------
	// Managers
	//---------------------------------------------------------------------------
	
	protected function getInternalEntryParamsManager(EntityManager $em, FilterManager $fm, $doctrine) {
		return new NewsletterPageEntryParamsManager($em, $fm, $doctrine);
	}
	
	protected function getEntityManager($doctrine, $paginator) {
		return new NewsletterPageManager($doctrine, $paginator);
	}
	
	protected function getFilterManager($doctrine) {
		return new FilterManager(new NewsletterPageFilter());
	}
	
	//---------------------------------------------------------------------------
	// Roles
	//---------------------------------------------------------------------------
	protected function getShowRole() {
		return 'ROLE_ADMIN';
	}
	
	protected function getEditRole() {
		return 'ROLE_ADMIN';
	}
	
	//------------------------------------------------------------------------
	// EntityType related
	//------------------------------------------------------------------------
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\SimpleEntityController::getEntityType()
	 */
	protected function getEntityType() {
		return NewsletterPage::class;
	}
	
	
	//------------------------------------------------------------------------
	// Forms
	//------------------------------------------------------------------------
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\SimpleEntityController::getFormType()
	 */
	protected function getEditorFormType() {
		return NewsletterPageEditorType::class;
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\SimpleEntityController::getFilterFormType()
	 */
	protected function getFilterFormType() {
		return NewsletterPageFilterType::class;
	}
	
	//---------------------------------------------------------------------------
	// Views
	//---------------------------------------------------------------------------
	
	protected function getSendNewsletterFormView()
	{
		return $this->getDomain() . '/' . $this->getEntityName() . '/send_newsletter_form.html.twig';
	}
	
	protected function getSendNewsletterListView()
	{
		return $this->getDomain() . '/' . $this->getEntityName() . '/send_newsletter_list.html.twig';
	}
	
	//---------------------------------------------------------------------------
	// Routes
	//---------------------------------------------------------------------------
	
	protected function getSendNewsletterFormRoute()
	{
		return $this->getIndexRoute() . '_send_newsletter_form';
	}
	
	protected function getSendNewsletterListRoute()
	{
		return $this->getIndexRoute() . '_send_newsletter_list';
	}
	
	protected function getSendNewsletterRoute()
	{
		return $this->getIndexRoute() . '_send_newsletter';
	}
}