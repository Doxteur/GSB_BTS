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

        $reponse = $bdd->query('SELECT * FROM visiteur');

    ?>

    <form action="Visiteurs.php" action="post">
        <!-- Chercher --> <br>
        <label for="Search">Chercher</label>
        <select name="Search" id="">

            <?php 
                    echo "<option>" . $data["VIS_NOM"] . $data["Vis_PRENOM"] . "</option>";
                while ($data = $reponse->fetch()) {
                    
                }

            ?>

            <!-- METTRE LES NOM EN OPTIONS -->
        </select>
        <hr id="SearchVisiteur">
        <!-- Nom --> <br>
        <label for="nom">Nom</label>
        <input type="text" name="nom">
        <!-- Prénom --> <br>
        <label for="prenom">Prénom</label>
        <input type="text" name="prenom">
        <!-- Adresse --> <br>
        <label for="adresse">Adresse</label>
        <input type="text" name="adresse">
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
            <!-- METTRE LES SECTEURS EN OPTIONS -->
        </select>
        <!-- Labo --> <br>
        <label for="labo">Labo</label>
        <select name="labo" id="labo">
            <!-- METTRE LES LABOS EN OPTIONS -->
        </select>


    </form>



</body>

</html>