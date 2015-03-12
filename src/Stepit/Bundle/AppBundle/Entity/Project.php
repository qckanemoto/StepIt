<?php

namespace Stepit\Bundle\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model\Timestampable\Timestampable;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Project
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Stepit\Bundle\AppBundle\Entity\Repository\ProjectRepository")
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
     * @var Step[]
     *
     * @ORM\OneToMany(targetEntity="Step", mappedBy="project")
     */
    private $steps;

    /**
     * @var Matter[]
     *
     * @ORM\OneToMany(targetEntity="Matter", mappedBy="project")
     */
    private $matters;


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
     * @return Project
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
     * @return Project
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
     * @param Step[] $steps
     */
    public function setSteps($steps)
    {
        $this->steps = $steps;
    }

    /**
     * @return Step[]
     */
    public function getSteps()
    {
        return $this->steps;
    }

    /**
     * @param Matter[] $matters
     */
    public function setMatters($matters)
    {
        $this->matters = $matters;
    }

    /**
     * @return Matter[]
     */
    public function getMatters()
    {
        return $this->matters;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }
}
