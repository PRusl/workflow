<?php
namespace App\Entity\Address;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 * @ORM\Table(name="district_types")
 */
class DistrictType extends AAddressType {

}