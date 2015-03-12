<?php

namespace Stepit\Bundle\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model\Timestampable\Timestampable;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Step
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Stepit\Bundle\AppBundle\Entity\Repository\StepRepository")
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
     * @var Content[]
     *
     * @ORM\OneToMany(targetEntity="Content", mappedBy="step")
     */
    private $contents;

    /**
     * @var DefaultContent[]
     *
     * @ORM\OneToMany(targetEntity="DefaultContent", mappedBy="step")
     */
    private $defaultContents;


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
     * @return Step
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
     * Set description
     *
     * @param string $description
     * @return Step
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set link
     *
     * @param string $link
     * @return Step
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link
     *
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set sequence
     *
     * @param integer $sequence
     * @return Step
     */
    public function setSequence($sequence)
    {
        $this->sequence = $sequence;

        return $this;
    }

    /**
     * Get sequence
     *
     * @return integer
     */
    public function getSequence()
    {
        return $this->sequence;
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
     * @param DefaultContent[] $defaultContents
     */
    public function setDefaultContents($defaultContents)
    {
        $this->defaultContents = $defaultContents;
    }

    /**
     * @return DefaultContent[]
     */
    public function getDefaultContents()
    {
        return $this->defaultContents;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }
}
