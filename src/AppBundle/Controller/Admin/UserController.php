<?php

namespace AppBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\User;

class SegmentController extends Controller
{
	public function showAction(User $entry)
	{
		return $this->render('admin/user/show.html.twig', array('entry' => $entry));
	}
	
	public function newAction(Request $request)
	{
		return $this->editAction($request, new User());
	}
	
	public function copyAction(Request $request, User $template)
	{
		$entry = new User();
		$entry->setName($template->getName());
		
		return $this->editAction($request, $entry);
	}
	
	public function editAction(Request $request, User $entry)
	{
		$form = $this->createForm(UserType::class, $entry);
		
		$form->handleRequest($request);
		
		if ($form->isSubmitted() && $form->isValid())
		{
			$em = $this->getDoctrine()->getManager();
				
			$em->persist($entry);
			$em->flush();
				
			$this->addFlash('success', 'user.created_successfully');
		
			if ($form->get('saveAndNew')->isClicked()) {
				return $this->redirectToRoute('admin_users_new');
			}
		
			if ($form->get('saveAndCopy')->isClicked()) {
				return $this->redirectToRoute('admin_users_copy', array('id' => $entry->getId()));
			}
		
			return $this->redirectToRoute('admin_users');
		}
		
		return $this->render('admin/user/editor.html.twig', array('form' => $form->createView()));
	}
	
	public function deleteAction(Request $request, User $entry)
	{
		$em = $this->getDoctrine()->getManager();
		
		$em->remove($entry);
		$em->flush();
	
		return $this->redirectToRoute('admin_users');
	}
	
	public function deleteSelectedAction(Request $request)
	{
		
	}
}