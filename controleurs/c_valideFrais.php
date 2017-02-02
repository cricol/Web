<?php 
if (($_SESSION['poste']) == 'comptable'){
    include("vues/v_sommaire_comptable.php");
    $idComptable = $_SESSION['idVisiteur'];
    $moisActuel = getMois(date("d/m/Y"));
    $numAnnee = substr($moisActuel, 0, 4);
    $numMois = substr($moisActuel, 4, 2);
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_ENCODED);
    
    if (isset($_POST['choixVisit'])) {
        $idVisiteur = filter_input(INPUT_POST, 'choixVisit', FILTER_SANITIZE_SPECIAL_CHARS);
        $_SESSION['visitor'] = $idVisiteur;
    }else{
        $idVisiteur = NULL;
    }

    if (isset($_POST['lstMois'])){
        $mois = filter_input(INPUT_POST, 'lstMois', FILTER_SANITIZE_NUMBER_INT);
        $_SESSION['moa'] = $mois;
    }else{
        $mois = NULL;
    }

    switch ($action){
        case 'selectionnerVisiteur':{
            $lesMois = $pdo->dernierMoisCloture($idVisiteur);
                $lesVisiteurs = $pdo->getVisiteur();
                include 'vues/v_listeVisiteurs.php';
                break;
            }

        case 'selectionnerMois':{
            $lesMois = $pdo->dernierMoisCloture($idVisiteur);
            $dateDujour = date('d');
            if(isset($lesMois) == null){
                ajouterErreur("Pas de fiche de frais à valider");
                include("vues/v_erreurs.php");
                $leVisiteur= filter_input(INPUT_POST, 'choixVisit', FILTER_SANITIZE_SPECIAL_CHARS);
                $lesVisiteurs = $pdo->getVisiteur();
                $visiteurASelectionner = $leVisiteur; // tentative de garder le bon visiteur sélectionné après erreur
                include 'vues/v_listeVisiteurs.php';
            }else{
                include 'vues/v_listeVisiteurs_mois.php';   
                }
            break;
        }

        case 'validerMajFraisForfaitComptable':{
            $idVisiteur = $_SESSION['visitor'];
            $mois = $_SESSION['moa'];
            include ("vues/v_ficheVisiteur.php");  
            $lesFrais = array();
            
            if (isset($_POST['lesFrais'])){
                $lesFrais = $_POST['lesFrais'];
                
            } 
            //suppresion des valeurs vides pour eviter fatal error (ajout seb)
            $lesFrais = array_filter($lesFrais);
            
            if (lesQteFraisValides($lesFrais)){
                $pdo->majFraisForfait($idVisiteur, $mois, $lesFrais);
                if($lesFrais){
                    ajouterValideOk("Le changement des frais a été validé");
                    include("vues/v_valideOk.php");
                }
            }else{
                ajouterErreur("Les valeurs des frais doivent être numériques");
                include("vues/v_erreurs.php");
            }
            break;
        }
         
        case 'supprimerFraisComptable':{
            $idVisiteur = $_SESSION['visitor'];
            $mois = $_SESSION['moa'];
            $idFrais = filter_input(INPUT_GET, 'idFrais', FILTER_SANITIZE_NUMBER_INT);
            $tailleLibelle = filter_input(INPUT_GET, 'tailleLibelle', FILTER_SANITIZE_SPECIAL_CHARS);
            $debutLibelle = filter_input(INPUT_GET, 'debutLibelle', FILTER_SANITIZE_SPECIAL_CHARS);
            include ("vues/v_ficheVisiteur.php");
            if(strcmp($debutLibelle,'REFUSE')){
                if($tailleLibelle + 7 > 100){
                    $pdo->refuserFraisHorsForfaitTronque($idFrais);
                }else{
                    $pdo->refuserFraisHorsForfait($idFrais);
                }
            }else{
                ajouterErreur("Le Frais a déjà été refusé");
                include("vues/v_erreurs.php");
            }
            break;
        }
        
        case 'reporterFraisComptable':{
            $idVisiteur = $_SESSION['visitor'];
            $mois = $_SESSION['moa'];
            $moisProchain = ajouterMois($mois);
            $idFrais = filter_input(INPUT_GET, 'idFrais', FILTER_SANITIZE_NUMBER_INT);
            $libelle = filter_input(INPUT_GET, 'libelle', FILTER_SANITIZE_SPECIAL_CHARS);
	    $date = filter_input(INPUT_GET, 'date', FILTER_SANITIZE_SPECIAL_CHARS);
            
            $montant= filter_input(INPUT_GET, 'montant', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $pdo->supprimerFraisHorsForfait($idFrais);
            include ("vues/v_ficheVisiteur.php");
            
            if($pdo->estPremierFraisMois($idVisiteur,$moisProchain)){
                $pdo->creeNouvellesLignesFrais($idVisiteur,$moisProchain);
                $pdo->creeNouveauFraisHorsForfait($idVisiteur,$moisProchain,$libelle,$date,$montant);
            }else{
                $pdo->creeNouveauFraisHorsForfait($idVisiteur,$moisProchain,$libelle,$date,$montant); 
            }
            break;
        }
            
        case 'validerFiche':{
            $idVisiteur = $_SESSION['visitor'];
            $mois = $_SESSION['moa'];
            $etatFiche = $pdo->getLesInfosFicheFrais($idVisiteur, $mois);
            
            if($etatFiche['idEtat'] == 'VA'){
                ajouterErreur("La fiche a déjà été validée le ". dateAnglaisVersFrancais($etatFiche['dateModif']));
                include("vues/v_erreurs.php");
                
            }else{
                $pdo->majEtatFicheFrais($idVisiteur,$mois,'VA');
                ajouterValideOk("La fiche a bien été validée");
                include("vues/v_valideOk.php");
            }
            
            include ("vues/v_ficheVisiteur.php"); 
            break;
        }
    } // fin switch/
    
    $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $mois);
    $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $mois);

    if ($idVisiteur != NULL && $mois != NULL){
        include("vues/v_listeFraisForfait_comptable.php");
        include("vues/v_listeFraisHorsForfait_comptable.php");
    }
}else{
    echo 'Vous n\'etes pas visiteur médical!!';
}