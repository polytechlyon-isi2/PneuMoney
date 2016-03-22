<?php

namespace PneuMoney\DAO;

use PneuMoney\Domain\Taille;

class TailleDAO extends DAO
{
  public function findAll() {
      $sql = "select * from t_taille";
      $result = $this->getDb()->fetchAll($sql);

      // Convert query result to an array of domain objects
      $tailles = array();
      foreach ($result as $row) {
          $taillenom = $row['taille_nom'];
          $tailles[$taillenom] = $this->buildDomainObject($row);
      }
      return $tailles;
  }


  public function find($nom) {
      $sql = 'select * from t_taille where taille_nom = \''.$nom.'\'';
      $row = $this->getDb()->fetchAssoc($sql, array($nom));
      if ($row)
          return $this->buildDomainObject($row);
      else
          throw new \Exception("Aucune taille ne correspond " . $nom);
  }

protected function buildDomainObject($row) {
      $Taille = new Taille();
      $Taille->setNom($row['taille_nom']);
      return $Taille;
  }
}
