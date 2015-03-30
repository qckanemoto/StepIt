<?php

namespace Steppie\Bundle\AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model\Timestampable\Timestampable;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Step
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Steppie\Bundle\AppBundle\Entity\Repository\StepRepository")
 */
class Step
{
    use Timestampable;

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
     * @var string
     *
     * @ORM\Column(name="link", type="string", length=255, nullable=true)
     */
    private $link;

    /**
     * @var integer
     *
     * @Assert\NotBlank()
     * @Assert\Type("int")
     *
     * @ORM\Column(name="sequence", type="integer")
     */
    private $sequence;

    /**
     * @var Project
     *
     * @ORM\ManyToOne(targetEntity="Project", inversedBy="steps")
     * @ORM\JoinColumn(name="project_id", referencedColumnName="id", nullable=false)
     */
    private $project;

    /**
     * @var Content[]|Collection
     *
     * @ORM\OneToMany(targetEntity="Content", mappedBy="step", cascade={"all"})
     */
    private $contents;

    /**
     * @var DefaultContent[]|Collection
     *
     * @ORM\OneToMany(targetEntity="DefaultContent", mappedBy="step", cascade={"all"})
     */
    private $defaultContents;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->contents = new ArrayCollection;
        $this->defaultContents = new ArrayCollection;
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
     * @return Step
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
     * @return Step
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
     * @param string $link
     * @return Step
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @param integer $sequence
     * @return Step
     */
    public function setSequence($sequence)
    {
        $this->sequence = $sequence;

        return $this;
    }

    /**
     * @return integer
     */
    public function getSequence()
    {
        return $this->sequence;
    }

    /**
     * Set project
     *
     * @param Project $project
     * @return Step
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
     * @param Content $content
     * @return Step
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
     * @param DefaultContent $defaultContent
     * @return Step
     */
    public function addDefaultContent(DefaultContent $defaultContent)
    {
        $this->defaultContents[] = $defaultContent;

        return $this;
    }

    /**
     * @param DefaultContent $defaultContent
     */
    public function removeDefaultContent(DefaultContent $defaultContent)
    {
        $this->defaultContents->removeElement($defaultContent);
    }

    /**
     * @return Collection
     */
    public function getDefaultContents()
    {
        return $this->defaultContents;
    }
}
