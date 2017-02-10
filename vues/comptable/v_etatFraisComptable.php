
<h3>Fiche de frais du mois <?php echo $numMois . "-" . $numAnnee ?> : 
</h3>
<div class="encadre">

    <table class="listeLegere">
        <caption>Eléments forfaitisés </caption>
        <tr>
            <?php
            foreach ($lesFraisForfait as $unFraisForfait) {
                $libelle = $unFraisForfait['libelle'];
                ?>	
                <th> <?php echo $libelle ?></th>
                <?php
            }
            ?>
            // Ajout de la colonne Situation pour le comptable
            <th> Situation</th>
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
            <td>
                <select name="SituationFraisForfait" size="3">
                    <option>Enregistré</option>
                    <option>Validé</option>
                    <option>Remboursé</option>
                </select>
            </td>
        </tr>
    </table>
    
    <table class="listeLegere">
        <caption>Descriptif des éléments hors forfait -<?php echo $nbJustificatifs ?> justificatifs reçus -
        </caption>
        <tr>
            <th class="date">Date</th>
            <th class="libelle">Libellé</th>
            <th class='montant'>Montant</th> 
            // Ajout de la colonne Situation pour le comptable
            <th> Situation</th>
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
                <td>
                <select name="SituationFraisHorsForfait" size="3">
                    <option>Enregistré</option>
                    <option>Validé</option>
                    <option>Remboursé</option>
                </select>
            </td>
            </tr>
            
            <?php
        }
        ?>
            
    </table>
</div>
</div>














