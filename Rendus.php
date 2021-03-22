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


    <?php

    try {
        $bdd = new PDO('mysql:host=localhost;dbname=swiss_visite;charset=utf8', 'root', '');
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

    $reponse = $bdd->query('SELECT * FROM rapport_visite');
    $reponseune = $bdd->query('SELECT * FROM rapport_visite LIMIT 1');
    while ($data = $reponseune->fetch()) {
        $valeurDate = $data["RAP_DATE"];
        $valeurBilan = $data["RAP_BILAN"];
    }
    ?>
    
           
    <form action="Rendus.php" method="post">
        <label for="numero_rapport">Numero Rapport</label>
        <select name="numero_rapport" id="pet-select">
            <?php
            while ($data = $reponse->fetch()) {
                echo "<option>" . $data["RAP_NUM"] . "</option>";
            }
            
            ?>
        </select>
        <!-- Date -->

        <label for="date_rapport">Date : </label>
        <?php
        echo "<input type='text' name='date_rapport' value='" . strval($valeurDate) . "'>";
        ?>
        <!-- Practicien -->
        <label for="practicien">Practicien :</label>
        <input type="text" name="practicien">
        
        <!-- Motif -->
        <label for="motif">Motif Visite : </label>
        <input type="text" name="motif">
        <!-- Bilan -->
        <label for="bilan">Bilan : </label>
        <?php
        echo "<textarea type='text' name='bilan'>".$valeurBilan."</textarea>";
        ?>
        <!-- Offre d'échantillion -->
        <label for="offreEchan">Offre echantillion : </label>
        <input type="text" name="offreEchan">

    </form>


</body>

</html>