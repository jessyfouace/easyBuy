<?php
session_start();
if (isset($_SESSION['mail'])) {
    session_destroy();
    if (isset($_COOKIE['mail'])) {
        setcookie("mail", "", time() - 3600);
        setcookie("firstname", "", time() - 3600);
        setcookie("lastname", "", time() - 3600);
        setcookie("idUser", "", time() - 3600);
        setcookie("password", "", time() - 3600);
        setcookie("pseudo", "", time() - 3600);
        setcookie("role", "", time() - 3600);
        setcookie("acceptation", "", time() - 3600);
    }
    header('location: index.php');
} else {
    header('location: index.php');
}