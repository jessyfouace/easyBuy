<?php

function chargerClasse($classname)
{
    if (file_exists('../model/' . ucfirst($classname) . '.php')) {
        require '../model/' . ucfirst($classname) . '.php';
    } elseif (file_exists('../entities/' . ucfirst($classname) . '.php')) {
        require '../entities/' . ucfirst($classname) . '.php';
    } elseif (file_exists('../traits/' . ucfirst($classname) . '.php')) {
        require '../traits/' . ucfirst($classname) . '.php';
    } else {
        require '../interface/' . ucfirst($classname) . '.php';
    }
}
session_start();
spl_autoload_register('chargerClasse');
$isActive = 9;
$db = Database::BDD();

$departments = new DepartmentsManager($db);
$imageManager = new ImagesManager($db);
$houseManager = new HouseManager($db);
$usersManager = new UsersManager($db);

if (!empty($_GET['houseIdentification'])) {
    $houseByToken = $houseManager->getHouseByToken($_GET['houseIdentification']);
    foreach ($houseByToken[0] as $houseTitle) {
        $title = 'EasyBuy - ' . ucfirst($houseTitle->getTitle());
    }
    if (empty($houseByToken[0])) {
        header('location: index.php');
    }
} else {
    header('location: index.php');
}

if (isset($_POST['removeHouse'])) {
    if (isset($_POST['houseIdentification'])) {
        $houseToken = $houseManager->getHouseByToken($_POST['houseIdentification']);
        if (!empty($houseByToken[0])) {
            foreach ($houseToken[0] as $verificationUserId) {
                if ($_SESSION['idUser'] == $verificationUserId->getUserId() or $_SESSION['role'] == 'is_admin') {
                    if ($_POST['imageId'] == $verificationUserId->getImagesId()) {
                        $arrayOfImages = [];
                        for ($i=0; $i < 5; $i++) {
                                if (isset($_POST['image' . $i])) {
                                        $arrayOfImages[] = $_POST['image' . $i];
                                } 
                            }
                        foreach ($arrayOfImages as $key => $images) {
                            unlink($images);
                        }
                        $houseManager->removeHouseByToken($_POST['houseIdentification']);
                        $imageManager->removeImagesById($_POST['imageId']);
                        header('location: index.php');
                    }
                }
            }
        }
    }
}

require '../controllers/cookies.php';

require '../controllers/connexion.php';

require "../views/houseInfoVue.php";
