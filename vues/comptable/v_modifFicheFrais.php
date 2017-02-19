<h3>Fiche de frais du mois <?php echo $numMois . "-" . $numAnnee ?> : 
</h3>

<div class="encadre">

    <h3> Situation de la Fiche de Frais : <?php echo $libEtat ?></h3>

    <table class="listeLegere">
        <?php
        //Si il n'y a pas de fiche de frais affiche "Pas de fiche " sinon affiche les frais
        if (!$lesFraisForfait) {
            ?>
            <h1>Pas de fiche de frais pour ce visiteur ce mois</h1>
        <?php } else {
            ?>
            <caption><h3>Eléments forfaitisés</h3></caption>
            <tr>
                <?php
                foreach ($lesFraisForfait as $unFraisForfait) {
                    $libelle = $unFraisForfait['libelle'];
                    ?>	
                    <th><?php echo $libelle ?>  </th>
                    <?php
                }
                ?> 

            </tr>
            <form action="index.php?uc=modifierFrais&action=ActualiserFichierFrais" method="post">
                <tr>
                    <?php
                    foreach ($lesFraisForfait as $unFraisForfait) {
                        $quantite = $unFraisForfait['quantite'];
                        ?>
                        <td><input size="10" autofocus type="text" name="quantite[<?php echo $unFraisForfait['idfrais'] ?>]" value="<?php echo $quantite ?>"> </td>
                        <?php
                    }
                    ?>

                </tr>            
        </table>
        <input type="hidden" name="visiteur" value="<?php echo $VisiteurSelectionner ?>" />
        <input type="hidden" name="mois" value="<?php echo $leMois ?>" />
        <input type="submit" name="valider" value="Valider les Nouveaux Frais">

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
                            <input type="hidden" name="visiteur" value="<?php echo $VisiteurSelectionner ?>" />
                            <input type="hidden" name="mois" value="<?php echo $leMois ?>" />
                            <input type="submit" name="supprimer" value="Supprimer"> 
                        </form> 

                        <form action="index.php?uc=modifierFrais&action=reporterunFrais" method="post">
                            <input type="hidden" name="id" value="<?php echo $idFraisHorsForfait ?>"/>
                            <input type="hidden" name="libellefraishorsforfait" value="<?php echo $libelle ?>"/>
                            <input type="hidden" name="montant" value="<?php echo $montant ?>"/>
                            <input type="hidden" name="date" value="<?php echo $date ?>"/>
                            <input type="hidden" name="visiteur" value="<?php echo $VisiteurSelectionner ?>" />
                            <input type="hidden" name="mois" value="<?php echo $leMois ?>" />
                            <input type="submit" name="<?php $unFraisHorsForfait['id'] ?>" value="Reporter Le Frais"> </td>
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
    <?php } ?>
</div>

</div>



