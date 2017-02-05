<?php

include("vues/v_sommaireComptable.php");
$lesVisiteurs = $pdo->getVisiteur();
$action = $_REQUEST['action'];
switch ($action) {
    case 'vuevaliderfrais': {
            include("vues/v_validerfrais.php");
            break;
        }

}

?>






