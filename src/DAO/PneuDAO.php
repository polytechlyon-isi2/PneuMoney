<?php

namespace PneuMoney\DAO;

use PneuMoney\Domain\Pneu;

class PneuDAO extends DAO
{
    /**
     * Return a list of all pneus, sorted by date (most recent first).
     *
     * @return une liste de tous les pneus.
     */
    public function findAll() {
        $sql = "select * from t_pneu order by pneu_id desc";
        $result = $this->getDb()->fetchAll($sql);

        // Convert query result to an array of domain objects
        $pneus = array();
        foreach ($result as $row) {
            $pneuId = $row['pneu_id'];
            $pneus[$pneuId] = $this->buildDomainObject($row);
        }
        return $pneus;
    }

    /**
     *
     *
     * @return une liste de tous les pneus appartenant à une même marque.
     */
    public function findByMarque($marque){
		$sql = 'SELECT * from t_pneu WHERE pneu_marque = \''.$marque.'\' ORDER BY pneu_id desc ';
    $result = $this->getDb()->fetchAll($sql);
    $pneus = array();
		foreach ($result as $row) {
            $pneuId = $row['pneu_id'];
            $pneus[$pneuId] = $this->buildDomainObject($row);
        }
		return $pneus;
	}
     /**
     *
     *
     * @return une liste de tous les pneus d'une même taille.
     */
    public function findByTaille($taille){
		$sql = 'SELECT * from t_pneu WHERE pneu_taille = \''.$taille.'\' ORDER BY pneu_id desc ';
    $result = $this->getDb()->fetchAll($sql);
    $pneus = array();
		foreach ($result as $row) {
            $pneuId = $row['pneu_id'];
            $pneus[$pneuId] = $this->buildDomainObject($row);
        }
		return $pneus;
	}

    /**
     * Returns an pneu matching the supplied id.
     *
     * @param integer $id The pneu id.
     *
     * @return \PneuMoney\Domain\pneu|throws an exception if no matching pneu is found
     */
    public function find($id) {
        $sql = "select * from t_pneu where pneu_id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("Aucun pneu ne correspond " . $id);
    }

    /**
     * Creates an pneu object based on a DB row.
     *
     * @param array $row The DB row containing pneu data.
     * @return \PneuMoney\Domain\pneu
     */
    protected function buildDomainObject($row) {
        $pneu = new Pneu();
        $pneu->setId($row['pneu_id']);
        $pneu->setMarque($row['pneu_marque']);
        $pneu->setTaille($row['pneu_taille']);
        $pneu->setType($row['pneu_type']);
        $pneu->setPrix($row['pneu_prix']);
        $pneu->setImage($row['pneu_image']);
        return $pneu;
    }
}
