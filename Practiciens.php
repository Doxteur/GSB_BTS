<!DOCTYPE html>
<html lang="en">

<head>
       <meta charset="UTF-8">
       <meta http-equiv="X-UA-Compatible" content="IE=edge">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <title>Document</title>
</head>

<body>



       <?php

       try {
              $bdd = new PDO('mysql:host=localhost;dbname=swiss_visite;charset=utf8', 'root', '');
       } catch (Exception $e) {
              die('Erreur : ' . $e->getMessage());
       }
       
       $reponse = $bdd->query('SELECT * FROM praticien');
       
       while ($data = $reponse->fetch()) {
              
              $nomPraticien = $data["PRA_NOM"];
              $prenomPraticien = $data["PRA_PRENOM"];
              $adressePraticien = $data["PRA_ADRESSE"];
              $cpPraticien = $data["PRA_CP"];
              $coefPraticien = $data["PRA_COEFNOTORIETE"];
              $villePraticien = $data["PRA_VILLE"];
              break;
       }
       

       ?>



       <form method="post" action="Practiciens.php">
              <label for="chercher_practicien">chercher</label><br /> <!-- liste déroulante des practiciens -->
              <select name="nom" id="nom">
                     <option value="france">France</option>
                     <option value="espagne">Espagne</option>
                     <option value="italie">Italie</option>
                     <option value="royaume-uni">Royaume-Uni</option>
                     <option value="canada">Canada</option>
                     <option value="etats-unis">États-Unis</option>
                     <option value="chine">Chine</option>
                     <option value="japon">Japon</option>
              </select>
              </br>
              <label for="nom">Nom_practicien :</label>
              <input type="text" name="nom" id="nom" value=<?php echo $nomPraticien; ?> /> <!-- Nom du practicien -->
              </br>
              <label for="prenom">Prenom_practitien :</label>
              <input type="text" name="prenom" id="prenom" value=<?php echo $prenomPraticien ?> /> <!-- Prenom du practicien -->
              </br>
              <label for="adresse">Adresse_practitien</label>
              <input type="text" name="adresse" id="adresse" value=<?php echo $adressePraticien ?> /> <!-- Adresse du praticien -->

              </br>
              <label for="ville">Ville_practicien :</label>
              <input type="text" name="ville" id="ville" value=<?php echo $cpPraticien ?> /> <!-- Ville du practicien -->
              </br>
              <label for="coeff.notoriete">Coeff.Notoriete :</label>
              <input type="text" name="coeff.notoriete" id="coeff.notoriete" value=<?php echo $coefPraticien ?> /> <!-- Coeff de notoriété du practicien -->
              </br>
              <label for="lieu_exercice">Lieu_exercice :</label>
              <input type="text" name="lieu_exercice" id="lieu_exercice" value=<?php echo $villePraticien ?> /> <!-- Lieu d'exercice du practicien -->
              <input type="submit" value="Precedent" name="Precedent">
              <input type="number" name="numero" id="">
              <input type="submit" value="Suivant" name="Suivant">

       </form>

       <?php

       ?>

</body>

</html>