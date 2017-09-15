<?php

namespace AppBundle\Controller\Admin\Main;

use AppBundle\Controller\Admin\Base\FeaturedController;
use AppBundle\Entity\Assignments\ArticleTagAssignment;
use AppBundle\Entity\Main\Article;
use AppBundle\Entity\Main\Tag;
use AppBundle\Entity\Other\ArticleTagAssignments;
use AppBundle\Filter\Common\Main\ArticleFilter;
use AppBundle\Form\Editor\Admin\Main\ArticleEditorType;
use AppBundle\Form\Filter\Admin\Main\ArticleFilterType;
use AppBundle\Form\Lists\Base\FeaturedListType;
use AppBundle\Form\Other\ArticleTagAssignmentsType;
use AppBundle\Manager\Entity\Base\EntityManager;
use AppBundle\Manager\Entity\Common\Main\ArticleManager;
use AppBundle\Manager\Filter\Base\FilterManager;
use AppBundle\Manager\Params\EntryParams\Admin\ArticleEntryParamsManager;
use AppBundle\Misc\FormOptions\FormOptionsProvider;
use AppBundle\Repository\Admin\Main\TagRepository;
use AppBundle\Repository\Infomarket\ArticleRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;

class ArticleController extends FeaturedController {
	
	// ---------------------------------------------------------------------------
	// Actions
	// ---------------------------------------------------------------------------
	/**
	 *
	 * @param Request $request        	
	 * @param integer $page        	
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function indexAction(Request $request, $page) {
		return $this->indexActionInternal($request, $page);
	}

	/**
	 *
	 * @param Request $request        	
	 * @param integer $id        	
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function showAction(Request $request, $id) {
		return $this->showActionInternal($request, $id);
	}

	/**
	 *
	 * @param Request $request        	
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function newAction(Request $request) {
		return $this->newActionInternal($request);
	}

	/**
	 *
	 * @param Request $request        	
	 * @param integer $id        	
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function copyAction(Request $request, $id) {
		return $this->copyActionInternal($request, $id);
	}

	/**
	 *
	 * @param Request $request        	
	 * @param integer $id        	
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function editAction(Request $request, $id) {
		return $this->editActionInternal($request, $id);
	}

	/**
	 *
	 * @param Request $request        	
	 * @param integer $id        	
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function deleteAction(Request $request, $id) {
		return $this->deleteActionInternal($request, $id);
	}

	/**
	 *
	 * @param Request $request        	
	 * @param integer $id        	
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function setIMPublishedAction(Request $request, $id) {
		return $this->setIMPublishedActionInternal($request, $id);
	}

	/**
	 *
	 * @param Request $request        	
	 * @param integer $id        	
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function setIPPublishedAction(Request $request, $id) {
		return $this->setIPPublishedActionInternal($request, $id);
	}

	/**
	 *
	 * @param Request $request        	
	 * @param integer $id        	
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function setFeaturedAction(Request $request, $id) {
		return $this->setFeaturedActionInternal($request, $id);
	}

	/**
	 *
	 * @param Request $request        	
	 * @param integer $id        	
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function previewAction(Request $request, $id, $page) {
		return $this->previewActionInternal($request, $id, $page);
	}
	
	// ---------------------------------------------------------------------------
	// Internal actions
	// ---------------------------------------------------------------------------
	
	/**
	 *
	 * @param Request $request        	
	 * @param integer $id
	 *        	current entry ID
	 *        	
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	protected function previewActionInternal(Request $request, $id, $page) {
		$params = $this->createParams($this->getPreviewRoute());
		$params = $this->getPreviewParams($request, $params, $id, $page);
		
		$rm = $this->getRouteManager();
		$rm->register($request, $params['route'], $params['routeParams']);
		
		return $this->render($this->getPreviewView(), $params['viewParams']);
	}
	
	// ---------------------------------------------------------------------------
	// Actions blocks
	// ---------------------------------------------------------------------------
	protected function initEditForms(Request $request, array &$params) {
		$response = parent::initEditForms($request, $params);
		if ($response)
			return $response;
		
		$response = $this->initTagAssignmentsForm($request, $params);
		if ($response)
			return $response;
		
		return null;
	}

	protected function initTagAssignmentsForm(Request $request, array &$params) {
		$viewParams = $params['viewParams'];
		$article = $viewParams['entry'];
		
		$entry = new ArticleTagAssignments();
		$entry->setArticle($article);
		
		$optionsProvider = $this->getTagAssignmentsFormOptionsProvider();
		$options = $optionsProvider->getFormOptions($params);
		
		$form = $this->createForm(ArticleTagAssignmentsType::class, $entry, $options);
		
		$form->handleRequest($request);
		
		if ($form->isSubmitted() && $form->isValid()) {
			/** @var ObjectManager $em */
			$em = $this->getDoctrine()->getManager();
			
			/** @var TagRepository $tagRepository */
			$tagRepository = $this->getDoctrine()->getRepository(Tag::class);
			$tags = $entry->getTags();
			
			$assignedCount = 0;
			$existingCount = 0;
			$createdCount = 0;
			
