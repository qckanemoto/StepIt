<?php

namespace Steppie\Bundle\AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Knp\DoctrineBehaviors\Model\Timestampable\Timestampable;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Project
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Steppie\Bundle\AppBundle\Entity\Repository\ProjectRepository")
 */
class Project
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
     * @var Step[]|Collection
     *
     * @ORM\OneToMany(targetEntity="Step", mappedBy="project", cascade={"all"})
     *
     * @Serializer\Exclude()
     */
    private $steps;

    /**
     * @var Matter[]|Collection
     *
     * @ORM\OneToMany(targetEntity="Matter", mappedBy="project", cascade={"all"})
     *
     * @Serializer\Exclude()
     */
    private $matters;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->steps = new ArrayCollection;
        $this->matters = new ArrayCollection;
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
     * @return Project
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
     * @return Project
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
     * @param Step $step
     * @return Project
     */
    public function addStep(Step $step)
    {
        $this->steps[] = $step;

        return $this;
    }

    /**
     * @param Step $step
     */
    public function removeStep(Step $step)
    {
        $this->steps->removeElement($step);
    }

    /**
     * @return Collection
     */
    public function getSteps()
    {
        return $this->steps;
    }

    /**
     * @param Matter $matter
     * @return Project
     */
    public function addMatter(Matter $matter)
    {
        $this->matters[] = $matter;

        return $this;
    }

    /**
     * @param Matter $matter
     */
    public function removeMatter(Matter $matter)
    {
        $this->matters->removeElement($matter);
    }

    /**
     * @return Collection
     */
    public function getMatters()
    {
        return $this->matters;
    }
}
