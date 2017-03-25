<?php

include '../include/class.pdogsb.inc.php';
include 'fonctions.php';
include 'testconnexion.php';
$pdo = PdoGsb::getPdoGsb();
// test si le paramètre "operation" est présent
if (isset($_REQUEST["operation"])) {

    if (($_REQUEST["operation"] == "fraismois")) {
        //Recupere les donnees de l'appli et les decodes
        $lesdonnees = $_REQUEST["lesdonnees"];
        $donnee = json_decode($lesdonnees);
        //Recup mois et annee pour construire la date
        $annee = $donnee[4];
        $mois = $donnee[5];
        //Si le mois est avec un seul chiffre rajoute le '0' devant
        if (strlen($mois) == 1) {
            $mois = "0" . $mois;
        }
        $date = $annee . $mois;

        $login = $donnee[7];
        $mdp = md5($donnee[8]);

        //Recupere l'id du Visiteur
        $ligne = PdoGsb::getInfosVisiteur($login, $mdp);
        $idVisiteur = $ligne['id'];

        //Test si le login et le mdp rentrer dans l'appli est correcte
        if ($idVisiteur != null) {
            try {
                //Ajoute les lignes de frais forfait                
                ajoutFraisForfait($idVisiteur, $date, $donnee);                
            } catch (PDOException $e) {
                print "Erreur !" . $e->getMessage();
                die();
            }
        }
    } elseif (($_REQUEST["operation"] == "fraismoisHf")) {
        //Recupere les donnees de l'appli et les decodes
        $lesdonnees = $_REQUEST["lesdonnees"];
        $donnee = json_decode($lesdonnees);

        $jour = $donnee[0];
        $mois = $donnee[1];
        $annee = $donnee[2];
        $montant = $donnee[3];
        $libelle = $donnee[4];
        //Si le mois est avec un seul chiffre rajoute le '0' devant
        if (strlen($mois) == 1) {
            $mois = "0" . $mois;
        }
        //Recup mois annee et jour pour construire la date
        $date = $annee . '-' . $mois . '-' . $jour;
        //Recup mois et annee pour construire le mois
        $mois = $annee . $mois;

        $login = $donnee[5];
        $mdp = md5($donnee[6]);

        //Recupere l'id du Visiteur
        $ligne = PdoGsb::getInfosVisiteur($login, $mdp);
        $idVisiteur = $ligne['id'];

        if ($idVisiteur != null) {
            try {
                //ajoute les frais hors forfait de l'appli
                ajoutFraisHorsForfait($idVisiteur, $mois, $libelle, $date, $montant);
            } catch (PDOException $e) {
                print "Erreur !" . $e->getMessage();
                die();
            }
        }
    }
}
?>
