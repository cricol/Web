<?php
include("vues/comptable/v_sommaireComptable.php");

$lesVisiteurs = $pdo->getVisiteur();
$mois = getMoisComptable(date("d/m/Y"));
$lesMois = getMois(date("d/m/Y"));
$numAnnee = substr($mois, 0, 4);
$numMois = substr($mois, 4, 2);
$action = $_REQUEST['action'];
switch ($action) {
    case 'suivrePaiement': {
            $lesVisiteurs = $pdo->getVisiteur();
            $lesFichesFrais = $pdo->getToutesLesFichesFrais();
            include("vues/comptable/v_validerMoispourSuivie.php");
            break;
        }
    case 'afficheFraisaValider': {
            $lesVisiteurs = $pdo->getVisiteur();
            $lesFichesFrais = $pdo->getToutesLesFichesFrais();
            $VisiteurSelectionner = $_POST['choiVisiteur'];
            $leMois = $_POST['choiMois'];
            $moisSelectionner = $leMois;
            include("vues/comptable/v_validerMoispourSuivie.php");
            $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($VisiteurSelectionner, $leMois);
            $lesFraisForfait = $pdo->getLesFraisForfait($VisiteurSelectionner, $leMois);
            $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($VisiteurSelectionner, $leMois);
            $numAnnee = substr($leMois, 0, 4);
            $numMois = substr($leMois, 4, 2);
            $libEtat = $lesInfosFicheFrais['libEtat'];
            $montantValide = $lesInfosFicheFrais['montantValide'];
            $nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
            $dateModif = $lesInfosFicheFrais['dateModif'];
            $dateModif = dateAnglaisVersFrancais($dateModif);
            include("vues/comptable/v_miseEnPaiement.php");
            break;
        }
    case 'miseEnPaiement': {
            $lesVisiteurs = $pdo->getVisiteur();
            $lesFichesFrais = $pdo->getToutesLesFichesFrais();
            $VisiteurSelectionner = $_POST['visiteur'];
            $leMois = $_POST['mois'];
            $moisSelectionner = $leMois;
            include("vues/comptable/v_validerMoispourSuivie.php");
            $nouvelleEtat = "RB";
            $pdo->majEtatFicheFrais($VisiteurSelectionner, $moisSelectionner, $nouvelleEtat);
            $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($VisiteurSelectionner, $leMois);
            $lesFraisForfait = $pdo->getLesFraisForfait($VisiteurSelectionner, $leMois);
            $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($VisiteurSelectionner, $leMois);
            $numAnnee = substr($leMois, 0, 4);
            $numMois = substr($leMois, 4, 2);
            $libEtat = $lesInfosFicheFrais['libEtat'];
            $montantValide = $lesInfosFicheFrais['montantValide'];
            $nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
            $dateModif = $lesInfosFicheFrais['dateModif'];
            $dateModif = dateAnglaisVersFrancais($dateModif);
            include("vues/comptable/v_miseEnPaiement.php");
            break;
        }

}