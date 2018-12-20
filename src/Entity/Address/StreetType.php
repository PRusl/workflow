<?php
namespace App\Entity\Address;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 * @ORM\Table(name="street_types")
 */
class StreetType extends AAddressType {

}