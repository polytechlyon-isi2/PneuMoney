<?php

namespace PneuMoney\Domain;

class Marque
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
    private $nom;


    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getNom() {
        return $this->nom;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }





  }
