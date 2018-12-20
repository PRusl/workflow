<?php
namespace App\Entity\Address;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="countries")
 */
class Country extends AAddress {

    protected $owner = null;

    /**
     * @ORM\OneToMany(targetEntity="Region", mappedBy="owner")
     */
    protected $subordinates = null;

    /**
     * @return string
     */
    public function getRoadAddress() {
        return '';
    }

    /**
     * @return string
     */
    public function __toString() {
        return $this->getName();
    }
}
