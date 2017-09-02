<?php

namespace AppBundle\Controller\Admin\Main;

use AppBundle\Controller\Admin\Base\FeaturedEntityController;
use AppBundle\Entity\Article;
use AppBundle\Entity\ArticleCategory;
use AppBundle\Entity\ArticleTagAssignment;
use AppBundle\Entity\Brand;
use AppBundle\Entity\Category;
use AppBundle\Entity\Other\ArticleTagAssignments;
use AppBundle\Entity\Tag;
use AppBundle\Entity\User;
use AppBundle\Factory\Common\Choices\Bool\FeaturedChoicesFactory;
use AppBundle\Factory\Common\Choices\Bool\InfomarketChoicesFactory;
use AppBundle\Factory\Common\Choices\Bool\InfoproduktChoicesFactory;
use AppBundle\Factory\Common\Choices\Enum\ArticleImageSizesFactory;
use AppBundle\Factory\Common\Choices\Enum\ArticleLayoutsFactory;
use AppBundle\Filter\Common\Main\ArticleFilter;
use AppBundle\Form\Editor\Admin\Main\ArticleEditorType;
use AppBundle\Form\Filter\Admin\Main\ArticleFilterType;
use AppBundle\Form\Lists\Base\FeaturedEntityListType;
use AppBundle\Form\Other\ArticleTagAssignmentsType;
use AppBundle\Manager\Entity\Base\EntityManager;
use AppBundle\Manager\Filter\Base\FilterManager;
use AppBundle\Manager\Params\EntryParams\Admin\ArticleEntryParamsManager;
use AppBundle\Repository\Admin\Main\TagRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Manager\Entity\Common\Main\ArticleManager;

class ArticleController extends FeaturedEntityController {
	
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
	
	/**
	 * 
	 * @param Request $request
	 * @param integer $id
	 * 
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function setFeaturedAction(Request $request, $id)
	{
		return $this->setFeaturedActionInternal($request, $id);
	}
	
	/**
	 * 
	 * @param Request $request
	 * @param integer $id
	 * 
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function previewAction(Request $request, $id, $page)
	{
		return $this->previewActionInternal($request, $id, $page);
	}
	
	
	//---------------------------------------------------------------------------
	// Internal actions
	//---------------------------------------------------------------------------
	
	/**
	 *
	 * @param Request $request
	 * @param integer $id current entry ID
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	protected function previewActionInternal(Request $request, $id, $page)
	{
		$params = $this->createParams($this->getPreviewRoute());
		$params = $this->getPreviewParams($request, $params, $id, $page);
	
		$rm = $this->getRouteManager();
		$rm->register($request, $params['route'], $params['routeParams']);
	
		return $this->render($this->getPreviewView(), $params['viewParams']);
	}
	
	//---------------------------------------------------------------------------
	// Actions blocks
	//---------------------------------------------------------------------------
	
	protected function initEditForms(Request $request, array &$params) {
		$response = parent::initEditForms($request, $params);
		if($response) return $response;
		
		$response = $this->initTagAssignmentsForm($request, $params);
		if($response) return $response;
		
		return null;
	}
	
	protected function initTagAssignmentsForm(Request $request, array &$params) {
		$viewParams = $params['viewParams'];
		$article= $viewParams['entry'];
	
		$entry = new ArticleTagAssignments();
		$entry->setArticle($article);
		
		$form = $this->createForm(ArticleTagAssignmentsType::class, $entry, $this->getTagAssignmentsFormOptions());
	
		$form->handleRequest($request);
	
		if ($form->isSubmitted() && $form->isValid())
		{	
			/** @var ObjectManager $em */
			$em = $this->getDoctrine()->getManager();
			
			/** @var TagRepository $tagRepository */
			$tagRepository = $this->getDoctrine()->getRepository(Tag::class);
			$tags = $entry->getTags();
			
			$assignedCount = 0;
			$existingCount = 0;
			$createdCount = 0;
			
