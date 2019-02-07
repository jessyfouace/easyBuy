<?php
class MessageManager
{
    private $_bdd;

    public function __construct(PDO $bdd)
    {
        $this->setBdd($bdd);
    }

    public function getMessageById($userIdTaker)
    {
        $query = $this->getBdd()->prepare('SELECT * FROM message LEFT JOIN users ON message.userIdSender = users.idUser WHERE message.userIdTaker = :userIdTaker');
        $query->bindValue('userIdTaker', $userIdTaker, PDO::PARAM_INT);
        $query->execute();
        $infosMessage = $query->fetchAll(PDO::FETCH_ASSOC);

        $arrayOfMessage = [];
        $arrayOfUsers = [];
        $arrayOfAll = [];
        foreach ($infosMessage as $infoMessage) {
            $arrayOfMessage[] = new Message($infoMessage);
            $arrayOfUsers[] = new Users($infoMessage);
        }

        $arrayOfAll[] = $arrayOfMessage;
        $arrayOfAll[] = $arrayOfUsers;

        return $arrayOfAll;
    }

    public function removeMessage($id)
    {
        $id = (int) $id;
        $query = $this->getBdd()->prepare('DELETE FROM message WHERE idMessage = :idMessage');
        $query->bindValue('idMessage', $id, PDO::PARAM_INT);
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
