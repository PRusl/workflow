<?php
namespace App\Entity\Address;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="buildings")
 */
class Building extends AAddress {

    /**
     * @ORM\ManyToOne(targetEntity="Street", inversedBy="subordinates")
     * @ORM\JoinColumn(name="owner_id", referencedColumnName="id")
     */
    protected $owner = null;

    /**
     * @ORM\OneToMany(targetEntity="Address", mappedBy="owner")
     */
    protected $subordinates = null;

    /**
     * @ORM\ManyToOne(targetEntity="BuildingType")
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id")
     */
    protected $type = null;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    protected $zip;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    protected $publicName;

    /**
     * @return string
     */
    public function getZip() {
        return $this->zip;
    }

    /**
     * @param string $zip
     */
    public function setZip($zip) {
        $this->zip = $zip;
    }

    /**
     * @return string
     */
    public function getPublicName() {
        return $this->publicName;
    }

    /**
     * @param string $publicName
     */
    public function setPublicName($publicName) {
        $this->publicName = $publicName;
    }

    public function getRoadAddress() {
        return $this->getPublicName()
            ? parent::getRoadAddress() . ', ' . $this->getPublicName()
            : parent::getRoadAddress();
    }
}
