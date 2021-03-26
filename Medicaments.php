<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Médicaments</title>
    <link rel="stylesheet" href="css/Medicaments.css">
</head>
<body>




<p class="titre" > Médicaments : <p>
<form action="Medicaments.php" method="post">
     <!-- Code du médicament-->
     <label for="code">Code : </label>




     <select name="pets" id="pet-select">
     <option value="nothing"><?php
 try {
         $bdd = new PDO('mysql:host=localhost;dbname=swiss_visite;charset=utf8', 'root', '');
     } catch (Exception $e) {
         die('Erreur : ' . $e->getMessage());
     }
     
     $reponse = $bdd->query('SELECT * FROM medicament');
 
     while ($data = $reponse->fetch()) {
         echo "<option>". $data["MED_DEPOTLEGAL"] . "</option>"; 
     }
?>
</option> 
</select>





     <br>
     <!-- Nom commercial du médicament -->
     <label for="nom_commercial">Nom Commercial : </label>
     <input type="text" name="nom_commercial"> <br>
     <!-- Famille de médicaments -->
     <label for="famille">Famille :</label>

     
    <select name="pets" id="pet-select">
<option value="nothing"><?php
 try {
         $bdd = new PDO('mysql:host=localhost;dbname=swiss_visite;charset=utf8', 'root', '');
     } catch (Exception $e) {
         die('Erreur : ' . $e->getMessage());
     }
     
     $reponse = $bdd->query('SELECT * FROM famille INNER JOIN medicament ON FAM_CODE.medicament = FAM_CODE.famille WHERE  ');
 
     while ($data = $reponse->fetch()) {
         echo "<option>". $data["FAM_LIBELLE"] . "</option>"; 
     }
?>
</option> 
    </select>
 
 




 <br>
     <!-- Composition du médicament -->
     <label for="composition_medicament">Composition : </label>
     <input type="text" name="composition_medicament"> <br>
     <!-- Effets indésirables du médicament -->
     <label for="effets_indesirables">Effets indésirables : </label>
     <input type="text" name="effets_indesirables"> <br>
     <!-- Contre Indications du médicament -->
     <label for="contre_indication">Contre Indications : </label>
     <input type="text" name="contre_indication"> <br>
     <!-- Prix Echantillon -->
     <label for="prix_echantillon">Prix Echantillon : </label>
     <input type="text" name="prix_echantillon"> <br>
</form>



<input type="button" value="Précédent">
<input type="button" value="Suivant">










</body>
</html>