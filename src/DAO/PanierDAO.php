<?php

namespace PneuMoney\DAO;

use Doctrine\DBAL\Connection;
use PneuMoney\Domain\Panier;

class PanierDAO extends DAO
{
    /**
    * @var \PneuMoney\DAO\ArticleDAO
    */
    private $pneuDAO;

    /**
    * @var \PneuMoney\DAO\UserDAO
    */
    private $userDAO;


    public function setPneuDAO(PneuDAO $pneuDAO) {
        $this->pneuDAO = $pneuDAO;
    }

    public function setUserDAO(UserDAO $userDAO) {
        $this->userDAO = $userDAO;
    }

    public function findProductByMail($mail){
      $sql = 'select * from t_pneu WHERE pneu_id IN (SELECT pa_idPneu FROM t_panier WHERE pa_mailUser = \''.$mail.'\')';
      $result = $this->getDb()->fetchAll($sql);
      $pneus = array();
      foreach ($result as $row) {
          $pneuId = $row['pneu_id'];
          $pneus[$pneuId] = $this->pneuDAO->buildDomainObject($row);
      }
      return $pneus;
    }

    public function findQuantiteByPneu($pneu, $mail){
      $quantite = array();
      foreach($pneu as $row){
        $sql2 = 'select * from t_panier where pa_idPneu='.$row->getId().' and pa_mailUser = \''.$mail.'\'';
        $result2 = $this->getDb()->fetchAll($sql2);
        foreach($result2 as $row2){
          $quantite[$row->getId()] = $row2['pa_quantite'];
        }
      }
      return $quantite;
    }

    public function ajoutArticle($idPneu, $idUser, $quantite){
      $sql = "Select * From t_panier where pa_idPneu=? and pa_mailUser=?";
      $row = $this->getDb()->fetchAssoc($sql, array($idPneu, $idUser));
      if ($row){
        $nvQtt = $row['pa_quantite'] +1;
        $data = array(
              'pa_idPneu' => $idPneu,
              'pa_mailUser'  => $idUser,
              'pa_quantite' =>  $nvQtt);
        $this->getDb()->update('t_panier', $data, array('pa_mailUser'  => $idUser,'pa_idPneu' => $idPneu));
        return true;
      }
      else{
        $data = array(
              'pa_idPneu' => $idPneu,
              'pa_mailUser'  => $idUser,
              'pa_quantite' =>  $quantite);
        $result = $this->getDb()->insert('t_panier', array('pa_idPneu' => $idPneu,'pa_mailUser'  => $idUser, 'pa_quantite' => 1));
        return true;
      }
    }

    public function enleveArticle($idPneu, $idUser){
      $sql = "Select * From t_panier where pa_idPneu=? and pa_mailUser=?";
      $row = $this->getDb()->fetchAssoc($sql, array($idPneu, $idUser));
      $nvQtt = $row['pa_quantite'] - 1;
      if ($nvQtt == 0){
        $this->getDb()->delete('t_panier', array('pa_mailUser' => $idUser,'pa_idPneu' => $idPneu));
      }
      else{
        $data = array(
              'pa_idPneu' => $idPneu,
              'pa_mailUser'  => $idUser,
              'pa_quantite' =>  $nvQtt);
        $this->getDb()->update('t_panier', $data, array('pa_mailUser'  => $idUser,'pa_idPneu' => $idPneu));
      }
    }

    public function supprimeArticle($idPneu, $idUser){
      $this->getDb()->delete('t_panier', array('pa_mailUser' => $idUser,'pa_idPneu' => $idPneu));
    }

    public function meilleurVentes(){
      $sql =  'select *, count(*) from t_pneu pr inner join t_panier pa on pa.pa_idPneu = pr.pneu_id group by pa_idPneu order by count(*) desc limit 3';
      $result = $this->getDb()->fetchAll($sql);
      $pneus = array();
      foreach($result as $row){
        $pneuId = $row['pa_idPneu'];
        $pneus[$pneuId] = $this->pneuDAO->buildDomainObject($row);
      }
      return $pneus;
    }

    /**
     * Creates an panier object based on a DB row.
     *
     * @param array $row The DB row containing Pneu data.
     * @return \PneuMoney\Domain\Pneu
     */
    protected function buildDomainObject($row) {
        $panier = new panier();
        $panier->setQuantite($row['pa_quantite']);

        if (array_key_exists('pa_idPneu', $row)) {
            // Find and set the associated article
            $pneuId = $row['pa_idPneu'];
            $pneu = $this->pneuDAO->find($pneuId);
            $comment->setIdPneu($pneu);
        }
		      if (array_key_exists('pa_mailUser', $row)) {
            // Find and set the associated author
            $userId = $row['pa_mailUser'];
            $user = $this->userDAO->find($userId);
            $comment->setIdUser($user);
        }

        return $panier;
    }
}
