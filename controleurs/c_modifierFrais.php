<?php

include("vues/comptable/v_sommaireComptable.php");
$lesVisiteurs = $pdo->getVisiteur();
$VisiteurSelectionner = $_POST['choiVisiteur'];
$leMois = $_POST['choiMois'];
$lesMois = $pdo->getLesMoisDisponibles($VisiteurSelectionner);
$action = $_REQUEST['action'];
switch ($action) {

    case 'ModifFichierFrais': {
            $moisASelectionner = $leMois;
            include("vues/comptable/v_validerVisiteur.php");
            break;
        }
    case 'ActualiserFichierFrais': {
            $moisASelectionner = $leMois;
            include("vues/comptable/v_validerVisiteur.php");
            $nouvelleID = $_POST['lstVehicule'];
            $pdo->majVehiculeFicheFrais($VisiteurSelectionner, $leMois, $nouvelleID);
            $pdo->majFraisForfait($VisiteurSelectionner, $leMois, $_POST['quantite']);
            break;
        }
    case 'supprimerFraisHorsForfais': {
            $pdo->majSuppressionLigneFraisForfaitHorsForfait($_POST['id'], $_POST['libellefraishorsforfait']);
            $moisASelectionner = $leMois;
            include("vues/comptable/v_validerVisiteur.php");
            break;
        }
    case 'reporterunFrais': {
            $moisASelectionner = $leMois;
            include("vues/comptable/v_validerVisiteur.php");
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
            break;
        }

    case 'ficheDeFraisValider' : {
            $moisASelectionner = $leMois;
            include("vues/comptable/v_validerVisiteur.php");
            $nouvelleEtat = "VA";
            $pdo->majEtatFicheFrais($VisiteurSelectionner, $leMois, $nouvelleEtat);

        }
}
$lesVehicules = $pdo->getTableVehicule();
$idVehicule = $pdo->getVehicule($VisiteurSelectionner, $leMois);
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
?>