<h3>Fiche de frais du mois <?php echo $numMois . "-" . $numAnnee ?> : 
</h3>

<div class="encadre">

    <h3> Situation de la Fiche de Frais : <?php echo $libEtat ?></h3>

    <label>Type de Vehicule :</label>
    <form action="index.php?uc=modifierFrais&action=ActualiserFichierFrais" method="post">
        <select id="lstVehicule" name="lstVehicule">
            <?php
            foreach ($lesVehicules as $unVehicule) {
                $idVoitureVisiteur = $idVehicule['idVehicule'];
                if ($unVehicule['id'] == $idVoitureVisiteur) {
                    ?> 
                    <option selected value="<?php echo $unVehicule['id'] ?>"><?php echo $unVehicule['libelle'] ?> </option>
                    <?php
                    $prixKm = $unVehicule['prix'];
                    $idVoitureVisiteur = $unVehicule['id'];
                } else {
                    ?>                    
                    <option value="<?php echo $unVehicule['id'] ?>"><?php echo $unVehicule['libelle'] ?> </option>
                    <?php
                }
            }
            if ($prixKm == null) {
                //si il n'y a pas de vehicule selectionner on met le prixkm a 0
                $prixKm = 0;
            }
            ?>
        </select>

        <table class="listeLegere">
            <caption><h3>Eléments forfaitisés</h3></caption>
            <tr>
                <th>Frais Forfaitaires</th>
                <th>Quantité</th>
                <th>Montant unitaire</th>
                <th>Total</th>
            </tr>


            <?php
            foreach ($lesFraisForfait as $unFraisForfait) {
                $quantite = $unFraisForfait['quantite'];
                $libelle = $unFraisForfait['libelle'];
                $prixunitaire = $unFraisForfait['prix'];
                $idfrais = $unFraisForfait['idfrais'];
                $total = $quantite * $prixunitaire;
                $totalKm = $quantite * $prixKm;
                ?>
                <tr>
                    <td><?php echo $libelle ?> </td>
                    <td><input size="7" autofocus type="text" name="quantite[<?php echo $idfrais ?>]" value="<?php echo $quantite ?>"> </td>
                    <?php
                    if ($libelle == 'Nombre Kilometre') {
                        ?>
                        <td>
                            <?php
                                if($prixKm == 0){
                                    echo 'Aucun Type de Vehicule';
                                }
                                else{
                                    echo $prixKm ;
                                }
                                

                            ?>
                        </td>

                        <td><?php echo $totalKm ?> </td>
                        <?php
                    } else {
                        ?>
                        <td><?php echo $prixunitaire ?> </td>
                        <td><?php echo $total ?></td>
                        <?php
                    }
                }
                ?>

            </tr>            
        </table>

        <input type="hidden" name="choiVisiteur" value="<?php echo $VisiteurSelectionner ?>" />
        <input type="hidden" name="choiMois" value="<?php echo $leMois ?>" />
        <input type="submit" name="valider" value="Valider les Nouveaux Frais" onclick="
                return confirm('Voulez-vous vraiment Valider les Nouveaux Frais ?');">

    </form>

    <table class="listeLegere">
        <caption><h3>Descriptif des éléments hors forfait -<?php echo $nbJustificatifs ?> justificatifs reçus -</h3>
        </caption>
        <tr>
            <th class="date">Date</th>
            <th class="libelle">Libellé</th>
            <th class='montant'>Montant</th>
            <th></th>
        </tr>
        <?php
        foreach ($lesFraisHorsForfait as $unFraisHorsForfait) {
            $idFraisHorsForfait = $unFraisHorsForfait['id'];
            $date = $unFraisHorsForfait['date'];
            $libelle = $unFraisHorsForfait['libelle'];
            $debutLibelle = substr($libelle, 0, 7);
            $montant = $unFraisHorsForfait['montant'];

            if ($debutLibelle != "REFUSER") {
                ?>              

                <tr>
                    <td><?php echo $date ?></td>
                    <td><?php echo $libelle ?></td>
                    <td><?php echo $montant ?></td>

                    <td>
                        <form action="index.php?uc=modifierFrais&action=supprimerFraisHorsForfais" method="post">
                            <input type="hidden" name="id" value="<?php echo $idFraisHorsForfait ?>"/>
                            <input type="hidden" name="libellefraishorsforfait" value="<?php echo $libelle ?>"/>
                            <input type="hidden" name="choiVisiteur" value="<?php echo $VisiteurSelectionner ?>" />
                            <input type="hidden" name="choiMois" value="<?php echo $leMois ?>" />
                            <input type="submit" name="supprimer" value="Supprimer" onclick="
                                            return confirm('Voulez-vous vraiment Supprimer ?');"> 
                        </form> 

                        <form action="index.php?uc=modifierFrais&action=reporterunFrais" method="post">
                            <input type="hidden" name="id" value="<?php echo $idFraisHorsForfait ?>"/>
                            <input type="hidden" name="libellefraishorsforfait" value="<?php echo $libelle ?>"/>
                            <input type="hidden" name="montant" value="<?php echo $montant ?>"/>
                            <input type="hidden" name="date" value="<?php echo $date ?>"/>
                            <input type="hidden" name="choiVisiteur" value="<?php echo $VisiteurSelectionner ?>" />
                            <input type="hidden" name="choiMois" value="<?php echo $leMois ?>" />
                            <input type="submit" name="<?php $unFraisHorsForfait['id'] ?>" value="Reporter Le Frais" onclick="
                                            return confirm('Voulez-vous vraiment Reporter ce Frais ?');"> </td>
                        </form>
                </tr>

                <?php
            }
        }
        ?>

    </table>
    <form action="index.php?uc=modifierFrais&action=ficheDeFraisValider" method="post">
        <input type="hidden" name="visiteur" value="<?php echo $VisiteurSelectionner ?>" />
        <input type="hidden" name="mois" value="<?php echo $leMois ?>" />
        <input type="submit" name="valider" value="Passer la Fiche de Frais en Validee">
    </form>

</div>

</div>



