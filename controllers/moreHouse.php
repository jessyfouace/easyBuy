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
$title = 'EasyBuy - Plus de biens';
$isActive = 3;
$db = Database::BDD();

$departments = new DepartmentsManager($db);
$houseManager = new HouseManager($db);
$usersManager = new UsersManager($db);

$allCount = $houseManager->countHouse();
foreach ($allCount as $count) {
    $allCount = $count;
}
$messagePearPage = 5;


$numberOfPage = ceil($allCount / $messagePearPage);

if (isset($_GET['page'])) {
    $actualPage = intval($_GET['page']);

    if ($actualPage > $numberOfPage) {
        $actualPage = $numberOfPage;
    }
} else {
    $actualPage = 1;
}

$firstEntry = ($actualPage - 1) * $messagePearPage;

$returnMessage = $houseManager->paginationHouse($firstEntry, $messagePearPage);

require '../controllers/cookies.php';

require "../views/moreHouseVue.php";