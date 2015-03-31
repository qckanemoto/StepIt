<?php

namespace Steppie\Bundle\AppBundle\EntityListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Steppie\Bundle\AppBundle\Entity\Content;
use Steppie\Bundle\AppBundle\Entity\Matter;

class MatterListener
{
    public function postPersist(Matter $matter, LifecycleEventArgs $event)
    {
        $em = $event->getEntityManager();

        $defaultContents = $em->getRepository('SteppieAppBundle:DefaultContent')->findBy([
            'matterType' => $matter->getMatterType(),
        ]);

        foreach ($defaultContents as $defaultContent) {
            $existing = $em->getRepository('SteppieAppBundle:Content')->findOneBy([
                'matter' => $matter,
                'step' => $defaultContent->getStep(),
            ]);

            if ($existing) {
                continue;
            }

            $content = new Content;
            $content
                ->setMatter($matter)
                ->setStep($defaultContent->getStep())
                ->setValue($defaultContent->getValue())
            ;
            $em->persist($content);
        }
        $em->flush();
    }
}
