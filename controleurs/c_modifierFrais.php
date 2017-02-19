<?php

include("vues/comptable/v_sommaireComptable.php");

$lesVisiteurs = $pdo->getVisiteur();
$mois = getMoisComptable(date("d/m/Y"));
$lesMois = getMois(date("d/m/Y"));
$numAnnee = substr($mois, 0, 4);
$numMois = substr($mois, 4, 2);
$action = $_REQUEST['action'];
switch ($action) {

    case 'ModifFichierFrais': {
            $VisiteurSelectionner = $_POST['visiteur'];
            $leMois = $_POST['mois'];
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
            $lesEtats = $pdo->getTableEtat();
            include("vues/comptable/v_modifFicheFrais.php");
            break;
        }
    case 'ActualiserFichierFrais': {
            $VisiteurSelectionner = $_POST['visiteur'];
            $leMois = $_POST['mois'];
            $lesMois = $pdo->getLesMoisDisponibles($VisiteurSelectionner);
            $moisASelectionner = $leMois;
            include("vues/comptable/v_validerVisiteur.php");
            $pdo->majFraisForfait($VisiteurSelectionner, $leMois, $_POST['quantite']);
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
            $lesEtats = $pdo->getTableEtat();
            include("vues/comptable/v_modifFicheFrais.php");
            break;
        }
    case 'supprimerFraisHorsForfais': {
            $pdo->majSuppressionLigneFraisForfaitHorsForfait($_POST['id'], $_POST['libellefraishorsforfait']);
            $VisiteurSelectionner = $_POST['visiteur'];
            $leMois = $_POST['mois'];
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
            $lesEtats = $pdo->getTableEtat();
            include("vues/comptable/v_modifFicheFrais.php");
            break;
        }
    case 'reporterunFrais': {
            $VisiteurSelectionner = $_POST['visiteur'];
            $leMois = $_POST['mois'];
            $lesMois = $pdo->getLesMoisDisponibles($VisiteurSelectionner);
            $moisASelectionner = $leMois;
            include("vues/comptable/v_validerVisiteur.php");
            $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($VisiteurSelectionner, $leMois);
            $mois = modifieLaDate(date("d/m/Y"), "+1 month");
            $lesInfosFicheFraisaTester = $pdo->getLesInfosFicheFrais($VisiteurSelectionner, $mois);
            if (!$lesInfosFicheFraisaTester) {
                $pdo->creeNouvellesLignesFrais($VisiteurSelectionner, $mois);
                $pdo->creeNouveauFraisHorsForfait($VisiteurSelectionner, $mois, $_POST['libellefraishorsforfait'], $_POST['date'], $_POST['montant']);
                $pdo->supprimerFraisHorsForfait($_POST['id']);
            } elseif ($lesInfosFicheFrais) {
                $pdo->creeNouveauFraisHorsForfait($VisiteurSelectionner, $mois, $_POST['libellefraishorsforfait'], $_POST['date'], $_POST['montant']);
                $pdo->supprimerFraisHorsForfait($_POST['id']);
            }
            $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($VisiteurSelectionner, $leMois);
            $lesFraisForfait = $pdo->getLesFraisForfait($VisiteurSelectionner, $leMois);
            $numAnnee = substr($leMois, 0, 4);
            $numMois = substr($leMois, 4, 2);
            $libEtat = $lesInfosFicheFrais['libEtat'];
            $montantValide = $lesInfosFicheFrais['montantValide'];
            $nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
            $dateModif = $lesInfosFicheFrais['dateModif'];
            $dateModif = dateAnglaisVersFrancais($dateModif);
            include("vues/comptable/v_modifFicheFrais.php");
            break;
        }

    case 'ficheDeFraisValider' : {
            $VisiteurSelectionner = $_POST['visiteur'];
            $leMois = $_POST['mois'];
            $lesMois = $pdo->getLesMoisDisponibles($VisiteurSelectionner);
            $moisASelectionner = $leMois;
            include("vues/comptable/v_validerVisiteur.php");
            $nouvelleEtat = "VA";
            $pdo->majEtatFicheFrais($VisiteurSelectionner, $leMois, $nouvelleEtat);
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
            $lesEtats = $pdo->getTableEtat();
            include("vues/comptable/v_modifFicheFrais.php");
        }
    default : {
            include("vues/comptable/v_sommaireComptable.php");
            break;
        }
}