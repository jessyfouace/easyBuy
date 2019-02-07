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

    public function removeImagesById($id)
    {
        $id = (int) $id;
        $query = $this->getBdd()->prepare('DELETE FROM images WHERE idImages = :idImages');
        $query->bindValue('idImages', $id, PDO::PARAM_INT);
        $query->execute();
    }

    public function updateImageById($id,string $link)
    {
        $id = (int) $id;
        $query = $this->getBdd()->prepare('UPDATE images SET link = :link WHERE idImages = :idImages');
        $query->bindValue('link', $link, PDO::PARAM_STR);
        $query->bindValue('idImages', $id, PDO::PARAM_STR);
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