			if(count($tags) > 0) {
				$assignedTags = $tagRepository->findAssignedIds($article->getId(), $tags);
				
				foreach ($tags as $tag) {
					if(in_array($tag, $assignedTags)) {
						$existingCount++;
					} else {
						$assignment = new ArticleTagAssignment();
						$assignment->setArticle($article);
						$assignment->setTag($em->getReference(Tag::class, $tag));
						
						$em->persist($assignment);
						
						$assignedCount++;
					}
				}
				$em->flush();
			}
			
			$words = $entry->getTagsString();
			
			if(count($words) > 0) {
				$words = array_map('trim', explode(',', $words));
				$words = array_map('strtolower', $words);
				
				$tagNames = array();
				foreach ($words as $word) {
					$tagNames[$word] = $word;
				}
				
				$existingTags = $tagRepository->findItemsByNames($tagNames);
				$assignedTags = array();
				if(count($existingTags) > 0) {
					$existingTagsIds = $tagRepository->getIds($existingTags);
					$assignedTags = $tagRepository->findAssignedIds($article->getId(), $existingTagsIds);
					
					foreach ($existingTags as $tag) {
						$id = $tag['id'];
						$name = $tag['name'];
						if(in_array($id, $tags)) {
							$key = array_search(strtolower($name), $tagNames);
							unset($tagNames[$key]);
						} else if(in_array($id, $assignedTags)) {
							$key = array_search(strtolower($name), $tagNames);
							unset($tagNames[$key]);
					
							$existingCount++;
						} else {
							$key = array_search(strtolower($name), $tagNames);
							unset($tagNames[$key]);
					
							$assignment = new ArticleTagAssignment();
							$assignment->setArticle($article);
							$assignment->setTag($em->getReference(Tag::class, $id));
					
							$em->persist($assignment);
								
							$assignedCount++;
						}
					}
					$em->flush();
				}
				
				foreach ($tagNames as $tagName) {
					$tagName = trim($tagName);
					if(strlen($tagName) > 0) {
						$item = new Tag();
						$item->setName($tagName);
						$item->setInfomarket(true);
						$item->setInfoprodukt(true);
						
						$em->persist($item);
						$em->flush();
						
						$assignment = new ArticleTagAssignment();
						$assignment->setArticle($article);
						$assignment->setTag($item);
						
						$em->persist($assignment);
						$em->flush();
						
						$createdCount++;
					}
				}
			}
			
			$translator = $this->get('translator');
			
			$message = $translator->trans('success.article.tagsAssigned');
			$message = nl2br($message);
			
			$message = str_replace('%existingCount%', $existingCount, $message);
			$message = str_replace('%assignedCount%', $assignedCount, $message);
			$message = str_replace('%createdCount%', $createdCount, $message);
			
