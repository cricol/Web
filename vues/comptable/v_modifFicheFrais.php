<h3>Fiche de frais du mois <?php echo $numMois . "-" . $numAnnee ?> : 
</h3>

<div class="encadre">

    <h3> Situation de la Fiche de Frais : <?php echo $libEtat ?></h3>

    <table class="listeLegere">
        <!--<td>
            <select name="SituationFraisForfait" size="3">
                <option>Enregistré</option>
                <option>Validé</option>
                <option>Remboursé</option>
            </select>
        </td>
        <td> -->

        </td>
    </table>
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
            <tr>
                <?php
                foreach ($lesFraisForfait as $unFraisForfait) {
                    $quantite = $unFraisForfait['quantite'];
                    ?>
                <td class="qteForfait"><TEXTAREA name="nom" rows=1 cols=1><?php echo $quantite ?></textarea> </td>
                    <?php
                }
                ?>

            </tr>
        </table>


        <table class="listeLegere">
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
                    <td><TEXTAREA name="nom" rows=1 cols=10><?php echo $date ?></textarea></td>
                    <td><TEXTAREA name="nom" rows=2 cols=20><?php echo $libelle ?></textarea></td>
                    <td><TEXTAREA name="nom" rows=1 cols=10><?php echo $montant ?></textarea></td>                    
                </tr>

                <?php
            }
            ?>

        </table>
    <?php } ?>
</div>

</div>

