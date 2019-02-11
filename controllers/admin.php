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
$db = Database::BDD();
$title = 'EasyBuy - Dashboard';
$isActive = 4;

$houseManager = new HouseManager($db);
$usersManager = new UsersManager($db);

require '../controllers/cookies.php';

if (isset($_SESSION['role']) and $_SESSION['role'] == 'is_admin') {
} else {
    header('location: index.php');
}

if (!isset($_GET['repport']) and !isset($_GET['house']) and !isset($_GET['users'])) {
    $allHouse = $houseManager->getTenLastHouse();
    $allUsers = $usersManager->getFiveLastUser();
}

if (isset($_GET['house']) and $_GET['house'] == 'true') {
    $allHouse = $houseManager->getAllHouse();
    $countHouse = $houseManager->countHouse();
}

if (isset($_GET['users']) and $_GET['users'] == 'true') {
    $allUsers = $usersManager->getAllUsers();
    $countUsers = $usersManager->countUsers();
}

if (isset($_POST['banUser'])) {
    echo $_POST['banUser'];
}

require '../views/adminVue.php';