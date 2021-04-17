<?php
session_start();


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/Rendus.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<body>

    <div id="header">
        <a href="index.php">
            <img src="Images/logo_2.png" alt="" id="logo">
        </a>
        <div id="compteHeader">
            <img src="Images/Icons/avatar.png" alt="">
            <h1><?= $_SESSION["nom"] . " " . $_SESSION["prenom"] ?></h1>
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
                    <li><?= $_SESSION["nom"] . " " . $_SESSION["prenom"] ?></li>
                </div>
            </ul>
        </div>


    </div>


    <div id="content">
        <div id="inner_content">
            <?php
            include("bddLogin.php");

            if (!$_SESSION['role'] == "visiteur") {
                visiteurPage();
            } else {
                praticienPage();
            }
            ?>

            <div id="showPraticien" style="display:none">
            </div>
        </div>

        <script>
            function showPraticien() {
                document.getElementById("showPraticien").style.display = "initial";
            }

            function Suivant() {
                // document.getElementById("searchRapport").selectedIndex += document.getElementById(document.getElementById("searchRapport").selectedIndex).id;
                var x = document.getElementById("searchRapport").selectedIndex;
                var y = document.getElementById("searchRapport").options;

                for (let i = 1; i < y.length; i++) {
                    console.log(y[i].value + " " + y[0].value);
                    if (y[i].value == y[x].value) {
                        let temp = i;
                        temp += 1;
                        document.getElementById("searchRapport").selectedIndex += temp;
                        break;
                    }
                }
                document.forms["formulaire"].submit();

            }
        </script>
        <?php
        function praticienPage()
        {
            include("bddLogin.php");

            $reponse = $bdd->prepare('SELECT * FROM rapport_visite');
            $reponse->execute();
            if (isset($_POST["numero_rapport"])) {
                $numero_Rapport = $_POST["numero_rapport"];
                $numeroRapport = $bdd->prepare('SELECT * FROM praticien INNER JOIN rapport_visite ON praticien.PRA_NUM = rapport_visite.PRA_NUM WHERE rapport_visite.RAP_NUM =' . $numero_Rapport . ';');
                $numeroRapport->execute();
                $medicament = $bdd->prepare('SELECT * FROM offrir INNER JOIN medicament ON offrir.MED_DEPOTLEGAL = medicament.MED_DEPOTLEGAL WHERE offrir.RAP_NUM =' . $numero_Rapport . ';');
                $medicament->execute();

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

            <form action="Rendus.php" method="post" id="formulaire">
                <label for="numero_rapport" id="numeroRapport">Numero Rapport : </label>
                <div id="divRapport">
                    <select name="numero_rapport" id="searchRapport">
                        <?php
                        if (isset($_POST["numero_rapport"])) {
                            echo "<option selected='selected' disabled hidden value=" . $_POST["numero_rapport"] . " id=" . $_POST["numero_rapport"] . ">" . $_POST["numero_rapport"] . "</option>";
                        }
                        while ($data = $reponse->fetch()) {
                            echo "<option value=" . $data["RAP_NUM"] . ">" . $data["RAP_NUM"] . "</option>";
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
                <div>
                    <?php echo "<input type='text' name='praticien' id='inputPraticien'value='" . strval($nomPracticien) . " " . strval($prenomPraticien) . "'>";
                    ?>
                    <input type="button" value="En Details" id="search" onclick="showPraticien()">
                </div>

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
                <label for="offreEchan" id="offre">Offre echantillion : </label>
                <div id="medicament">
                    <?php
                    if (isset($_POST["numero_rapport"])) {

                        while ($data = $medicament->fetch()) {
                            $NomMedic = $data["MED_NOMCOMMERCIAL"];
                            $nombre = $data["OFF_QTE"];
                            echo "<div id='" . $NomMedic . "'>";
                            echo "<h1> " . $NomMedic . " : </h1> </br>";
                            echo "<h1> " . $nombre . "</h1>";
                            echo "</div>";
                        }
                    }
                    ?>

                </div>
            </form>
            <div id="myButton">
                <h1 onclick="Suivant()" id="suivant">Suivant</h1>
                <h1 onclick="Nouveau()" id="nouveau">Nouveau</h1>
                <h1 onclick="MettreAJour()" id="Update">Envoyer</h1>
            </div>

    </div>


<?php }
        function visiteurPage()
        {
            include("bddLogin.php");
            $reponse = $bdd->prepare('SELECT * FROM praticien INNER JOIN rapport_visite ON praticien.PRA_NUM = rapport_visite.PRA_NUM WHERE VIS_MATRICULE = "' . $_SESSION["matricule"] . '";');
            $reponse->execute();

            if (!isset($_POST["numero_rapport"])) {
                $visiteurRapports = $bdd->prepare('SELECT * FROM praticien INNER JOIN rapport_visite ON praticien.PRA_NUM = rapport_visite.PRA_NUM WHERE VIS_MATRICULE = "' . $_SESSION["matricule"] . '";');
                $visiteurRapports->execute();
            } else {
                $visiteurRapports = $bdd->prepare('SELECT * FROM praticien INNER JOIN rapport_visite ON praticien.PRA_NUM = rapport_visite.PRA_NUM WHERE RAP_NUM = "' . $_POST["numero_rapport"] . '";');
                $visiteurRapports->execute();
            }

            $medicament = $bdd->prepare('SELECT * FROM offrir INNER JOIN medicament ON offrir.MED_DEPOTLEGAL = medicament.MED_DEPOTLEGAL WHERE offrir.VIS_MATRICULE ="' . $_SESSION["matricule"] . '";');
            $medicament->execute();

            while ($data = $visiteurRapports->fetch()) {
                $valeurDate = $data["RAP_DATE"];
                $valeurBilan = $data["RAP_BILAN"];
                $praNum = $data["PRA_NUM"];
                $rapMotif = $data["RAP_MOTIF"];
                $nomPracticien = $data["PRA_NOM"];
                $prenomPraticien = $data["PRA_PRENOM"];
            }
?>

    <form action="Rendus.php" method="post" id="formulaire">
        <label for="numero_rapport" id="numeroRapport">Numero Rapport : </label>
        <div id="divRapport">
            <select name="numero_rapport" id="searchRapport">
                <?php
                $visiteurRapports->execute();
                if (isset($_POST["numero_rapport"])) {
                    echo "<option selected='selected' disabled hidden value=" . $_POST["numero_rapport"] . " id=" . $_POST["numero_rapport"] . ">" . $_POST["numero_rapport"] . "</option>";
                }
                while ($data = $reponse->fetch()) {
                    echo "<option value=" . $data["RAP_NUM"] . " id=" . $increment . ">" . $data["RAP_NUM"] . "</option>";
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
        <div>
            <?php echo "<input type='text' name='praticien' id='inputPraticien'value='" . strval($nomPracticien) . " " . strval($prenomPraticien) . "'>";
            ?>
            <input type="button" value="En Details" id="search" onclick="showPraticien()">
        </div>

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
        <label for="offreEchan" id="offre">Offre echantillion : </label>
        <div id="medicament">
            <?php

            while ($data = $medicament->fetch()) {
                $NomMedic = $data["MED_NOMCOMMERCIAL"];
                $nombre = $data["OFF_QTE"];
                echo "<div id='" . $NomMedic . "'>";
                echo "<h1> " . $NomMedic . " : </h1> </br>";
                echo "<h1> " . $nombre . "</h1>";
                echo "</div>";
            }
            ?>

        </div>
    </form>
    <div>
        <h1 onclick="Suivant()" id="suivant">Suivant</h1>
        <h1 onclick="Nouveau()" id="nouveau">Nouveau</h1>
    </div>
<?php
        }
?>
<script>
    function Nouveau() {
        document.getElementById("Update").style.visibility = "visible"
        document.getElementById("dateInput").value = " ";
        document.getElementById("inputPraticien").value = " ";
        document.getElementById("inputMotif").value = " ";
        document.getElementById("inputBilan").value = " ";
        document.getElementById("inputBilan").value = " ";
        document.getElementById("inputBilan").value = " ";
        var x = document.getElementById("searchRapport");
        var option = document.createElement("option");
        var lastValue = $('#searchRapport option:last-child').val();
        lastValue = 1 + +lastValue
        option.text = lastValue;
        option.value = lastValue;
        console.log(typeof(lastValue))
        x.add(option);
        $('#searchRapport').val($('#searchRapport option:last-child').val());

    }

    function MettreAjour() {

    }
</script>
</body>

</html>