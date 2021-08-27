<?php


header('resources/css/VisiteurPage.css');


$_SESSION['role'] == 'visiteur' ?: header('Location: /GSB_BTS/');


// BDD Requete
// Recuperer les rapports des visiteurs
$visMatricule = $_SESSION['matricule'];
// $visMatricule = "a131";

if (!isset($_POST["numeroRapport"])) {
    $request = $bdd->prepare('SELECT * FROM praticien INNER JOIN rapport_visite ON praticien.PRA_NUM = rapport_visite.PRA_NUM WHERE VIS_MATRICULE = ?');
    $request->execute([$visMatricule]);
} else {
    $request = $bdd->prepare('SELECT * FROM praticien INNER JOIN rapport_visite ON praticien.PRA_NUM = rapport_visite.PRA_NUM WHERE VIS_MATRICULE = ? AND RAP_NUM = ?');
    $request->execute([$visMatricule, $_POST["numeroRapport"]]);
}

$reponse = $request->fetchAll();

$medicament = $bdd->prepare('SELECT * FROM offrir INNER JOIN medicament ON offrir.MED_DEPOTLEGAL = medicament.MED_DEPOTLEGAL WHERE offrir.RAP_NUM = ?');
$medicament->execute([$reponse[0]['RAP_NUM']]);
$medicament = $medicament->fetchAll(PDO::FETCH_ASSOC);

// Variable BDD
// Si l'utilisateur n'a pas spécifier de rapport

$matricule = $_SESSION['matricule'];
$nom = $_SESSION['nom'];
$prenom = $_SESSION['prenom'];
$date = substr($reponse[0]['RAP_DATE'], 0, 10);
$praticien = $reponse[0]['PRA_PRENOM'] . " " . $reponse[0]['PRA_NOM'];
$praticienNum = $reponse[0]['PRA_NUM'];
$motif = $reponse[0]['RAP_MOTIF'];
$bilan = $reponse[0]['RAP_BILAN'];

?>

<div class="container-fluid mt-4" style="color:#80a2cd; font-weight:bold;font-family:Arial, Helvetica, sans-serif;">
    <form class="FormRendus container-fluid " method="POST">
        <div class="row">
            <div class="col-md-3 mb-4">
                <label for="numeroRapport">Numero Rapport:</label>
                <div class="d-flex ">
                    <select name="numeroRapport" id="numero_rapportSelect" class="form-select w-auto">
                        <?php
                        // Récupération de tous les rapports
                        $listRapportRequest = $bdd->prepare('SELECT * FROM praticien INNER JOIN rapport_visite ON praticien.PRA_NUM = rapport_visite.PRA_NUM WHERE VIS_MATRICULE = ?');
                        $listRapportRequest->execute([$visMatricule]);
                        $listRapport = $listRapportRequest->fetchAll();
                        // Affiche les numéros de rapports du visiteur
                        if (is_array($listRapport)) {
                            $default = isset($_POST["numeroRapport"]) ? $_POST["numeroRapport"] : $listRapport[0]['RAP_NUM'];
                            echo '<option selected disabled hidden>' . $default . '</option>';
                            foreach ($listRapport as $value) {
                                echo '<option class="' . $value['RAP_NUM'] . '""value="' . $value['RAP_NUM'] . '">' . $value['RAP_NUM'] . '</option>';
                            }
                        } else {
                            echo '<option value="' . $reponse['RAP_NUM'] . '">' . $reponse['RAP_NUM'] . '</option>';
                        }
                        ?>
                    </select>
                    <button class="btn btn-success mx-4">Chercher</button>
                </div>
            </div>
            <hr>
        </div>
        <div class="row">
            <div class="col-md-2">
                <label for="input disabledDate" class="form-label">Date :</label>
                <input disabled type="text" class="form-control w-100" id="input disabledDate" value="<?= $date ?>">
            </div>
            <div class="col-md-auto mx-auto">
                <label for="echantillions" class="form-label">Offre d'échantillions</label>
                <select name="echantillions" id="Selectechantillions" class="form-select w-auto">
                    <?php
                    // Affiche les offres d'échantillons
                    if (is_array($medicament)) {
                        foreach ($medicament as $value) {
                            echo '<option  value="' . $value['MED_NOMCOMMERCIAL'] . '">' . $value['MED_NOMCOMMERCIAL'] . ": " . $value['OFF_QTE'] . '</option>';
                        }
                    } else {
                        echo '<option value="' . $medicament['MED_NOMCOMMERCIAL'] . '">' . $medicament['MED_NOMCOMMERCIAL'] . ": " . $value['OFF_QTE'] . '</option>';
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <label for="selectPraticien" class="form-label">Praticien :</label>
                <div class="d-flex">
                    <input disabled type="text" class="form-control me-4 w-auto" value="<?= $praticien ?>">
                    <button class="btn btn-primary" id="detailsPraticien" type="button" value='<?= $praticienNum ?>' onclick="showPraticienModal()">En Details </button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-auto">
                <label for="input disabledAddress2" class="form-label">Motif Visite:</label>
                <textarea disabled type="textarea disabled" class="form-control" id="input disabledAddress2"><?= $motif ?></textarea disabled>
            </div>
            <div class="col-md-auto mx-auto">
                <label for="input disabledCity" class="form-label">Bilan : </label>
                <textarea disabled rows="3" cols="40" class="form-control text-justify w-auto" id="input disabledCity"><?= $bilan ?></textarea disabled>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mt-4">
                <button type="button" class="btn btn-secondary" onclick="prevRapport()">Précédent</button>
                <button type="button" class="btn btn-primary" onclick="nextRapport()">Suivant</button>
            </div>
        </div>
    </form>
</div>




<div id="praticienModal">

</div>

<script>

    
function showPraticienModal() {

let NumPraticien = $('#detailsPraticien').val();
    // Ajax call to generate modal
    $.ajax({
        url: 'app/functions/AjaxmodalPraticien.php',
        type: 'POST',
        data: {
            NumeroPraticien: JSON.stringify(NumPraticien)
        },
        success: function(data) {
            console.log(data);
            $('#praticienModal').html(data);
            $('#modal_praticien').modal('show');
        }
    
    });
}
function prevRapport(){
    let previousNumber = $('#numero_rapportSelect .'+$("#numero_rapportSelect option:selected").val()+'').prev().attr('selected','selected');
    $(".FormRendus").submit();
}
function nextRapport(){
    let nextNumber = $('#numero_rapportSelect .'+$("#numero_rapportSelect option:selected").val()+'').next().attr('selected','selected');
    $(".FormRendus").submit();
}

// // Ajax Call to Next rapport php
// function nextRapportRequest(numeroRapport) {
//     $.ajax({
//         url: 'app/functions/AjaxRapport.php',
//         type: 'POST',
//         data: {
//             numeroRapport: JSON.stringify($("#numero_rapportSelect option:selected").val())
//         },
//         success: function(data) {
//             console.log(data);
//         }
//     });
// }


</script>