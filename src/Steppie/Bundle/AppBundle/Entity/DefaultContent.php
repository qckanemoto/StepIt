<?php

namespace Steppie\Bundle\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model\Timestampable\Timestampable;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * DefaultContent
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Steppie\Bundle\AppBundle\Entity\Repository\DefaultContentRepository")
 */
class DefaultContent
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
     * @ORM\Column(name="matter_type", type="string", length=255)
     */
    private $matterType;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     *
     * @ORM\Column(name="value", type="string", length=255)
     */
    private $value;

    /**
     * @var Step
     *
     * @ORM\ManyToOne(targetEntity="Step", inversedBy="default_contents")
     * @ORM\JoinColumn(name="step_id", referencedColumnName="id", nullable=false)
     */
    private $step;


    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $matterType
     * @return DefaultContent
     */
    public function setMatterType($matterType)
    {
        $this->matterType = $matterType;

        return $this;
    }

    /**
     * @return string
     */
    public function getMatterType()
    {
        return $this->matterType;
    }

    /**
     * @param string $value
     * @return DefaultContent
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param Step $step
     */
    public function setStep($step)
    {
        $this->step = $step;
    }

    /**
     * @return Step
     */
    public function getStep()
    {
        return $this->step;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->value;
    }
}
