<h1>Bienvenue sur GSB</h1>
<?php
echo isset($_SESSION['role'])? "<h2><a href='rapport'>Voir les Rapports</h2>" : "<h2><a href='login'>Se Connecter</h2>";
?>