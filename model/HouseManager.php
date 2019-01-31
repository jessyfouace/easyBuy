<?php
class HouseManager
{
    private $_bdd;

    public function __construct(PDO $bdd)
    {
        $this->setBdd($bdd);
    }

    public function addHouse(House $house)
    {
        $query = $this->getBdd()->prepare('INSERT INTO house(tokenAppartments, departmentsId, city, title, description, area, bedroom, bathroom, rooms, orientation, price, imagesId, userId) VALUES(:tokenAppartments, :departmentsId, :city, :title, :description, :area, :bedroom, :bathroom, :rooms, :orientation, :price, :imagesId, :userId)');
        $query->bindValue(':tokenAppartments', $house->getTokenAppartments(), PDO::PARAM_STR);
        $query->bindValue(':departmentsId', $house->getDepartmentsId(), PDO::PARAM_INT);
        $query->bindValue(':city', $house->getCity(), PDO::PARAM_STR);
        $query->bindValue(':title', $house->getTitle(), PDO::PARAM_STR);
        $query->bindValue(':description', $house->getDescription(), PDO::PARAM_STR);
        $query->bindValue(':area', $house->getArea(), PDO::PARAM_INT);
        $query->bindValue(':bedroom', $house->getBedroom(), PDO::PARAM_INT);
        $query->bindValue(':bathroom', $house->getBathroom(), PDO::PARAM_INT);
        $query->bindValue(':rooms', $house->getRooms(), PDO::PARAM_INT);
        $query->bindValue(':orientation', $house->getOrientation(), PDO::PARAM_STR);
        $query->bindValue(':price', $house->getPrice(), PDO::PARAM_INT);
        $query->bindValue(':imagesId', $house->getImagesId(), PDO::PARAM_INT);
        $query->bindValue(':userId', $house->getUserId(), PDO::PARAM_INT);
        $query->execute();
    }

    public function getFiveLastHouse()
    {
        $query = $this->getBdd()->prepare('SELECT * FROM house LEFT JOIN images ON house.imagesId = images.idImages LEFT JOIN departments ON house.departmentsId = departments.id GROUP BY house.idAppartments DESC LIMIT 6');
        $query->execute();
        $allHouse = $query->fetchAll(PDO::FETCH_ASSOC);

        $arrayOfHouse = [];
        $arrayOfImages = [];
        $arrayOfDepartments = [];
        $arrayOfAll = [];

        foreach ($allHouse as $house) {
            $arrayOfHouse[] = new House($house);
            $arrayOfImages[] = new Images($house);
            $arrayOfDepartments[] = new Departments($house);
        }
        $arrayOfAll[] = $arrayOfHouse;
        $arrayOfAll[] = $arrayOfImages;
        $arrayOfAll[] = $arrayOfDepartments;
        return $arrayOfAll;
    }

    public function getHouseByToken($token)
    {
        $query = $this->getBdd()->prepare('SELECT * FROM house LEFT JOIN images ON house.imagesId = images.idImages LEFT JOIN departments ON house.departmentsId = departments.id LEFT JOIN users ON house.userId = users.idUser WHERE house.tokenAppartments = :tokenApps');
        $query->bindValue('tokenApps', $token, PDO::PARAM_STR);
        $query->execute();
        $allHouse = $query->fetchAll(PDO::FETCH_ASSOC);

        $arrayOfHouse = [];
        $arrayOfImages = [];
        $arrayOfDepartments = [];
        $arrayOfUser = [];
        $arrayOfAll = [];

        foreach ($allHouse as $house) {
            $arrayOfHouse[] = new House($house);
            $arrayOfImages[] = new Images($house);
            $arrayOfDepartments[] = new Departments($house);
            $arrayOfUser[] = new Users($house);
        }
        $arrayOfAll[] = $arrayOfHouse;
        $arrayOfAll[] = $arrayOfImages;
        $arrayOfAll[] = $arrayOfDepartments;
        $arrayOfAll[] = $arrayOfUser;
        return $arrayOfAll;
    }

    public function countHouse()
    {
        $query = $this->getBdd()->prepare('SELECT COUNT(*) FROM house');
        $query->execute();
        $allCount = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($allCount as $count) {
            return $count;
        }

    }

    public function paginationHouse($firstEntry, $messagePearPage)
    {
        $firstEntry = (int) $firstEntry;
        $messagePearPage = (int) $messagePearPage;
        $query = $this->getBdd()->prepare('SELECT * FROM house ORDER BY idAppartments DESC LIMIT :firstEntry, :messagePearPage');
        $query->bindValue('firstEntry', $firstEntry, PDO::PARAM_INT);
        $query->bindValue('messagePearPage', $messagePearPage, PDO::PARAM_INT);
        $query->execute();
        $selectHouses = $query->fetchAll(PDO::FETCH_ASSOC);

        $arrayOfHouse = [];
        foreach ($selectHouses as $house) {
            $arrayOfHouse[] = new House($house);
        }
        return $arrayOfHouse;
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
