<?php
session_start();
include('bddLogin.php');

  switch($uri){
     
    case '/' :
        include('app/views/LandingPage.php');
        break;
    case '/landing' :
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

