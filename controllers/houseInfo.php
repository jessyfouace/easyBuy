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

require '../controllers/cookies.php';

require '../controllers/connexion.php';

require "../views/houseInfoVue.php";
