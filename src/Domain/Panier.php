<?php

namespace PneuMoney\Domain;

class Panier
{
    /**
    * Le mail de l'utilisateur
    *@var string
    */
    private $mailUtilisateur;

    /**
    * L'id du produit
    *@var integer
    */
    private $idPneu;

    /**
    * La quantité sélectionnée
    *@var integer
    */
    private $quantite;

    public function getIdUser() {
        return $this->idUtilisateur;
    }

    public function setIdUser($idUtilisateur) {
        $this->idUtilisateur = $idUtilisateur;
    }

    public function getIdPneu() {
        return $this->idPneu;
    }

    public function setIdPneu($idPneu) {
        $this->idPneu = $idPneu;
    }

    public function getQuantite() {
        return $this->quantite;
    }

    public function setQuantite($quantite) {
        $this->quantite = $quantite;
    }
}
