<?php

namespace Steppie\Bundle\AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Knp\DoctrineBehaviors\Model\Timestampable\Timestampable;

/**
 * MatterType
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Steppie\Bundle\AppBundle\Entity\Repository\MatterTypeRepository")
 */
class MatterType
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var Matter[]|Collection
     *
     * @ORM\OneToMany(targetEntity="Matter", mappedBy="matterType", cascade={"all"})
     *
     * @Serializer\Exclude()
     */
    private $matters;

    /**
     * @var DefaultContent[]|Collection
     *
     * @ORM\OneToMany(targetEntity="DefaultContent", mappedBy="matterType", cascade={"all"})
     *
     * @Serializer\Exclude()
     */
    private $defaultContents;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->defaultContents = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }

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
     * @return MatterType
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
     * Add matters
     *
     * @param Matter $matters
     * @return MatterType
     */
    public function addMatter(Matter $matter)
    {
        $this->matters[] = $matter;

        return $this;
    }

    /**
     * Remove matters
     *
     * @param Matter $matters
     */
    public function removeMatter(Matter $matter)
    {
        $this->matters->removeElement($matter);
    }

    /**
     * Get matters
     *
     * @return Collection
     */
    public function getMatters()
    {
        return $this->matters;
    }

    /**
     * Add defaultContents
     *
     * @param DefaultContent $defaultContent
     * @return MatterType
     */
    public function addDefaultContent(DefaultContent $defaultContent)
    {
        $this->defaultContents[] = $defaultContent;

        return $this;
    }

    /**
     * Remove defaultContents
     *
     * @param DefaultContent $defaultContent
     */
    public function removeDefaultContent(DefaultContent $defaultContent)
    {
        $this->defaultContents->removeElement($defaultContent);
    }

    /**
     * Get defaultContents
     *
     * @return Collection
     */
    public function getDefaultContents()
    {
        return $this->defaultContents;
    }
}
