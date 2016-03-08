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

    /**
     * Pneu prix.
     *
     * @var double
     */
    private $prix;

    /**
     * Pneu image.
     *
     * @var string
     */
    private $image;

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

    public function getPrix() {
        return $this->prix;
    }

    public function setPrix($prix) {
        $this->prix = $prix;
    }

    public function getImage() {
        return $this->image;
    }

    public function setImage($image) {
        $this->image = $image;
    }
}
