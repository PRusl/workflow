<?php

namespace App\Entity\Address;

use App\Entity\ADictionary;

abstract class AAddress extends ADictionary
{

    protected $type = null;

    /**
     * @return AAddress
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * @return AAddressType
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param AAddressType $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getShortName()
    {
        return $this->getType()
            ? $this->getType()->getShortName()
            : '';
    }

    /**
     * @return string
     */
    public function getFullName()
    {
        return $this->getShortName()
            ? $this->getShortName() . ' ' . $this->getName()
            : $this->getName();
    }

    /**
     * @return string
     */
    public function getMailingAddress()
    {
        return $this->getOwner()
            ? $this->getOwner()->getMailingAddress() . ', ' . $this->getFullName()
            : $this->getFullName();
    }

    /**
     * @return string
     */
    public function getRoadAddress()
    {
        return $this->getOwner() && $this->getOwner()->getRoadAddress()
            ? $this->getOwner()->getRoadAddress() . ', ' . $this->getFullName()
            : $this->getFullName();
    }

    public function __toString()
    {
        return $this->getRoadAddress();
    }
}