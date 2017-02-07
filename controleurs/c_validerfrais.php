<?php

include("vues/comptable/v_sommaireComptable.php");
$lesVisiteurs = $pdo->getVisiteur();
$lesMois = getMois(date("d/m/Y"));
$action = $_REQUEST['action'];
switch ($action) {
    case 'vuevaliderfrais': {  
        
            include("vues/comptable/v_validerfrais.php");
            break;
        }
    case 'validerSelectionVisiteur': {
            $idVisiteur = $_POST['choixVisiteur'];
            $lesMois = $pdo->getLesMoisDisponibles($idVisiteur);
            include("vues/comptable/v_validerfrais.php");
            include("vues/comptable/v_listeMoisComptable.php");
            break;
        }
}
?>






