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
$title = 'EasyBuy - Ajouter un biens';
$isActive = 2;
$db = Database::BDD();

require '../controllers/cookies.php';

$usersManager = new UsersManager($db);

if (isset($_GET['idUserProfil'])) {
    $id = (int) $_GET['idUserProfil'];
    $infoUser = $usersManager->getUserById($id);
    if (empty($infoUser[0])) {
        header('location: index.php');
    }
} else {
    header('location: index.php');
}

$messageNo = '';
$messageOk = '';

if(isset($_POST['edit'])) {
    if (!empty($_POST['firstname']) and !empty($_POST['lastname']) and !empty($_POST['mail'])) {
        $firstname = htmlspecialchars($_POST['firstname']);
        $lastname = htmlspecialchars($_POST['lastname']);
        $mail = htmlspecialchars($_POST['mail']);
        if (!empty($_POST['lastpassword']) and !empty($_POST['newpassword']) and !empty($_POST['confirmnewpassword'])) {
            if ($_POST['newpassword'] == $_POST['confirmnewpassword']) {
                $lastpassword = htmlspecialchars($_POST['lastpassword']);
                $newpassword = htmlspecialchars($_POST['newpassword']);
                foreach ($infoUser[0] as $user) {
                    if (password_verify($lastpassword, $user->getPassword())) {
                        $password = password_hash($newpassword, PASSWORD_DEFAULT);
                        $updateUser = new Users([
                            'idUser' => $_SESSION['idUser'],
                            'firstname' => $firstname,
                            'lastname' => $lastname,
                            'mail' => $mail,
                            'password' => $password,
                            'role' => $_SESSION['role']
                        ]);
                        $usersManager->updateUserPassword($updateUser);
                        $messageOk = 'Profil Modifié';
                    } else {
                        $messageNo = 'Erreur dans la modification';
                    }
                }
            } else {
                $messageNo = 'Erreur dans la modification';
            }
        } else {
            $updateUser = new Users([
                'idUser' => $_SESSION['idUser'],
                'firstname' => $firstname,
                'lastname' => $lastname,
                'mail' => $mail,
                'password' => $_SESSION['password'],
                'role' => $_SESSION['role']
            ]);
            $usersManager->updateUser($updateUser);
            $messageOk = 'Profil Modifié';
        }
        header('Refresh: 1; url=detailUser.php?idUserProfil=' . $_SESSION['idUser']);
    }
}

require "../views/detailUserVue.php";