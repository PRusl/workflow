<?php

namespace App\Entity\Contact;

use App\Entity\Address\Address;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="firm_address")
 */
class FirmAddress extends AType
{

    /**
     * @ORM\ManyToOne(targetEntity="Firm", inversedBy="addresses", cascade={"all"})
     * @ORM\JoinColumn(name="firm_id", referencedColumnName="id")
     */
    protected $firm;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Address\Address", inversedBy="firms", cascade={"all"})
     * @ORM\JoinColumn(name="address_id", referencedColumnName="id")
     */
    protected $address;

    /**
     * @return Firm
     */
    public function getFirm()
    {
        return $this->firm;
    }

    /**
     * @param Firm $firm
     * @return FirmAddress
     */
    public function setFirm($firm)
    {
        $this->firm = $firm;

        return $this;
    }

    /**
     * @return Address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param Address $address
     * @return FirmAddress
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    public function __toString()
    {
        return $this->getAddress() . ' (' . parent::__toString() . ') ' . $this->getFirm();
    }
}