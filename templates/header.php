<div id="header">
    <a href="landing">
        <img src="resources/Images/logo_2.png" alt="" id="logo">
    </a>
    <div id="compteHeader">
        <img src="resources/Images/Icons/avatar.png" alt="">
        <h1><?= $_SESSION["nom"] . " " . $_SESSION["prenom"] ?></h1>
    </div>
</div>

<div id="nav">
    <div id="inner_nav">
        <h2>Informations</h2>
        <ul>
            <div>
                <img src="resources/Images/Icons/rapport.png" alt="Comptes-Rendus">
                <li class="selected">Comptes-Rendus</li>
            </div>
            <div>
                <img src="resources/Images/Icons/doctor.png" alt="Praticien">
                <li>Praticiens</li>
            </div>
            <div>
                <img src="resources/Images/Icons/visitor.png" alt="Visiteurs">
                <li>Visiteurs</li>
            </div>
            <div>
                <img src="resources/Images/Icons/medicament.png" alt="Medicaments">
                <li>Medicaments</li>
            </div>
        </ul>
        <h2>Mon Compte</h2>
        <ul id="monCompte">
            <div>
                <img src="resources/Images/Icons/avatar.png" alt="Medicaments">
                <li><?= $_SESSION["nom"] . " " . $_SESSION["prenom"] ?></li>
            </div>
        </ul>
    </div>

</div>