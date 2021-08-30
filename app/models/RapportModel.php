<?php 
var_dump($_SESSION['role']);
if(isset($_SESSION['role'])){
    if($_SESSION['role'] == 'visiteur'){
        require('app/views/VisiteurPage.php');
    }else if($_SESSION['role'] == 'praticien'){
        require('app/views/PraticiensPage.php');
    }
}
