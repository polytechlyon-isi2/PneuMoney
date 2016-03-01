<?php

namespace PneuMoney\Domain;

class Pneu
{
    /**
     * Pneu id.
     *
     * @var integer
     */
    private $id;

    /**
     * Pneu marque.
     *
     * @var string
     */
    private $marque;

    /**
     * Pneu taille.
     *
     * @var string
     */
    private $taille;

    /**
     * Pneu type.
     *
     * @var string
     */
    private $type;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getMarque() {
        return $this->marque;
    }

    public function setMarque($marque) {
        $this->marque = $marque;
    }

    public function getTaille() {
        return $this->taille;
    }

    public function setTaille($taille) {
        $this->taille = $taille;
    }

    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        $this->type = $type;
    }
}
