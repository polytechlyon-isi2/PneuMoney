<?php

namespace PneuMoney\DAO;

use PneuMoney\Domain\Marque;

class MarqueDAO extends DAO
{
  public function findAll() {
      $sql = "select * from t_marque order by marque_id desc";
      $result = $this->getDb()->fetchAll($sql);

      // Convert query result to an array of domain objects
      $marques = array();
      foreach ($result as $row) {
          $marqueid = $row['marque_id'];
          $marques[$marqueid] = $this->buildDomainObject($row);
      }
      return $marques;
  }

protected function buildDomainObject($row) {
      $Marque = new Marque();
      $Marque->setId($row['marque_id']);
      $Marque->setNom($row['marque_nom']);
      return $Marque;
  }
}
