<?php
namespace App\Entity\Contact;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\MappedSuperclass()
 *
 */
abstract class AContact
{

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
    protected $shortName;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=255)
     */
    protected $fullName;

    protected $type = null;

    /**
     * @return string
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getShortName() {
        return $this->shortName;
    }

    /**
     * @param string $shortName
     */
    public function setShortName($shortName) {
        $this->shortName = $shortName;
    }

    /**
     * @return string
     */
    public function getFullName() {
        return $this->fullName;
    }

    /**
     * @param string $fullName
     */
    public function setFullName($fullName) {
        $this->fullName = $fullName;
    }

    /**
     * @return AType
     */
    public function getType() {
        return $this->type;
    }

    /**
     * @param AType $type
     */
    public function setType($type) {
        $this->type = $type;
    }

    public function __toString() {
        return $this->getShortName();
    }
}