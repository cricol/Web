<?php
/**
* Crée un nouveau frais pour un visiteur un mois donné
* à partir des informations fournies en paramètre par l'appli

* @param $idVisiteur 
* @param $mois sous la forme aaaamm
* @param $donnee : Donnees recu de l'appli
*/
function ajoutFraisForfait($idVisiteur, $date, $donnee) {
    $i = 0;
    $dernierMois = PdoGsb::dernierMoisSaisi($idVisiteur);
    $laDerniereFiche = PdoGsb::getLesInfosFicheFrais($idVisiteur, $dernierMois);
    if ($laDerniereFiche['idEtat'] == 'CR') {
        $larequete = "update fichefrais set idEtat = 'CL', dateModif = now() 
                        where fichefrais.idvisiteur ='$idVisiteur' and fichefrais.mois = '$date'";
        $cnx = connexionPDO();
        
        $req = $cnx->prepare($larequete);
        $req->execute();
    }    
    $larequete = "insert into fichefrais(idVisiteur,mois,nbJustificatifs,montantValide,dateModif,idEtat,typeVehicule) 
                values('$idVisiteur','$date',0,0,now(),'CR','$donnee[6]')";
    
    $cnx = connexionPDO();
    
    $req = $cnx->prepare($larequete);
    $req->execute();

    $idEtat = PdoGsb::getLesIdFrais();
    foreach ($idEtat as $unIdEtat) {
        $cnx = connexionPDO();
        $unIdFrais = $unIdEtat['idfrais'];

        $larequete = "INSERT INTO lignefraisforfait(idVisiteur,mois,idFraisForfait,quantite) 
                            VALUES('$idVisiteur','$date','$unIdFrais','0')";

        $req = $cnx->prepare($larequete);
        $req->execute();
        ++$i;
    }
    majLignesFrais($idVisiteur, $date, $donnee);
}
/**
* Met a jour le frais pour un visiteur un mois donné
* à partir des informations fournies en paramètre par l'appli

* @param $idVisiteur 
* @param $mois sous la forme aaaamm
* @param $donnee : Donnees recu de l'appli
*/
function majLignesFrais($idVisiteur, $date, $donnee) {
    $i = 0;
    $idEtat = PdoGsb::getLesIdFrais();
    foreach ($idEtat as $unIdEtat) {
        $cnx = connexionPDO();
        $unIdFrais = $unIdEtat['idfrais'];
        $larequete = "update lignefraisforfait set lignefraisforfait.quantite = $donnee[$i]
			where lignefraisforfait.idVisiteur = '$idVisiteur' and lignefraisforfait.mois = '$date'
			and lignefraisforfait.idFraisForfait = '$unIdFrais'";

        $req = $cnx->prepare($larequete);   
        $req->execute();
        ++$i;
    }
}
/**
* Crée un nouveau frais hors forfait pour un visiteur un mois donné
* à partir des informations fournies en paramètre par l'appli

* @param $idVisiteur 
* @param $mois sous la forme aaaamm
* @param $donnee : Donnees recu de l'appli
*/
function ajoutFraisHorsForfait($idVisiteur, $mois, $libelle, $date, $montant) {
    $cnx = connexionPDO();
    $larequete = "insert into lignefraishorsforfait 
		values('','$idVisiteur','$mois','$libelle','$date','$montant')";
    $req = $cnx->prepare($larequete);
    $req->execute();
}

?>