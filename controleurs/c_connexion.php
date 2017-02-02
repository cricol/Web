<?php
if (!isset($_REQUEST['action'])) {
    $_REQUEST['action'] = 'demandeConnexion';
}
$action = $_REQUEST['action'];
switch ($action) {
    case 'demandeConnexion': {
            include("vues/v_connexion.php");
            break;
        }
    case 'valideConnexion': {
            $login = $_REQUEST['login'];
            $mdp = $_REQUEST['mdp'];
            $compte = $pdo->getInfosCompte($login, $mdp);
            if (!is_array($compte) ) {
                ajouterErreur("Login ou mot de passe incorrect");
                include("vues/v_erreurs.php");
                include("vues/v_connexion.php");
            } elseif (is_array($compte) && $compte['fonction'] == 1) {
                $id = $compte['id'];
                $nom = $compte['nom'];
                $prenom = $compte['prenom'];
                $fonction = $compte['fonction'];
                connecter($id, $nom, $prenom,$fonction);
                include("vues/v_sommaire.php");
            } elseif (is_array ($compte) && $compte['fonction'] == 2) {
                $id = $compte['id'];
                $nom = $compte['nom'];
                $prenom = $compte['prenom'];
                $fonction = $compte['comptable'];
                connecter($id, $nom, $prenom);
                include("vues/v_sommaireComptable.php");
            }
            break;
        }
    default : {
            include("vues/v_connexion.php");
            break;
        }
}
?>