<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div id="header">
        <ul>
            <li><a class="Accueil" href="index.php">Accueil</a></li>
            <li><a href="Medicaments.php">Médicament</a></li>
            <li><a href="Practiciens.php">Practiciens</a></li>
            <li><a href="Visiteurs.php">Visiteurs</a></li>
            <li><a href="Rendus.php">Comptes-Rendus</a></li>
        </ul>
    </div>
    <hr>

    <?php

    try {
        $bdd = new PDO('mysql:host=localhost;dbname=swiss_visite;charset=utf8', 'root', '');
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

    $practicien = $_POST["Search"];
    $reponse = $bdd->query("SELECT * FROM visiteur;");
    if(isset($_POST["Search"])){
    $reponse2 = $bdd->query('SELECT * FROM visiteur WHERE VIS_NOM =' . $practicien . ';');

    while ($data = $reponse2->fetch()) {
        $NOM = $data["VIS_NOM"];
        $PRENOM = $data["Vis_PRENOM"];
    }
}
    ?>

    <form action="Visiteurs.php" action="post">
        <!-- Chercher --> <br>
        <label for="Search">Chercher</label>
        <select name="Search" id="">

            <?php
            if (!isset($_POST["nom"])) {
                while ($data = $reponse->fetch()) {
                    $NOM = $data["VIS_NOM"];
                    $PRENOM = $data["Vis_PRENOM"];
                    echo "<option>" . $NOM . " " . $PRENOM . "</option>";
                }
            }
            ?>

        </select>
        <input type="submit" value="Ok">
        <hr id="SearchVisiteur">
        <!-- Nom --> <br>
        <label for="nom">Nom</label>
        <input type="text" name="nom" value=<?php
                                            echo $NOM;
                                            ?>>
        <!-- Prénom --> <br>
        <label for="prenom">Prénom</label>
        <input type="text" name="prenom">
        <!-- Adresse --> <br>
        <label for="adresse">Adresse</label>
        <input type="text" name="adresse" value=<?php $PRENOM = $data["Vis_PRENOM"]; ?>>
        <!-- Ville --> <br>
        <!-- Code Postal -->
        <label for="codePost">Ville</label>
        <input type="text" name="CodePost">
        <!-- Nom Ville -->
        <label for="nomVille"></label>
        <input type="text" name="nomVille">
        <!-- Secteur --> <br>
        <label for="secteur">Secteur</label>
        <select name="secteur" id="secteur">

            <option value="nothing"></option>
            <?php
            while ($data = $reponse->fetch()) {
                // TROUVER LE SECTEUR
                $SECTEUR = $data[""];
                echo "<option>" . $SECTEUR . "</option>";
            }
            ?>

        </select>
        <!-- Labo --> <br>
        <label for="labo">Labo</label>
        <select name="labo" id="labo">

            <option value="nothing"></option>
            <?php
            while ($data = $reponse->fetch()) {
                // TROUVER LE LABO
                $LABO = $data[""];
                echo "<option>" . $LABO . "</option>";
            }
            ?>

        </select> <br><br>
        <input type="submit" name="precedent" value="Précédent">
        <input type="submit" name="suivant" value="Suivant">

    </form>



</body>

</html>