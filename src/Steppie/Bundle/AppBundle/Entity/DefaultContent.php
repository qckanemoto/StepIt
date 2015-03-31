<?php

namespace Steppie\Bundle\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model\Timestampable\Timestampable;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * DefaultContent
 *
 * @ORM\Table(uniqueConstraints={
 *   @ORM\UniqueConstraint(name="defaultcontent_mattertype_step_index", columns={"matter_type_id", "step_id"})
 * })
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
     * @ORM\Column(name="value", type="string", length=255)
     */
    private $value;

    /**
     * @var MatterType
     *
     * @ORM\ManyToOne(targetEntity="MatterType", inversedBy="defaultContents")
     * @ORM\JoinColumn(name="matter_type_id", referencedColumnName="id", nullable=false)
     */
    private $matterType;

    /**
     * @var Step
     *
     * @ORM\ManyToOne(targetEntity="Step", inversedBy="defaultContents")
     * @ORM\JoinColumn(name="step_id", referencedColumnName="id", nullable=false)
     */
    private $step;


    /**
     * @return string
     */
    public function __toString()
    {
        return $this->value;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
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
     * Set matterType
     *
     * @param MatterType $matterType
     * @return DefaultContent
     */
    public function setMatterType(MatterType $matterType)
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
     * Set step
     *
     * @param Step $step
     * @return DefaultContent
     */
    public function setStep(Step $step)
    {
        $this->step = $step;

        return $this;
    }

    /**
     * Get step
     *
     * @return Step
     */
    public function getStep()
    {
        return $this->step;
    }
}
