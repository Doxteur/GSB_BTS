<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visiteurs</title>
    <link rel="stylesheet" href="css/Visiteurs.css">
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

            $reponse = $bdd->prepare('SELECT * FROM visiteur');
            $reponse->execute();

            if (isset($_POST["Search"])) {
                $num_Visiteur = $_POST["Search"];
                $labVisiteur = $bdd->prepare('SELECT * FROM visiteur INNER JOIN labo ON visiteur.LAB_CODE = labo.LAB_CODE WHERE visteur.VIS_MATRICULE =' . $num_Visiteur . ';');
                $labVisiteur->execute();
                $secVisiteur = $bdd->prepare('SELECT * FROM visiteur INNER JOIN secteur ON visteur.SEC_CODE = secteur.SEC_CODE WHERE visteur.VIS_MATRICULE =' . $num_Visiteur . ';');
                $secVisiteur->execute();

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
                $NOM = " ";
                $PRENOM = " ";
                $ADRESSE = " ";
                $VILLE = " ";
                $CODEP = " ";
                $SECTEUR = " ";
                $LABO = " ";
            }
            ?>

            <form action="Visiteurs.php" method="post">
                <!-- Chercher -->
                <label for="Chercher" id="numeroRapport">Nom visiteur : </label>
                <div id="divRapport">

                    <select name="Search" id="searchRapport">
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

                    <input type="submit" value="Chercher" id="search">
                </div>
                <hr>
                <!-- Nom -->

                <label for="nom" id="nomLabel">Nom - Prénom : </label>
                <?php

                echo "<input type='text' name='nom' id='nomInput' value='" . strval($NOM) . " " .strval($PRENOM) . "'>";
                ?>
                <!-- Adresse -->
                <label for="adresse" id="adresseLabel">Adresse :</label>
                <?php echo "<input type='text' name='adresse' id='adresseInput' value='" . strval($ADRESSE) . "'>";
                ?>

                <!-- Ville -->
                <label for="ville" id="villeLabel">Ville : </label>
                <?php
                echo "<input type='text' name='ville' id='villeInput' value='" . strval($VILLE) . ", " . strval($CODEP) . "'>";
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
        </div>
        </form>

    </div>

    <div id="showPraticien" style="display:none">


    </div>



    </div>



</body>

<script>
    function showPraticien() {
        document.getElementById("showPraticien").style.display = "initial";
    }

    function Suivant() {
        console.log($('#searchRapport').index);
    }

    function Precedent() {

    }
</script>

</html>