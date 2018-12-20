<?php
namespace App\Entity\Address;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="streets")
 */
class Street extends AAddress {

    /**
     * @ORM\ManyToOne(targetEntity="Sector", inversedBy="subordinates")
     * @ORM\JoinColumn(name="owner_id", referencedColumnName="id")
     */
    protected $owner = null;

    /**
     * @ORM\OneToMany(targetEntity="Building", mappedBy="owner")
     */
    protected $subordinates = null;

    /**
     * @ORM\ManyToOne(targetEntity="StreetType")
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id")
     */
    protected $type = null;
}
