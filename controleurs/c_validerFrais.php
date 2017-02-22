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
            include("vues/comptable/v_validerVisiteur.php");
            break;
        }
    case 'validerSelectionVisiteur': {
            $VisiteurSelectionner = $_POST['choiVisiteur'];
            $leMois = $_POST['choiMois'];
            $lesMois = $pdo->getLesMoisDisponibles($VisiteurSelectionner);
            $moisASelectionner = $leMois;
            include("vues/comptable/v_validerVisiteur.php");
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
            if (!$lesFraisForfait) {
                include("vues/comptable/v_erreurPasDeFrais.php");
            } else {
                include("vues/comptable/v_modifFicheFrais.php");
            }
            break;
        }
}
?>






