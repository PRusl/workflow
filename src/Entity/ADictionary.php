<?php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class ADirectory
 * @ORM\MappedSuperclass()
 *
 */
abstract class ADictionary {

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="guid")
     */
    protected $id;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=255)
     */
    protected $name;

    /**
     * @ORM\ManyToOne(targetEntity="ADictionary")
     * @ORM\JoinColumn(name="owner_id", referencedColumnName="id")
     */
    protected $owner = null;

    protected $subordinates = null;


    public function __construct() {
        $this->subordinates = new ArrayCollection();
    }

    /**
     * @return ArrayCollection
     */
    public function getSubordinates() {
        return $this->subordinates;
    }

    /**
     * @param ADictionary $subordinate
     * @return $this
     */
    public function setSubordinates($subordinate) {
        $this->subordinates[] = $subordinate;

        if ($subordinate->getOwner() !== $this) {
            $subordinate->setOwner($this);
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param string $name
     * @return ADictionary
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * @return ADictionary
     */
    public function getOwner() {
        return $this->owner;
    }

    /**
     * @param ADictionary $owner
     * @return ADictionary
     */
    public function setOwner($owner) {
        $this->owner = $owner;

        return $this;
    }

    /**
     * @return string
     */
    public function __toString() {
        return $this->name;
    }
}
