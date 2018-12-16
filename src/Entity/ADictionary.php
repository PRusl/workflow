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
class ADictionary {

    const ENABLE_NAME = 'Увімкнено';

    const DEFAULT_NAME = 'За замовчуванням';

    const ENTITY_NAME = 'Довідники';

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="guid")
     */
    protected $id;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=255, unique=true)
     */
    protected $name;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $enable = true;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $useDefault = false;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $top = false;

    /**
     * @ORM\ManyToOne(targetEntity="ADirectory")
     * @ORM\JoinColumn(name="owner_id", referencedColumnName="id")
     */
    protected $owner = null;

    protected $subordinates = null;


    public function __construct() {
        $this->subordinates = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getSubordinates() {
        return $this->subordinates;
    }

    /**
     * @param mixed $subordinate
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
     * @return bool
     */
    public function isEnable() {
        return $this->enable;
    }

    /**
     * @param bool $enable
     */
    public function setEnable($enable) {
        $this->enable = $enable;
    }

    /**
     * @return bool
     */
    public function isUseDefault() {
        return $this->useDefault;
    }

    /**
     * @param bool $useDefault
     */
    public function setUseDefault($useDefault) {
        //todo: Create preUpdate Listener to set default only one
        $this->useDefault = $useDefault;
    }

    /**
     * @return mixed
     */
    public function getOwner() {
        return $this->owner;
    }

    /**
     * @param mixed $owner
     */
    public function setOwner($owner) {
        $this->owner = $owner;
    }

    /**
     * @return bool
     */
    public function isTop() {
        return $this->top;
    }

    /**
     * @param bool $top
     */
    public function setTop($top) {
        $this->top = $top;
    }
}
