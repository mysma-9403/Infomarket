<?php

namespace AppBundle\Listener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class DoctrineExtensionListener implements ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function onLateKernelRequest(GetResponseEvent $event)
    {
//         $translatable = $this->container->get('gedmo.listener.translatable');
//         $translatable->setTranslatableLocale($event->getRequest()->getLocale());
    }
    
    public function onConsoleCommand()
    {
//         $this->container->get('gedmo.listener.translatable')
//             ->setTranslatableLocale($this->container->get('translator')->getLocale());
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
    	$authorization = $this->container->get('security.authorization_checker', ContainerInterface::NULL_ON_INVALID_REFERENCE);
    	$tokenStorage = $this->container->get('security.token_storage', ContainerInterface::NULL_ON_INVALID_REFERENCE);
        if (null !== $tokenStorage && null !== $tokenStorage->getToken() && $authorization->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
//             $loggable = $this->container->get('gedmo.listener.loggable');
//             $loggable->setUsername($securityContext->getToken()->getUsername());
        	
            $blameable = $this->container->get('gedmo.listener.blameable');
            $blameable->setUserValue($tokenStorage->getToken()->getUser());
        }
    }
}