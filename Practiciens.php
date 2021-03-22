<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form method="post" action="traitement.php">
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
       <input type="text" name="nom" id="nom" /> <!-- Nom du practicien -->
</br>      
       <label for="prenom">Prenom_practitien :</label>
       <input type="text" name="prenom" id="prenom" /> <!-- Prenom du practicien -->
</br>      
       <label for="adresse">Adresse_practitien</label>
       <input type="text" name="adresse" id="adresse" /> <!-- Adresse du praticien -->

</br>
       <label for="ville">Ville_practicien :</label>
       <input type="text" name="ville" id="ville" /> <!-- Ville du practicien -->
</br>
       <label for="coeff.notoriete">Coeff.Notoriete :</label>
       <input type="text" name="coeff.notoriete" id="coeff.notoriete" /> <!-- Coeff de notoriété du practicien -->
</br>
       <label for="lieu_exercice">Lieu_exercice :</label>
       <input type="text" name="lieu_exercice" id="lieu_exercice" /> <!-- Lieu d'exercice du practicien -->
       
</form>
    
<input type="button" value="Précédent">
<input type="button" value="Suivant">


</body>
</html>