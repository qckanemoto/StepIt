<?php

namespace Steppie\Bundle\AppBundle\Event\Subscriber;

use Doctrine\ORM\EntityManager;
use Steppie\Bundle\AppBundle\Entity\Matter;
use Steppie\Bundle\AppBundle\Event\ContentEvent;
use Steppie\Bundle\AppBundle\Event\ContentEventNames;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ContentEventSubscriber implements EventSubscriberInterface
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @param ContentEvent $event
     */
    public function onUpdated(ContentEvent $event)
    {
        $matter = $event->getContent()->getMatter();
        $project = $matter->getProject();

        if (count($project->getSteps()) === count($matter->getContents())) {
            $matter->setState(Matter::STATE_CLOSED);
            $this->em->persist($matter);
            $this->em->flush();
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            ContentEventNames::UPDATED => 'onUpdated',
        ];
    }
}
