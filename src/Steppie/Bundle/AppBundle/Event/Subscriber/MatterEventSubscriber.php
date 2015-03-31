<?php

namespace Steppie\Bundle\AppBundle\Event\Subscriber;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Steppie\Bundle\AppBundle\Entity\Content;
use Steppie\Bundle\AppBundle\Entity\Matter;

class MatterEventSubscriber implements EventSubscriber
{
    /**
     * {@inheritdoc}
     */
    public function getSubscribedEvents()
    {
        return [
            'postPersist',
        ];
    }

    public function postPersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if (! $entity instanceof Matter) {
            return;
        }

        $em = $args->getEntityManager();

        $defaultContents = $em->getRepository('SteppieAppBundle:DefaultContent')->findBy([
            'matterType' => $entity->getMatterType(),
        ]);

        foreach ($defaultContents as $defaultContent) {
            $content = new Content;
            $content
                ->setMatter($entity)
                ->setStep($defaultContent->getStep())
                ->setValue($defaultContent->getValue())
            ;
            $em->persist($content);
        }
        $em->flush();
    }
}
