
<h3>Fiche de frais du mois <?php echo $numMois . "-" . $numAnnee ?> : 
</h3>

<div class="encadre">
    <form  action="index.php?uc=validerfrais&action=ModifFichierFrais" method="POST"> 
        <input type="hidden" name="visiteur" value="<?php echo $idVisiteur ?>" />
        <input type="hidden" name="mois" value="<?php echo $leMois ?>" />
        <h3> Situation de la Fiche de Frais : <?php echo $libEtat ?></h3>
<input id="ok" type="submit" value="Modifier La Fiche de Frais" size="20" />  
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
                        <th> <?php echo $libelle ?></th>
                        <?php
                    }
                    ?> 

                </tr>
                <tr>
                    <?php
                    foreach ($lesFraisForfait as $unFraisForfait) {
                        $quantite = $unFraisForfait['quantite'];
                        ?>
                        <td class="qteForfait"><?php echo $quantite ?> </td>
                        <?php
                    }
                    ?>

                </tr>

                <caption><h3>Descriptif des éléments hors forfait -<?php echo $nbJustificatifs ?> justificatifs reçus -</h3>
                </caption>
                <tr>
                    <th class="date">Date</th>
                    <th class="libelle">Libellé</th>
                    <th class='montant'>Montant</th> 
                </tr>
                <?php
                foreach ($lesFraisHorsForfait as $unFraisHorsForfait) {
                    $date = $unFraisHorsForfait['date'];
                    $libelle = $unFraisHorsForfait['libelle'];
                    $montant = $unFraisHorsForfait['montant'];
                    ?>
                    <tr>
                        <td><?php echo $date ?></td>
                        <td><?php echo $libelle ?></td>
                        <td><?php echo $montant ?></td>                    
                    </tr>

                    <?php
                }
                ?>

            </table>
        <?php } ?>
        
    </form>
</div>

</div>















