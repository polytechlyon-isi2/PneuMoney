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


  public function find($id) {
      $sql = 'select * from t_marque where marque_id = \''.$id.'\'';
      $row = $this->getDb()->fetchAssoc($sql, array($id));
      if ($row)
          return $this->buildDomainObject($row);
      else
          throw new \Exception("Aucune marque ne correspond " . $id);
  }

protected function buildDomainObject($row) {
      $Marque = new Marque();
      $Marque->setId($row['marque_id']);
      $Marque->setNom($row['marque_nom']);
      return $Marque;
  }
}
