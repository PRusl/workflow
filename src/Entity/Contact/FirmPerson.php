<?php
namespace App\Entity\Contact;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="firm_person")
 */
class FirmPerson extends AType
{

    /**
     * @ORM\ManyToOne(targetEntity="Firm", inversedBy="persons", cascade={"all"})
     * @ORM\JoinColumn(name="firm_id", referencedColumnName="id")
     */
    protected $firm;

    /**
     * @ORM\ManyToOne(targetEntity="Person", inversedBy="firms", cascade={"all"})
     * @ORM\JoinColumn(name="person_id", referencedColumnName="id")
     */
    protected $person;

    /**
     * @return Firm
     */
    public function getFirm() {
        return $this->firm;
    }

    /**
     * @param Firm $firm
     */
    public function setFirm($firm) {
        $this->firm = $firm;
    }

    /**
     * @return Person
     */
    public function getPerson() {
        return $this->person;
    }

    /**
     * @param Person $person
     */
    public function setPerson($person) {
        $this->person = $person;
    }

    public function __toString() {
        return $this->getPerson() . ' is ' . parent::__toString() . ' for ' . $this->getFirm();
    }
}