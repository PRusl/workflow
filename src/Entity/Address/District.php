<?php

namespace App\Entity\Address;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="districts")
 */
class District extends AAddress
{

    /**
     * @ORM\ManyToOne(targetEntity="Region", inversedBy="subordinates")
     * @ORM\JoinColumn(name="owner_id", referencedColumnName="id")
     */
    protected $owner = null;

    /**
     * @ORM\OneToMany(targetEntity="Settlement", mappedBy="owner")
     */
    protected $subordinates = null;

    /**
     * @ORM\ManyToOne(targetEntity="DistrictType")
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id")
     */
    protected $type = null;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $showInAddress = true;

    /**
     * @return bool
     */
    public function isShowInAddress()
    {
        return (bool)$this->showInAddress;
    }

    /**
     * @param bool $showInAddress
     */
    public function setShowInAddress($showInAddress)
    {
        $this->showInAddress = $showInAddress;
    }

    /**
     * @return string
     */
    public function getFullName()
    {
        return $this->getShortName()
            ? $this->getName() . ' ' . $this->getShortName()
            : $this->getName();
    }

    /**
     * @return string
     */
    public function getMailingAddress()
    {
        if ($this->isShowInAddress()) {
            return parent::getMailingAddress();
        }

        $owner = $this->getOwner();

        return $owner ? $owner->getMailingAddress() : '';
    }

    /**
     * @return string
     */
    public function getRoadAddress()
    {
        if ($this->isShowInAddress()) {
            return parent::getRoadAddress();
        }

        $owner = $this->getOwner();

        return $owner ? $owner->getRoadAddress() : '';
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return parent::getRoadAddress();
    }
}
