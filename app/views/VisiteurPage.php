<?php 

// $request = $bdd->prepare('SELECT * FROM visiteur WHERE VIS_MATRICULE = ?');
// $request->execute([$_SESSION['matricule']]);
// $reponse = $request->fetch(PDO::FETCH_ASSOC);

// var_dump($reponse);
$_SESSION['role'] == 'visiteur' ?  : header('Location: /GSB_BTS/');
?>

azezae