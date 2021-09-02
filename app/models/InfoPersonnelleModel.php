<?php 
if(isset($_SESSION['role'])){
    if($_SESSION['role'] == 'visiteur'){
        require('app/views/InfoPersoVisiteurs.php');
    }else if($_SESSION['role'] == 'praticien'){
        require('app/views/InfoPersoPraticiens.php');
    }
}
