<?php
class ImagesManager
{
    private $_bdd;

    public function __construct(PDO $bdd)
    {
        $this->setBdd($bdd);
    }

    public function addImages(Images $image)
    {
        $query = $this->getBdd()->prepare('INSERT INTO images(link, alt) VALUES(:link, :alt)');
        $query->bindValue(':link', $image->getLink(), PDO::PARAM_STR);
        $query->bindValue(':alt', $image->getAlt(), PDO::PARAM_STR);
        $query->execute();
        return $this->getBdd()->lastInsertId();
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
