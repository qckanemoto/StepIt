<?php

namespace Steppie\Bundle\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model\Timestampable\Timestampable;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Content
 *
 * @ORM\Table(uniqueConstraints={
 *   @ORM\UniqueConstraint(name="content_matter_step_index", columns={"matter_id", "step_id"})
 * })
 * @ORM\Entity(repositoryClass="Steppie\Bundle\AppBundle\Entity\Repository\ContentRepository")
 * @ORM\EntityListeners({"Steppie\Bundle\AppBundle\EntityListener\ContentListener"})
 */
class Content
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
     * @var Matter
     *
     * @ORM\ManyToOne(targetEntity="Matter", inversedBy="contents")
     * @ORM\JoinColumn(name="matter_id", referencedColumnName="id", nullable=false)
     */
    private $matter;

    /**
     * @var Step
     *
     * @ORM\ManyToOne(targetEntity="Step", inversedBy="contents")
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
     * @return Content
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
     * Set matter
     *
     * @param Matter $matter
     * @return Content
     */
    public function setMatter(Matter $matter)
    {
        $this->matter = $matter;

        return $this;
    }

    /**
     * Get matter
     *
     * @return Matter
     */
    public function getMatter()
    {
        return $this->matter;
    }

    /**
     * Set step
     *
     * @param Step $step
     * @return Content
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
