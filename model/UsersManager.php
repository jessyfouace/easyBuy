<?php
class UsersManager
{
    private $_bdd;

    public function __construct(PDO $bdd)
    {
        $this->setBdd($bdd);
    }

    public function getUserById($idUser)
    {
        $query = $this->getBdd()->prepare('SELECT * FROM users WHERE idUser = :idUser');
        $query->execute();
        $infosUser = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($infosUser as $infoUser) {
            return new Users($infoUser);
        }
    }

    public function getUserByMail(string $mail)
    {
        $query = $this->getBdd()->prepare('SELECT * FROM users WHERE mail = :mail');
        $query->bindValue(':mail', $mail, PDO::PARAM_STR);
        $query->execute();
        $infosUser = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($infosUser as $infoUser) {
            return new Users($infoUser);
        }

    }

    public function addUser(Users $user)
    {
        $query = $this->getBdd()->prepare('INSERT INTO users(mail, password, firstname, lastname) VALUES(:mail, :password, :firstname, :lastname)');
        $query->bindValue(':mail', $user->getMail(), PDO::PARAM_STR);
        $query->bindValue(':password', $user->getPassword(), PDO::PARAM_STR);
        $query->bindValue(':firstname', $user->getFirstname(), PDO::PARAM_STR);
        $query->bindValue(':lastname', $user->getLastname(), PDO::PARAM_STR);
        $query->execute();
    }


    /**
     * Get the value of _bdd
     */
    public function getBdd()
    {
        return $this->_bdd;
    }

    /**
     * Set the value of _bdd
     *
     * @return  self
     */
    public function setBdd(PDO $bdd)
    {
        $this->_bdd = $bdd;

        return $this;
    }
}
