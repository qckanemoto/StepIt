<?php

namespace Stepit\Bundle\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DefaultContent
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Stepit\Bundle\AppBundle\Entity\DefaultContentRepository")
 */
class DefaultContent
{
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
     * @ORM\Column(name="matter_type", type="string", length=255)
     */
    private $matterType;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="string", length=255)
     */
    private $value;


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
     * Set matterType
     *
     * @param string $matterType
     * @return DefaultContent
     */
    public function setMatterType($matterType)
    {
        $this->matterType = $matterType;

        return $this;
    }

    /**
     * Get matterType
     *
     * @return string 
     */
    public function getMatterType()
    {
        return $this->matterType;
    }

    /**
     * Set value
     *
     * @param string $value
     * @return DefaultContent
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string 
     */
    public function getValue()
    {
        return $this->value;
    }
}
