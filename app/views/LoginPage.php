

    <form action="index.php" id="loginForm" method="POST" class="mx-4 mt-4">
        <label for="Username" class="form-label" >Username:</label>
        <input type="text" name="Username" class="form-control">
        <label for="Password" class="form-label">Password:</label>
        <input type="password" name="Password" class="form-control">

        <input type="submit" name="envoyer" value="Se Connecer" class="btn btn-primary mt-4" >
    </form>


    <!-- Partie PHP -->
    <?php
    include("bddLogin.php");
    $reqUsernameVisteur = $bdd->prepare('SELECT VIS_NOM,VIS_DATEEMBAUCHE,VIS_MATRICULE,Vis_PRENOM FROM visiteur WHERE VIS_NOM = :Username AND VIS_DATEEMBAUCHE = :DateEmbauche');
    $dateMonth = array(
        "jan" => "01",
        "feb" => "02",
        "mar" => "03",
        "apr" => "04",
        "may" => "05",
        "jun" => "06",
        "jul" => "07",
        "aug" => "08",
        "sep" => "09",
        "oct" => "10",
        "nov" => "11",
        "dec" => "12",
    );
    function formatDate($DateToFormat,$dateMonth,$DateEmbauche)
    {
        $dateExplode = explode('-', $DateEmbauche);
        if(count($dateExplode) < 3){
            throw new Exception('Mauvais Format date!');
        }
        $jour = $dateExplode[0];
        $mois = $dateExplode[1];
        $annee = $dateExplode[2];
        $DateEmbauche = $annee . "-" . $dateMonth[$mois] . "-" . $jour . " 00:00:00";
        return $DateEmbauche;
    }
    if (isset($_POST["Username"])) {
        $Username = $_POST["Username"];
        $DateEmbauche = $_POST["Password"];

        try {
            $DateEmbauche = formatDate($DateEmbauche,$dateMonth,$DateEmbauche);
        } catch (Exception $e) {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
        
        $reqUsernameVisteur->bindParam(':Username', $Username);
        $reqUsernameVisteur->bindParam(':DateEmbauche', $DateEmbauche);
        $reqUsernameVisteur->execute();
        $result = $reqUsernameVisteur->fetchAll(PDO::FETCH_OBJ);
        var_dump($result);
        if ($result == null) {
            echo "Mauvais Nom ou Mot de passe";
        } else {

            echo "Vous etes connecter";
            $_SESSION['role'] = 'visiteur';
            
            $_SESSION['matricule'] = ($result[0]->VIS_MATRICULE);
            $_SESSION['nom'] = ($result[0]->VIS_NOM);
            $_SESSION['prenom'] = ($result[0]->Vis_PRENOM);
            
            header("Location:Rendus.php");
        }
    }

    ?>