			$this->addFlash('success', $message);
		}
	
		$viewParams['tagAssignmentsForm'] = $form->createView();
		$params['viewParams'] = $viewParams;
	
		return null;
	}
	
	//---------------------------------------------------------------------------
	// Internal logic
	//---------------------------------------------------------------------------
	
	protected function getListItemKeyFields($item) {
		$fields = parent::getListItemKeyFields($item);
	
		$fields[] = $item['subname'];
	
		return $fields;
	}
	
	protected function getFilterFormOptions() {
		$options = parent::getFilterFormOptions();
	
		$this->addEntityChoicesFormOption($options, Brand::class, 'brands');
		$this->addEntityChoicesFormOption($options, Category::class, 'categories');
		$this->addEntityChoicesFormOption($options, ArticleCategory::class, 'articleCategories');
	
		$this->addFactoryChoicesFormOption($options, InfomarketChoicesFactory::class, 'infomarket');
		$this->addFactoryChoicesFormOption($options, InfoproduktChoicesFactory::class, 'infoprodukt');
		$this->addFactoryChoicesFormOption($options, FeaturedChoicesFactory::class, 'featured');
		
		return $options;
	}
	
	protected function getEditorFormOptions() {
		$options = parent::getEditorFormOptions();
		
		$this->addEntityChoicesFormOption($options, Article::class, 'parent');
		$this->addEntityChoicesFormOption($options, User::class, 'author');
		
		$this->addFactoryChoicesFormOption($options, ArticleImageSizesFactory::class, 'imageSize');
		$this->addFactoryChoicesFormOption($options, ArticleLayoutsFactory::class, 'layout');
		
		return $options;
	}
	
	protected function getTagAssignmentsFormOptions() {
		$options = [];
		
		$this->addEntityChoicesFormOption($options, Tag::class, 'tags');
		
		return $options;
	}
	
	//---------------------------------------------------------------------------
	// Params
	//---------------------------------------------------------------------------
	
	protected function getPreviewParams(Request $request, array $params, $id, $page) {
		$params = $this->getParams($request, $params);
	
		$em = $this->getEntryParamsManager();
		$params = $em->getPreviewParams($request, $params, $id, $page);
	
		return $params;
	}
	
	//---------------------------------------------------------------------------
	// Managers
	//---------------------------------------------------------------------------
	
	protected function getInternalEntryParamsManager(EntityManager $em, FilterManager $fm, $doctrine) {
		return new ArticleEntryParamsManager($em, $fm, $doctrine);
	}
	
	protected function getEntityManager($doctrine, $paginator) {
		return $this->get(ArticleManager::class);
	}
	
	protected function getFilterManager($doctrine) {
		return new FilterManager(new ArticleFilter());
	}
	
	//---------------------------------------------------------------------------
	// Internal logic
	//---------------------------------------------------------------------------
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\AdminEntityController::deleteMore()
	 */
	protected function deleteMore($entry)
	{
		$em = $this->getDoctrine()->getManager();
		
		foreach ($entry->getArticleArticleCategoryAssignments() as $articleArticleCategoryAssignment) {
			$em->remove($articleArticleCategoryAssignment);
		}
		$em->flush();
		
		foreach ($entry->getArticleCategoryAssignments() as $articleCategoryAssignment) {
			$em->remove($articleCategoryAssignment);
		}
		$em->flush();
		
		foreach ($entry->getArticleBrandAssignments() as $articleBrandAssignment) {
			$em->remove($articleBrandAssignment);
		}
		$em->flush();
		
		foreach ($entry->getArticleTagAssignments() as $articleTagAssignment) {
			$em->remove($articleTagAssignment);
		}
		$em->flush();
		
		foreach ($entry->getChildren() as $subentry) {
			$this->deleteMore($subentry);
			$em->remove($subentry);
		}
		$em->flush();
		
		return array();
	}
	
	//------------------------------------------------------------------------
	// Entity type related
	//------------------------------------------------------------------------
	
	protected function getEntityType() {
		return Article::class;
	}
	
	//------------------------------------------------------------------------
	// Forms
	//------------------------------------------------------------------------
	
	protected function getEditorFormType() {
		return ArticleEditorType::class;
	}
	
	protected function getFilterFormType() {
		return ArticleFilterType::class;
	}
	
	protected function getListFormType() {
		return FeaturedEntityListType::class;
	}
	
	//---------------------------------------------------------------------------
	// Roles
	//---------------------------------------------------------------------------
	
	protected function getDeleteRole() {
		return 'ROLE_EDITOR';
	}
	
	//---------------------------------------------------------------------------
	// Views
	//---------------------------------------------------------------------------
	protected function getPreviewView()
	{
		return $this->getDomain() . '/' . $this->getEntityName() . '/preview.html.twig';
	}
	
	//---------------------------------------------------------------------------
	// Routes
	//---------------------------------------------------------------------------
	protected function getPreviewRoute()
	{
		return $this->getIndexRoute() . '_preview';
	}
}