			if (count($tags) > 0) {
				$assignedTags = $tagRepository->findAssignedIds($article->getId(), $tags);
				
				foreach ($tags as $tag) {
					if (in_array($tag, $assignedTags)) {
						$existingCount ++;
					} else {
						$assignment = new ArticleTagAssignment();
						$assignment->setArticle($article);
						$assignment->setTag($em->getReference(Tag::class, $tag));
						
						$em->persist($assignment);
						
						$assignedCount ++;
					}
				}
				$em->flush();
			}
			
			$words = $entry->getTagsString();
			
			if (count($words) > 0) {
				$words = array_map('trim', explode(',', $words));
				$words = array_map('strtolower', $words);
				
				$tagNames = array();
				foreach ($words as $word) {
					$tagNames[$word] = $word;
				}
				
				$existingTags = $tagRepository->findItemsByNames($tagNames);
				$assignedTags = array();
				if (count($existingTags) > 0) {
					$existingTagsIds = $tagRepository->getIds($existingTags);
					$assignedTags = $tagRepository->findAssignedIds($article->getId(), $existingTagsIds);
					
					foreach ($existingTags as $tag) {
						$id = $tag['id'];
						$name = $tag['name'];
						if (in_array($id, $tags)) {
							$key = array_search(strtolower($name), $tagNames);
							unset($tagNames[$key]);
						} else if (in_array($id, $assignedTags)) {
							$key = array_search(strtolower($name), $tagNames);
							unset($tagNames[$key]);
							
							$existingCount ++;
						} else {
							$key = array_search(strtolower($name), $tagNames);
							unset($tagNames[$key]);
							
							$assignment = new ArticleTagAssignment();
							$assignment->setArticle($article);
							$assignment->setTag($em->getReference(Tag::class, $id));
							
							$em->persist($assignment);
							
							$assignedCount ++;
						}
					}
					$em->flush();
				}
				
				foreach ($tagNames as $tagName) {
					$tagName = trim($tagName);
					if (strlen($tagName) > 0) {
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
						
						$createdCount ++;
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
	
	// ---------------------------------------------------------------------------
	// Form options
	// ---------------------------------------------------------------------------
	protected function getFilterFormOptionsProvider() {
		return $this->get('app.misc.provider.form_options.filter.main.article');
	}

	protected function getEditorFormOptionsProvider() {
		return $this->get('app.misc.provider.form_options.editor.main.article');
	}

	/**
	 *
	 * @return FormOptionsProvider
	 */
	protected function getTagAssignmentsFormOptionsProvider() {
		return $this->get('app.misc.provider.form_options.other.article_tag_assignments');
	}
	
	// ---------------------------------------------------------------------------
	// Internal logic
	// ---------------------------------------------------------------------------
	protected function getListItemsProvider() {
		return $this->get('app.misc.provider.subname_list_items_provider');
	}
	
	// ---------------------------------------------------------------------------
	// Params
	// ---------------------------------------------------------------------------
	protected function getPreviewParams(Request $request, array $params, $id, $page) {
		$params = $this->getParams($request, $params);
		
		$em = $this->getEntryParamsManager();
		$params = $em->getPreviewParams($request, $params, $id, $page);
		
		return $params;
	}
	
	// ---------------------------------------------------------------------------
	// Managers
	// ---------------------------------------------------------------------------
	protected function getInternalEntryParamsManager(EntityManager $em, FilterManager $fm, $doctrine) {
		$articleRepository = $this->get(ArticleRepository::class);
		return new ArticleEntryParamsManager($em, $fm, $articleRepository);
	}

	protected function getEntityManager($doctrine, $paginator) {
		return $this->get(ArticleManager::class);
	}

	protected function getFilterManager($doctrine) {
		return new FilterManager(new ArticleFilter());
	}
	
	// ---------------------------------------------------------------------------
	// Internal logic
	// ---------------------------------------------------------------------------
	protected function deleteMore($entry) {
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
	
	// ------------------------------------------------------------------------
	// Entity type related
	// ------------------------------------------------------------------------
	protected function getEntityType() {
		return Article::class;
	}
	
	// ------------------------------------------------------------------------
	// Forms
	// ------------------------------------------------------------------------
	protected function getEditorFormType() {
		return ArticleEditorType::class;
	}

	protected function getFilterFormType() {
		return ArticleFilterType::class;
	}

	protected function getListFormType() {
		return FeaturedListType::class;
	}
	
	// ---------------------------------------------------------------------------
	// Roles
	// ---------------------------------------------------------------------------
	protected function getDeleteRole() {
		return 'ROLE_EDITOR';
	}
	
	// ---------------------------------------------------------------------------
	// Views
	// ---------------------------------------------------------------------------
	protected function getPreviewView() {
		return $this->getDomain() . '/' . $this->getEntityName() . '/preview.html.twig';
	}
	
	// ---------------------------------------------------------------------------
	// Routes
	// ---------------------------------------------------------------------------
	protected function getPreviewRoute() {
		return $this->getIndexRoute() . '_preview';
	}
}