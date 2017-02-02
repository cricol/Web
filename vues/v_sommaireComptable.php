    <!-- Division pour le sommaire comptable -->
<div id="menuGauche">
    <div id="infosUtil">

        <h2>

        </h2>

    </div>  
    <ul id="menuList">
        <li >
            Comptable :<br>
            <?php echo $_SESSION['prenom'] . "  " . $_SESSION['nom'] ?>
        </li>
        <li class="smenu">
            <a href="index.php?uc=validerFrais&action=selectionnerVisiteur" title="Saisie fiche de frais ">Validation fiche de frais</a>
        </li>
        <li class="smenu">
            <a href="index.php?uc=suivreFrais&action=fuck2" title="Consultation de mes fiches de frais">Suivi paiment fiche de frais</a>
        </li>
        <li class="smenu">
            <a href="index.php?uc=connexion&action=deconnexion" title="Se déconnecter">Déconnexion</a>
        </li>
    </ul>

</div>


