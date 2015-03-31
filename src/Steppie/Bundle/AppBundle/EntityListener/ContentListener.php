<?php

namespace Steppie\Bundle\AppBundle\EntityListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Steppie\Bundle\AppBundle\Entity\Content;
use Steppie\Bundle\AppBundle\Entity\Matter;

class ContentListener
{
    public function postPersist(Content $content, LifecycleEventArgs $event)
    {
        $em = $event->getEntityManager();

        $matter = $content->getMatter();
        $project = $matter->getProject();

        if (count($project->getSteps()) === count($matter->getContents())) {
            $matter->setState(Matter::STATE_CLOSED);
            $em->persist($matter);
            $em->flush();
        }
    }
}
