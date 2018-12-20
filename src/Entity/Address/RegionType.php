<?php
namespace App\Entity\Address;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 * @ORM\Table(name="region_types")
 */
class RegionType extends AAddressType {

}