<?php

namespace App\EventSubscriber;

use App\Event\AfterSubmitPostEvent;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use App\Repository\PostMetaRepository;

class SavePostEventSubscriber implements EventSubscriberInterface {

    public static function getSubscribedEvents() {
        return array(
            KernelEvents::RESPONSE => array(
                array('onKernelResponsePre', 10),
                array('onKernelResponsePost', -10),
            ),
            AfterSubmitPostEvent::NAME => 'onPostSave',
        );
    }

    public function onKernelResponsePre(FilterResponseEvent $event) {
        
    }

    public function onKernelResponsePost(FilterResponseEvent $event) {
        
    }

    public function onPostSave(AfterSubmitPostEvent $event) {
        $post_id = $event->getPost();
        $event->setPost($post_id);
    }

}
