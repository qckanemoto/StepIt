<?php

namespace Steppie\Bundle\AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model\Timestampable\Timestampable;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Matter
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Steppie\Bundle\AppBundle\Entity\Repository\MatterRepository")
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
     * @Assert\NotBlank()
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var string[]
     *
     * @ORM\Column(name="owners", type="simple_array", length=65535, nullable=true)
     */
    private $owners;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Choice(callback="getStateChoices")
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
     * @var MatterType
     *
     * @ORM\ManyToOne(targetEntity="MatterType", inversedBy="matters")
     * @ORM\JoinColumn(name="matter_type_id", referencedColumnName="id", nullable=true)
     */
    private $matterType;

    /**
     * @var Content[]|Collection
     *
     * @ORM\OneToMany(targetEntity="Content", mappedBy="matter", cascade={"all"})
     */
    private $contents;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->state = self::STATE_OPEN;
        $this->contents = new ArrayCollection;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $name
     * @return Matter
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $description
     * @return Matter
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string[] $owners
     * @return Matter
     */
    public function setOwners(array $owners)
    {
        $this->owners = $owners;

        return $this;
    }

    /**
     * @return string[]
     */
    public function getOwners()
    {
        return $this->owners;
    }

    /**
     * @param string $state
     * @return Matter
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set project
     *
     * @param Project $project
     * @return Matter
     */
    public function setProject(Project $project)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * Get project
     *
     * @return Project
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * Set matterType
     *
     * @param MatterType $matterType
     * @return Matter
     */
    public function setMatterType(MatterType $matterType = null)
    {
        $this->matterType = $matterType;

        return $this;
    }

    /**
     * Get matterType
     *
     * @return MatterType
     */
    public function getMatterType()
    {
        return $this->matterType;
    }

    /**
     * @param Content $content
     * @return Matter
     */
    public function addContent(Content $content)
    {
        $this->contents[] = $content;

        return $this;
    }

    /**
     * @param Content $content
     */
    public function removeContent(Content $content)
    {
        $this->contents->removeElement($content);
    }

    /**
     * @return Collection
     */
    public function getContents()
    {
        return $this->contents;
    }

    /**
     * @return array
     */
    public static function getStateChoices()
    {
        return [
            self::STATE_OPEN,
            self::STATE_CLOSED,
        ];
    }
}
