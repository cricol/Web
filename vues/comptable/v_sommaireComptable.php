﻿    <!-- Division pour le sommaire comptable -->
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
            <a href="index.php?uc=validerfrais&action=vuevaliderfrais" title="Saisie fiche de frais">Validation fiche de frais</a>
        </li>
        <li class="smenu">
            <a href="index.php?uc=suiviPaiement&action=suivrePaiement" title="Suivie Paiement fiche de frais">Suivre le Paiement Fiche de Frais</a>
        </li>
        <li class="smenu">
            <a href="index.php?uc=connexion&action=deconnexion" title="Se déconnecter">Déconnexion</a>
        </li>
    </ul>

</div>


