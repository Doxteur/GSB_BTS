<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/Rendus.css">
</head>

<body>
    <div id="header">

        <img src="Images/logo_2.png" alt="" id="logo">
        <div id="compteHeader">
            <img src="Images/Icons/avatar.png" alt="">
            <h1>Jhon Doe</h1>
        </div>
    </div>

    <div id="nav">
        <div id="inner_nav">
            <h2>Informations</h2>
            <ul>
                <div>
                    <img src="Images/Icons/rapport.png" alt="Comptes-Rendus">
                    <li class="selected">Comptes-Rendus</li>
                </div>
                <div>
                    <img src="Images/Icons/doctor.png" alt="Praticien">
                    <li>Praticiens</li>
                </div>
                <div>
                    <img src="Images/Icons/visitor.png" alt="Visiteurs">
                    <li>Visiteurs</li>
                </div>
                <div>
                    <img src="Images/Icons/medicament.png" alt="Medicaments">
                    <li>Medicaments</li>
                </div>
            </ul>
            <h2>Mon Compte</h2>
            <ul id="monCompte">
                <div>
                    <img src="Images/Icons/avatar.png" alt="Medicaments">
                    <li>Jhon Doe</li>
                </div>
            </ul>
        </div>


    </div>


    <div id="content">
        <div id="inner_content">
            <?php

            include("bddLogin.php");

            $reponse = $bdd->query('SELECT * FROM rapport_visite');

            if (isset($_POST["numero_rapport"])) {
                $numero_Rapport = $_POST["numero_rapport"];
                $numeroRapport = $bdd->query('SELECT * FROM praticien INNER JOIN rapport_visite ON praticien.PRA_NUM = rapport_visite.PRA_NUM WHERE rapport_visite.RAP_NUM =' . $numero_Rapport . ';');

                while ($data = $numeroRapport->fetch()) {
                    $valeurDate = $data["RAP_DATE"];
                    $valeurBilan = $data["RAP_BILAN"];
                    $praNum = $data["PRA_NUM"];
                    $rapMotif = $data["RAP_MOTIF"];
                    $nomPracticien = $data["PRA_NOM"];
                    $prenomPraticien = $data["PRA_PRENOM"];
                    
                }
            } else {
                $valeurDate = "";
                $valeurBilan = " ";
                $praNum = " ";
                $rapMotif = " ";
                $nomPracticien = " ";
                $prenomPraticien = " ";
            }
            ?>

            <form action="Rendus.php" method="post">
                <label for="numero_rapport" id="numeroRapport">Numero Rapport : </label>
                <div id="divRapport">

                    <select name="numero_rapport" id="searchRapport">
                        <?php
                        if (isset($_POST["numero_rapport"])) {
                            echo "<option selected='selected' disabled hidden>" . $_POST["numero_rapport"] . "</option>";
                        }
                        while ($data = $reponse->fetch()) {
                            echo "<option>" . $data["RAP_NUM"] . "</option>";
                        }

                        ?>
                    </select>

                    <input type="submit" value="Chercher" id="search">
                </div>
                <hr>
                <!-- Date -->

                <label for="date_rapport" id="dateLabel">Date : </label>
                <?php

                echo "<input type='text' name='date_rapport' id='dateInput' value='" . strval($valeurDate) . "'>";
                ?>
                <!-- Practicien -->
                <label for="practicien" id="labelPraticien">Practicien :</label>
                <?php echo "<input type='text' name='praticien' id='inputPraticien' value='" . strval($nomPracticien) ." " .strval($prenomPraticien) . "'>";
                ?>


                <!-- Motif -->
                <label for="motif" id="labelMotif">Motif Visite : </label>
                <?php
                echo "<input type='text' name='motif' id='inputMotif' value='" . strval($rapMotif) . "'>";
                ?>
                <!-- Bilan -->
                <div id="bilan">
                <label for="bilan" id="labelBilan">Bilan : </label>
                <?php
                echo "<textarea type='text' id='inputBilan' name='bilan'>" . $valeurBilan  . "</textarea>";
                ?>
            </div>
                <!-- Offre d'échantillion -->
                <label for="offreEchan">Offre echantillion : </label>
                <input type="text" name="offreEchan">

            </form>
        </div>
    </div>
</body>

</html>