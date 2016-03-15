<?php

namespace PneuMoney\Domain;

class Client
{
    /**
     * Client mail.
     *
     * @var string
     */
    private $mail;

    /**
     * Client prenom.
     *
     * @var string
     */
    private $prenom;

    /**
     * Client nom.
     *
     * @var string
     */
    private $nom;


    public function getMail() {
        return $this->mail;
    }

    public function setMail($mail) {
        $this->mail = $mail;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    public function getNom() {
        return $this->nom;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }


}
