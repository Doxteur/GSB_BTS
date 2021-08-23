<?php 
session_start();
include('bddLogin.php');

switch($_SESSION['role']){
    case "visiteur":
        require('templates/header.php');
        require("app/views/VisiteurPage.php");
        break;
    case "praticien":
        require('templates/header.php');
        require("app/views/PraticiensPage.php");
        break;
    default:
    require("app/views/LoginPage.php");
}



?>
