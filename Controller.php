<?php
session_start();
include('bddLogin.php');

$uri = $_SERVER['REQUEST_URI'];
$uri = explode('/', $uri);
$uri = "/" . $uri[2];




switch($uri){
    case '/':
        include('app/views/LandingPage.php');
        break;
    case '/rapport':
        if(isset($_SESSION['role'])){
            require('templates/header.php');
            require('app/models/RapportModel.php');
        }else{
            header('Location: login');
        }
        break;
    case '/login':
        require('app/views/LoginPage.php');
        break;
    default:
        require('errors/404.php');
}


// $page = $_GET['page'] ?? '404';


// switch ($page) {
//     case "rapport":
//         if ($_SESSION['role'] == "visiteur") {
//             require('../templates/header.php');
//             require("../app/views/VisiteurPage.php");
//         } else if ($_SESSION['role'] == "praticien") {
//             require('../templates/header.php');
//             require("../app/views/PraticiensPage.php");
//         } else {
//             require('../app/views/LoginPage.php');
//         }
//         break;
//     case "login":
//         require('../app/views/LoginPage.php');
//         break;
//     default:
//         require("../errors/404.php");
// }
