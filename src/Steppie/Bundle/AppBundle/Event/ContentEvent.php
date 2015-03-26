<?php

namespace Steppie\Bundle\AppBundle\Event;

use Steppie\Bundle\AppBundle\Entity\Content;
use Symfony\Component\EventDispatcher\Event;

class ContentEvent extends Event
{
    /**
     * @var Content
     */
    private $content;

    /**
     * @param Content $content
     */
    public function __construct(Content $content)
    {
        $this->content = $content;
    }

    /**
     * @return Content
     */
    public function getContent()
    {
        return $this->content;
    }
}
