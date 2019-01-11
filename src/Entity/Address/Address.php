<?php
namespace App\Entity\Address;

use App\Entity\Contact\FirmAddress;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 * @ORM\Table(name="addresses")
 */
class Address extends AAddress {

    const FLOOR_NAME  = 'floor';

    /**
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="Building", inversedBy="subordinates")
     * @ORM\JoinColumn(name="owner_id", referencedColumnName="id")
     */
    protected $owner = null;

    protected $name = ' ';

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Contact\FirmAddress", mappedBy="address")
     */
    protected $firms;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    protected $floor;

    /**
     * @ORM\ManyToOne(targetEntity="FloorType")
     * @ORM\JoinColumn(name="floor_type_id", referencedColumnName="id")
     */
    protected $floorType = null;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    protected $apartment;

    /**
     * @ORM\ManyToOne(targetEntity="ApartmentType")
     * @ORM\JoinColumn(name="apartment_type_id", referencedColumnName="id")
     */
    protected $apartmentType = null;

    protected $building;
    protected $street;
    protected $sector;
    protected $settlement;
    protected $district;
    protected $region;
    protected $country;

    public function __construct() {
        parent::__construct();

        $this->firms = new ArrayCollection();
    }

    /**
     * @return ArrayCollection
     */
    public function getFirms() {
        return $this->firms;
    }

    /**
     * @param FirmAddress $firmAddress
     * @return Address
     */
    public function addFirm($firmAddress) {
        if ($this->firms->contains($firmAddress)) {
            return $this;
        }

        if ($this->firms->add($firmAddress)) {
            $firmAddress->setAddress($this);
        }

        return $this;
    }

    /**
     * @param FirmAddress $firmAddress
     * @return Address
     */
    public function removeFirm($firmAddress) {
        if (!$this->firms->contains($firmAddress)) {
            return $this;
        }

        if ($this->firms->removeElement($firmAddress)) {
            $firmAddress->setAddress(null);
        }

        return $this;
    }

    public function getAddressComponents() {
        $this->building   = $this->getOwner();
        $this->street     = $this->building ? $this->building->getOwner() : null;
        $this->sector     = $this->street ? $this->street->getOwner() : null;
        $this->settlement = $this->sector ? $this->sector->getOwner() : null;
        $this->district   = $this->settlement ? $this->settlement->getOwner() : null;
        $this->region     = $this->district ? $this->district->getOwner() : null;
        $this->country    = $this->region ? $this->region->getOwner() : null;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getApartment() {
        return $this->apartment;
    }

    /**
     * @param mixed $apartment
     */
    public function setApartment($apartment) {
        $this->apartment = $apartment;
    }

    /**
     * @return ApartmentType
     */
    public function getApartmentType() {
        return $this->apartmentType;
    }

    /**
     * @param ApartmentType $apartmentType
     */
    public function setApartmentType($apartmentType) {
        $this->apartmentType = $apartmentType;
    }

    /**
     * @return string
     */
    public function getFloor() {
        return $this->floor;
    }

    /**
     * @param string $floor
     */
    public function setFloor($floor) {
        $this->floor = $floor;
    }

    /**
     * @return Building
     */
    public function getBuilding() {
        if (!isset($this->building)) {
            $this->getAddressComponents();
        }

        return $this->building;
    }

    /**
     * @return Street
     */
    public function getStreet() {
        if (!isset($this->street)) {
            $this->getAddressComponents();
        }

        return $this->street;
    }

    /**
     * @return Sector
     */
    public function getSector() {
        if (!isset($this->sector)) {
            $this->getAddressComponents();
        }

        return $this->sector;
    }

    /**
     * @return Settlement
     */
    public function getSettlement() {
        if (!isset($this->settlement)) {
            $this->getAddressComponents();
        }

        return $this->settlement;
    }

    /**
     * @return District
     */
    public function getDistrict() {
        if (!isset($this->district)) {
            $this->getAddressComponents();
        }

        return $this->district;
    }

    /**
     * @return Region
     */
    public function getRegion() {
        if (!isset($this->region)) {
            $this->getAddressComponents();
        }

        return $this->region;
    }

    /**
     * @return Country
     */
    public function getCountry() {
        if (!isset($this->country)) {
            $this->getAddressComponents();
        }

        return $this->country;
    }

    /**
     * @return string
     */
    public function getZip() {
        return ($this->getBuilding() ? $this->getBuilding()->getZip() : null)
            ?? ($this->getSettlement() ? $this->getSettlement()->getZip() : null)
            ?? '';
    }

    /**
     * @return FloorType
     */
    public function getFloorType() {
        return $this->floorType;
    }

    /**
     * @param FloorType $floorType
     */
    public function setFloorType($floorType) {
        $this->floorType = $floorType;
    }

    /**
     * @return string
     */
    protected function getApartmentWithType() {
        $apartmentType = $this->getApartmentType()
            ? $this->getApartmentType()->getShortName() . ' '
            : '';

        $apartment = $this->getApartment();

        return isset($apartment)
            ? $apartmentType . $apartment
            : '';
    }

    /**
     * @return string
     */
    protected function getFloorWithType() {
        $parts = [
            $this->getFloor(),
            $this->getFloorType(),
        ];

        return implode(' ', array_filter($parts));
    }

    /**
     * @return string
     */
    public function getMailingAddress() {
        $zip = $this->getZip();
        $zip = isset($zip) ? "$zip " : '';

        $apartment = $this->getApartmentWithType();
        $apartment = isset($apartment) ? ", $apartment" : '';

        return $this->getOwner()
            ? $zip . $this->getOwner()->getMailingAddress() . $apartment
            : '';
    }

    /**
     * @return string
     */
    public function getRoadAddress() {
        $floor = $this->getFloorWithType();
        $floor = isset($floor) ? ", $floor" : '';

        $apartment = $this->getApartmentWithType();
        $apartment = $apartment ? ", $apartment" : '';

        return $this->getOwner()
            ? $this->getOwner()->getRoadAddress() . $floor . $apartment
            : '';
    }
}