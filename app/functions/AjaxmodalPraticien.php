<?php
include("../../bddLogin.php");
$NumeroPraticien = json_decode($_POST['NumeroPraticien']);

// Modal Boostrap
$request = $bdd->prepare('SELECT * FROM praticien INNER JOIN type_praticien ON praticien.TYP_CODE = type_praticien.TYP_CODE WHERE PRA_NUM = ?');
$request->execute([$NumeroPraticien]);
$praticien = $request->fetchAll(PDO::FETCH_ASSOC);

$Nom = $praticien[0]['PRA_NOM'];
$Prenom = $praticien[0]['PRA_PRENOM'];
$Adresse = $praticien[0]['PRA_ADRESSE'];
$Ville = $praticien[0]['PRA_CP']." ".$praticien[0]['PRA_VILLE'];
$CoefNoto = $praticien[0]['PRA_COEFNOTORIETE'];
$LieuxExercice = $praticien[0]['TYP_LIBELLE'];

$modal = <<<HTML
    <div class="modal fade" id="modal_praticien" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Praticien : </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form >
                        <div class="row ">
                            <div class="col-md-auto mx-auto">
                                <label for="Numero" class="form-label">Nom</label>
                                <input disabled type="text" class="form-control" id="Numero" value="{$Nom}">
                            </div>
                            <div class="col-md-auto mx-auto mb-2">
                                <label for="Numero" class="form-label">Prenom</label>
                                <input disabled type="text" class="form-control" id="Numero" value="{$Prenom}">
                            </div>
                        </div>
                        <div class="row">
                            
                        <div class="col-md-auto mx-auto">
                                <label for="coeff" class="form-label">Adresse</label>
                                <input disabled type="text" class="form-control" id="coeff" value="{$Adresse}">
                            </div>
                            
                            <div class="col-md-auto mx-auto mb-2">
                                <label for="coeff" class="form-label">Ville</label>
                                <input disabled type="text" class="form-control" id="coeff" value="{$Ville}">
                            </div>
                        </div>
                    <div class="row ">

                            <div class="col-md-auto mx-auto">
                                <label for="coeff" class="form-label">Coeff. Notoriete</label>
                                <input disabled type="text" class="form-control" id="coeff" value="{$CoefNoto}">
                            </div>
                       
                        <div class="col-md-auto mx-auto mb-2">
                            <label for="lieux" class="form-label">Lieux D'exercice</label>
                            <input disabled type="text" class="form-control" id="lieux" value="{$LieuxExercice}">
                        </div>
                    </div>
                     
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
HTML;

echo $modal;
