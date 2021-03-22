<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/Rendus.css">
    <title>Document</title>
</head>

<body>

    <form action="Rendus.php" method="post">
        <label for="numero_rapport">Numero Rapport : </label>
        <input type="text" name="nymero_rapport">
        <!-- Date -->
        <label for="date_rapport">Date : </label>
        <input type="text" name="date_rapport">
        <!-- Practicien -->
        <label for="practicien">Practicien :</label>
        <input type="text" name="practicien">
        <!-- Motif -->
        <label for="motif">Motif Visite : </label>
        <input type="text" name="motif">
        <!-- Bilan -->
        <label for="bilan">Bilan : </label>
        <textarea name="bilan" id="bilan"></textarea>
        <!-- Offre d'échantillion -->
        <label for="offreEchan">Offre echantillion : </label>
        <input type="text" name="offreEchan">

    </form>

<?php  
    
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=swiss_visite;charset=utf8', 'root', '');
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

    $reponse = $bdd->query('SELECT RAP_NUM FROM rapport_visite');

    while ($data = $reponse->fetch()) {
        echo nl2br ($data["RAP_NUM"]);
    }







?>


</body>

</html>