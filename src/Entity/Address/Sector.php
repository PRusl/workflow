<?php
namespace App\Entity\Address;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="sectors")
 */
class Sector extends AAddress {

    /**
     * @ORM\ManyToOne(targetEntity="Settlement", inversedBy="subordinates")
     * @ORM\JoinColumn(name="owner_id", referencedColumnName="id")
     */
    protected $owner = null;

    /**
     * @ORM\OneToMany(targetEntity="Street", mappedBy="owner")
     */
    protected $subordinates = null;

    /**
     * @return string
     */
    public function getMailingAddress() {
        return $this->getOwner() ? $this->getOwner()->getMailingAddress() : '';
    }

    /**
     * @return string
     */
    public function getRoadAddress() {
        $owner = $this->getOwner();

        if ($owner && count($owner->getSubordinates()) > 1) {
            return parent::getRoadAddress();
        }

        return $owner ? $owner->getRoadAddress() : '';
    }
}
