<?php

include("vues/v_sommaireComptable.php");
$action = $_REQUEST['action'];
switch ($action) {
    case 'vuevaliderfrais': {
            include("vues/v_validerfrais.php");
            break;
        }
    case 'selectionnervisiteur': {
            $lesVisiteurs = $pdo->getVisiteur();
            break;
        }
}

?>






