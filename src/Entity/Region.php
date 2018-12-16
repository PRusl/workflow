<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 * @ORM\Table(name="regions")
 */
class Region extends ADictionary {

    const ENTITY_NAME = 'Області';

    /**
     * @ORM\ManyToOne(targetEntity="Country", inversedBy="subordinates")
     * @ORM\JoinColumn(name="owner_id", referencedColumnName="id")
     */
    protected $owner = null;

//    /**
//     * @ORM\OneToMany(targetEntity="ADirectory", mappedBy="owner")
//     */
//    private $subordinates = null;
}
