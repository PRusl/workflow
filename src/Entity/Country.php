<?php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 * @ORM\Table(name="countries")
 */
class Country extends ADictionary {

    const ENTITY_NAME = 'Країни';

    protected $owner = null;

    /**
     * @ORM\OneToMany(targetEntity="Region", mappedBy="owner")
     */
    protected $subordinates = null;
}
