<?php

// $request = $bdd->prepare('SELECT * FROM visiteur WHERE VIS_MATRICULE = ?');
// $request->execute([$_SESSION['matricule']]);
// $reponse = $request->fetch(PDO::FETCH_ASSOC);

// var_dump($reponse);
header('resources/css/VisiteurPage.css');

$_SESSION['role'] == 'visiteur' ?: header('Location: /GSB_BTS/');
?>
<div class="container-fluid " style="color:#80a2cd; font-weight:bold;font-family:Arial, Helvetica, sans-serif;">
    <form class="FormRendus container-fluid " >
        <div class="row">
            <div class="col-md-6 mb-4">
                <label for="numero_rapport">Numero Rapport:</label>
                <select name="numero_rapport" id="numero_rapportSelect" class="form-select">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>
            </div>
            <hr>
        </div>
        <div class="row">
            <div class="col-md-4 ">
                <label for="inputEmail4" class="form-label">Date</label>
                <input type="email" class="form-control" id="inputEmail4">
            </div>
            <div class="col-md-2 mx-auto">
                <label for="echantillions" class="form-label">Offre d'échantillions</label>
                <select name="echantillions" id="Selectechantillions" class="form-select">
                    <option value="">1</option>
                    <option value="">2</option>
                    <option value="">3</option>
                    <option value="">4</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <label for="selectPraticien" class="form-label">Praticien</label>
                <div class="d-flex">
                <select name="selectPraticien" id="selectPraticien" class="form-select me-4">
                <option value="1">Bernard</option>
                    <option value="2">Jimmy</option>
                    <option value="3">Bertrand</option>
                    
                </select>
                <button class="btn btn-primary ">Chercher</button>
                </div>
            </div>
          
            <div class="col-12">
                <label for="inputAddress2" class="form-label">Address 2</label>
                <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
            </div>
            <div class="col-md-6">
                <label for="inputCity" class="form-label">City</label>
                <input type="text" class="form-control" id="inputCity">
            </div>
            <div class="col-md-4">
                <label for="inputState" class="form-label">State</label>
                <select id="inputState" class="form-select">
                    <option selected>Choose...</option>
                    <option>...</option>
                </select>
            </div>
            <div class="col-md-2">
                <label for="inputZip" class="form-label">Zip</label>
                <input type="text" class="form-control" id="inputZip">
            </div>
            <div class="col-12">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck">
                    <label class="form-check-label" for="gridCheck">
                        Check me out
                    </label>
                </div>
            </div>
            <div class="col-12">

                <button type="submit" class="btn btn-success">Chercher</button>
                <button type="button" class="btn btn-primary">Suivant</button>
            </div>
        </div>
    </form>
</div>