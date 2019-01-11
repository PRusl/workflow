<?php
namespace App\Entity\Contact;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="person")
 */
class Person extends AContact
{
    /**
     * @ORM\ManyToOne(targetEntity="PersonType")
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id")
     */
    protected $type = null;

    /**
     * @ORM\OneToMany(targetEntity="FirmPerson", mappedBy="person")
     */
    protected $firms;

    public function __construct() {
        $this->firms = new ArrayCollection();
    }

    /**
     * @return ArrayCollection
     */
    public function getFirms() {
        return $this->firms;
    }

    /**
     * @param FirmPerson $contactRelation
     * @return Person
     */
    public function addFirm($contactRelation) {
        if ($this->firms->contains($contactRelation)) {
            return $this;
        }

        if ($this->firms->add($contactRelation)) {
            $contactRelation->setPerson($this);
        }

        return $this;
    }

    /**
     * @param FirmPerson $contactRelation
     * @return Person
     */
    public function removeFirm($contactRelation) {
        if (!$this->firms->contains($contactRelation)) {
            return $this;
        }

        if ($this->firms->removeElement($contactRelation)) {
            $contactRelation->setPerson(null);
        }

        return $this;
    }
}