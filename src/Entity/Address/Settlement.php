<?php
namespace App\Entity\Address;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="settlements")
 */
class Settlement extends AAddress {

    /**
     * @ORM\ManyToOne(targetEntity="District", inversedBy="subordinates")
     * @ORM\JoinColumn(name="owner_id", referencedColumnName="id")
     */
    protected $owner = null;

    /**
     * @ORM\OneToMany(targetEntity="Sector", mappedBy="owner")
     */
    protected $subordinates = null;

    /**
     * @ORM\ManyToOne(targetEntity="SettlementType")
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id")
     */
    protected $type = null;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    protected $zip;

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
}
