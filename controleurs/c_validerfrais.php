<?php

include("vues/comptable/v_sommaireComptable.php");

$lesVisiteurs = $pdo->getVisiteur();
$mois = getMoisComptable(date("d/m/Y"));
$lesMois = getMois(date("d/m/Y"));
$numAnnee = substr($mois, 0, 4);
$numMois = substr($mois, 4, 2);
$action = $_REQUEST['action'];

switch ($action) {
    case 'vuevaliderfrais': {
            include("vues/comptable/v_validerfrais.php");
            break;
        }
    case 'validerSelectionVisiteur': {
            $idVisiteur = $_POST['choiVisiteur'];
            $leMois = $_REQUEST['choiMois'];
            $lesMois = $pdo->getLesMoisDisponibles($idVisiteur);
            $moisASelectionner = $leMois;
            include("vues/comptable/v_validerfrais.php");
            $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $leMois);
            $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $leMois);
            $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur, $leMois);
            $numAnnee = substr($leMois, 0, 4);
            $numMois = substr($leMois, 4, 2);
            $libEtat = $lesInfosFicheFrais['libEtat'];
            $montantValide = $lesInfosFicheFrais['montantValide'];
            $nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
            $dateModif = $lesInfosFicheFrais['dateModif'];
            $dateModif = dateAnglaisVersFrancais($dateModif);
            include("vues/comptable/v_etatFraisComptable.php");
            break;
        }
    case 'envoiModifFicheFrais':{
    }
}
?>






