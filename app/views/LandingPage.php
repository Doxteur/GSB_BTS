<div id="centerDiv">
    <?php if (isset($_SESSION['role'])) {
        echo "<div id='loginName'>";
        echo "<h2> Connecter en tant que : </h2>";
        echo "<h2 id='name'>" . $_SESSION['nom'] . " " . $_SESSION['prenom'] . "</h2>";
        echo "</div>";
    }
    ?>
    <div>
        <h1>Bienvenue sur GSB</h1>
        <?php
        echo isset($_SESSION['role']) ? "<h2><a href='rapport'>Voir mes Rapports</a></h2>" : "<h2><a href='login'>Se Connecter</a></h2>";
        ?>
    </div>
</div>