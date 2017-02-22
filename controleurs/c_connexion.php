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
            $mdp = md5($_REQUEST['mdp']);
            $visiteur = $pdo->getInfosVisiteur($login, $mdp);
            if (!is_array($visiteur)) {
                ajouterErreur("Login ou mot de passe incorrect");
                include("vues/v_erreurs.php");
                include("vues/v_connexion.php");
            } elseif ($visiteur['fonction'] == 'visiteur') {
                $id = $visiteur['id'];
                $nom = $visiteur['nom'];
                $prenom = $visiteur['prenom'];
                connecter($id, $nom, $prenom);
                include("vues/v_sommaire.php");
            }
            elseif($visiteur['fonction'] == 'comptable'){
                $id = $visiteur['id'];
                $nom = $visiteur['nom'];
                $prenom = $visiteur['prenom'];
                connecter($id, $nom, $prenom);
                include("vues/comptable/v_sommaireComptable.php");
            }
            break;
        }
    default : {
            include("vues/v_connexion.php");
            break;
        }
}
?>