<?php

namespace Stepit\Bundle\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model\Timestampable\Timestampable;

/**
 * Matter
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Stepit\Bundle\AppBundle\Entity\Repository\MatterRepository")
 */
class Matter
{
    use Timestampable;

    const STATE_OPEN = 'open';
    const STATE_CLOSED = 'closed';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string[]
     *
     * @ORM\Column(name="owners", type="simple_array", length=65535, nullable=true)
     */
    private $owners;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255, nullable=true)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="state", type="string", length=255)
     */
    private $state;

    /**
     * @var Project
     *
     * @ORM\ManyToOne(targetEntity="Project", inversedBy="matters")
     * @ORM\JoinColumn(name="project_id", referencedColumnName="id", nullable=false)
     */
    private $project;

    /**
     * @var Content[]
     *
     * @ORM\OneToMany(targetEntity="Content", mappedBy="matter")
     */
    private $contents;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Matter
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set owners
     *
     * @param string[] $owners
     * @return Matter
     */
    public function setOwners(array $owners)
    {
        $this->owners = $owners;

        return $this;
    }

    /**
     * Get owners
     *
     * @return string[]
     */
    public function getOwners()
    {
        return $this->owners;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Matter
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set state
     *
     * @param string $state
     * @return Matter
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param Project $project
     */
    public function setProject($project)
    {
        $this->project = $project;
    }

    /**
     * @return Project
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * @param Content[] $contents
     */
    public function setContents($contents)
    {
        $this->contents = $contents;
    }

    /**
     * @return Content[]
     */
    public function getContents()
    {
        return $this->contents;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }
}
