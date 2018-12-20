<?php
namespace App\Entity\Address;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="regions")
 */
class Region extends AAddress {

    /**
     * @ORM\ManyToOne(targetEntity="Country", inversedBy="subordinates")
     * @ORM\JoinColumn(name="owner_id", referencedColumnName="id")
     */
    protected $owner = null;

    /**
     * @ORM\OneToMany(targetEntity="District", mappedBy="owner")
     */
    protected $subordinates = null;

    /**
     * @ORM\ManyToOne(targetEntity="RegionType")
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id")
     */
    protected $type = null;

    /**
     * @return string
     */
    public function getFullName() {
        return $this->getShortName()
            ? $this->getName() . ' ' . $this->getShortName()
            : $this->getName();
    }
}