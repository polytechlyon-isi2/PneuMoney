<?php

namespace PneuMoney\DAO;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use PneuMoney\Domain\User;

class UserDAO extends DAO implements UserProviderInterface
{
    /**
     * Returns a user matching the supplied mail.
     *
     * @param String $mail The user mail.
     *
     * @return \PneuMoney\DAO\Domain\User|throws an exception if no matching user is found
     */
    public function find($mail) {
        $sql = "select * from t_user where usr_mail=?";
        $row = $this->getDb()->fetchAssoc($sql, array($mail));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No user matching mail : " . $mail);
    }

    /**
     * {@inheritDoc}
     */
    public function loadUserByUsername($mail)
    {
        $sql = "select * from t_user where usr_mail=?";
        $row = $this->getDb()->fetchAssoc($sql, array($mail));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new UsernameNotFoundException(sprintf('User "%s" not found.', $mail));
    }

    /**
     * {@inheritDoc}
     */
    public function refreshUser(UserInterface $user)
    {
        $class = get_class($user);
        if (!$this->supportsClass($class)) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $class));
        }
        return $this->loadUserByUsername($user->getUsername());
    }

    /**
     * {@inheritDoc}
     */
    public function supportsClass($class)
    {
        return 'PneuMoney\Domain\User' === $class;
    }

    /**
     * Creates a User object based on a DB row.
     *
     * @param array $row The DB row containing User data.
     * @return \PneuMoney\DAO\Domain\User
     */
    protected function buildDomainObject($row) {
        $user = new User();
        $user->setNom($row['usr_nom']);
		$user->setPrenom($row['usr_prenom']);
        $user->setMail($row['usr_mail']);
        $user->setPassword($row['usr_password']);
        $user->setSalt($row['usr_salt']);
        $user->setRole($row['usr_role']);
        return $user;
    }

	/**
     * Saves a user into the database.
     *
     * @param \PneuMoney\Domain\User $user The user to save
     */
    public function save(User $user) {
        $userData = array(
			'usr_mail' => $user->getMail(),
			'usr_prenom'  =>   $user->getPrenom(),
            'usr_nom' => $user->getNom(),
			'usr_password' => $user->getPassword(),
            'usr_salt' => $user->getSalt(),
            'usr_role' =>   $user->getRole()  //'ROLE_USER'
            );

			$mail= $user->getMail();
			$sql = 'select * from t_user where usr_mail = \''.$mail.'\'';

			$row = $this->getDb()->fetchAssoc($sql, array('usr_mail'));
        if ($row) {
        } else {
            // The user has never been saved : insert it
				$this->getDb()->insert('t_user', $userData);
        }
    }

	/**
     * Update a user in the database
     *
     * @param @param user $user the user to update.
     */

	    public function update(User $user) {
        $userData = array(
			'usr_mail' => $user->getMail(),
			'usr_prenom'  =>   $user->getPrenom(),
            'usr_nom' => $user->getNom(),
			'usr_password' => $user->getPassword(),
            'usr_salt' => $user->getSalt(),
            'usr_role' =>   $user->getRole()  //'ROLE_USER'
            );
			$mail= $user->getMail();
			$sql = 'select * from t_user where usr_mail = \''.$mail.'\'';
			$row = $this->getDb()->fetchAssoc($sql, array('usr_mail'));
        if ($row) {
            $this->getDb()->update('t_user', $userData, array('usr_mail' => $user->getMail()));
        }
    }

	/**
     * Removes a user from the database.
     *
     * @param @param integer $id The user id.
     */
    public function delete($mail) {
        // Delete the user
        $this->getDb()->delete('t_user', array('usr_mail' => $mail));
    }

}
