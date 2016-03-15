<?php

namespace PneuMoney\DAO;

use PneuMoney\Domain\Client;

class ClientDAO extends DAO
{
  public function findAll() {
      $sql = "select * from t_client";
      $result = $this->getDb()->fetchAll($sql);

      // Convert query result to an array of domain objects
      $clients = array();
      foreach ($result as $row) {
          $clientmail = $row['client_mail'];
          $clients[$clientmail] = $this->buildDomainObject($row);
      }
      return $clients;
  }


  public function find($mail) {
      $sql = 'select * from t_client where client_mail = \''.$mail.'\'';
      $row = $this->getDb()->fetchAssoc($sql, array($mail));
      if ($row)
          return $this->buildDomainObject($row);
      else
          throw new \Exception("Aucune client ne correspond " . $mail);
  }

protected function buildDomainObject($row) {
      $Client = new Client();
      $Client->setMail($row['client_mail']);
      $Client->setPrenom($row['client_prenom']);
      $Client->setNom($row['client_nom']);
      return $Client;
  }
}
