<?php

namespace App\Entity\Contact;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 * @ORM\Table(name="firm")
 */
class Firm extends AContact
{
    /**
     * @ORM\ManyToOne(targetEntity="FirmType")
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id")
     */
    protected $type = null;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="integer", unique=true)
     */
    protected $code;

    /**
     * @ORM\Column(type="integer", unique=true, nullable=true)
     */
    protected $ipn;

    /**
     * @var FirmAddress
     * @ORM\OneToMany(targetEntity="FirmAddress", mappedBy="firm")
     */
    protected $addresses;

    /**
     * @ORM\OneToMany(targetEntity="FirmPerson", mappedBy="firm")
     */
    protected $persons;

    public function __construct()
    {

        $this->addresses = new ArrayCollection();
        $this->persons = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param int $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return int
     */
    public function getIpn()
    {
        return $this->ipn;
    }

    /**
     * @param int $ipn
     */
    public function setIpn($ipn)
    {
        $this->ipn = $ipn;
    }

    /**
     * @return ArrayCollection
     */
    public function getAddresses()
    {
        return $this->addresses;
    }

    /**
     * @param FirmAddress $firmAddress
     * @return Firm
     */
    public function addAddress($firmAddress)
    {
        if ($this->addresses->contains($firmAddress)) {
            return $this;
        }

        if ($this->addresses->add($firmAddress)) {
            $firmAddress->setFirm($this);
        }

        return $this;
    }

    /**
     * @param FirmAddress $firmAddress
     * @return Firm
     */
    public function removeAddress($firmAddress)
    {
        if (!$this->addresses->contains($firmAddress)) {
            return $this;
        }

        if ($this->addresses->removeElement($firmAddress)) {
            $firmAddress->setFirm(null);
        }

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getPersons()
    {
        return $this->persons;
    }

    /**
     * @param FirmPerson $firmPerson
     * @return Firm
     */
    public function addPerson($firmPerson)
    {
        if ($this->persons->contains($firmPerson)) {
            return $this;
        }

        if ($this->persons->add($firmPerson)) {
            $firmPerson->setFirm($this);
        }

        return $this;
    }

    /**
     * @param FirmPerson $firmPerson
     * @return Firm
     */
    public function removePerson($firmPerson)
    {
        if (!$this->persons->contains($firmPerson)) {
            return $this;
        }

        if ($this->persons->removeElement($firmPerson)) {
            $firmPerson->setFirm(null);
        }

        return $this;
    }
}