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

    <div id="content">
        <div id="inner_content">
            <?php

            include("bddLogin.php");

            $reponse = $bdd->query('SELECT * FROM visiteur');

            if (isset($_POST["Search"])) {
                $num_Visiteur = $_POST["Search"];
                $numVisiteur = $bdd->query('SELECT * FROM visiteur INNER JOIN secteur ON visteur.SEC_CODE = secteur.SEC_CODE INNER JOIN labo ON visiteur.LAB_CODE = labo.LAB_CODE WHERE visteur.VIS_MATRICULE =' . $num_Visiteur . ';');

                while ($data = $numVisiteur->fetch()) {
                    $NOM = $data["VIS_NOM"];
                    $PRENOM = $data["Vis_PRENOM"];
                    $ADRESSE = $data["VIS_ADRESSE"];
                    $VILLE = $data["VIS_VILLE"];
                    $CODEP = $data["VIS_CP"];
                    $SECTEUR = $data["SEC_CODE"];
                    $LABO = $data["LAB_CODE"];
                }
            } else {
                $NOM = "";
                $PRENOM = "";
                $ADRESSE = "";
                $VILLE= "";
                $CODEP = "";
                $SECTEUR = "";
                $LABO = "";
            }
            ?>



            <form action="Visiteurs.php" action="post">
                <!-- Chercher --> <br>
                <label for="Search">Chercher</label>
                <select name="Search" id="">

                    <?php

                    if (isset($_POST["Search"])) {
                        echo "<option selected='selected' disabled hidden>" . $_POST["Search"] . "</option>";
                    }
                    while ($data = $reponse->fetch()) {
                        $NOM = $data["VIS_NOM"];
                        $PRENOM = $data["Vis_PRENOM"];
                        echo "<option>" . $NOM . " " . $PRENOM . "</option>";
                    }

                  
                    ?>

                </select>
                <input type="submit" value="Ok" id="search">

                <!-- Nom --> <br>
                <label for="nom">Nom</label>
                <input type="text" name="nom" value='<?php
                                                    echo strval($NOM);
                                                    ?>'>
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

        </div>
    </div>

</body>

</html>