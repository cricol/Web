<?php

include("vues/comptable/v_sommaireComptable.php");

$lesVisiteurs = $pdo->getVisiteur();
if (isset($_POST['choiMois']) && isset($_POST['choiVisiteur'])) {
    $VisiteurSelectionner = $_POST['choiVisiteur'];
    $leMois = $_POST['choiMois'];
}
$lesMois = getMois(date("d/m/Y"));
$lesFichesFrais = $pdo->getToutesLesFichesFrais();

$action = $_REQUEST['action'];
switch ($action) {
    case 'suivrePaiement': {
            include("vues/comptable/v_validerMoispourSuivie.php");
            break;
        }
    case 'afficheFraisaValider': {
            $moisSelectionner = $leMois;
            include("vues/comptable/v_validerMoispourSuivie.php");
            include("vues/comptable/v_boutonMiseEnPaiment.php");
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
            if ((!$lesFraisForfait) || ($libEtat != 'Validée et mise en paiement')) {
                include("vues/comptable/v_erreurPasDeFrais.php");
            } else {
                include("vues/v_etatFrais.php");
            }
            break;
        }
    case 'miseEnPaiement': {
            $VisiteurSelectionner = $_POST['VisiteurSelectionner'];
            $leMois = $_POST['leMois'];
            $moisSelectionner = $leMois;
            include("vues/comptable/v_validerMoispourSuivie.php");
            include("vues/comptable/v_boutonMiseEnPaiment.php");
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
            if ((!$lesFraisForfait) || ($libEtat != 'Validée et mise en paiement')) {
                include("vues/comptable/v_erreurPasDeFrais.php");
            } else {
                include("vues/v_etatFrais.php");
            }
            break;
        }
}
?>