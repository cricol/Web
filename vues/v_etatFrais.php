
<h3>Fiche de frais du mois <?php echo $numMois . "-" . $numAnnee ?> : 
</h3>
<div class="encadre">
    <p>
        Etat : <?php echo $libEtat ?> depuis le <?php echo $dateModif ?> <br> Montant validé : <?php echo $montantValide ?>
    </p>
    <table class="listeLegere">
        <caption>Eléments forfaitisés </caption>
        <tr>
            <th>Frais Forfaitaires</th>
            <th>Quantité</th>
            <th>Montant unitaire</th>
            <th>Total</th>
        </tr>

        <td>Type de Vehicule : <?php echo $idVehicule['libelle'] ?>
            <?php
            $prixKm = $idVehicule['prix'];
            ?>                    

        </td>
        <?php
        foreach ($lesFraisForfait as $unFraisForfait) {
            $quantite = $unFraisForfait['quantite'];
            $libelle = $unFraisForfait['libelle'];
            $prixunitaire = $unFraisForfait['prix'];
            $total = $quantite * $prixunitaire;
            $totalKm = $quantite * $prixKm;
            ?>
            <tr>
                <td><?php echo $libelle ?> </td>
                <td><?php echo $quantite ?></td>
                <?php
                if ($libelle == 'Nombre Kilometre') {
                    ?>
                    <td><?php echo $prixKm ?> </td>
                    <td><?php echo $totalKm ?> </td>
                    <?php
                } else {
                    ?>
                    <td><?php echo $prixunitaire ?></td>
                    <td><?php echo $total ?></td>
                    <?php
                }
                ?>

                <?php
            }
            ?>

        </tr> 
    </table>
    <table class="listeLegere">
        <caption>Descriptif des éléments hors forfait -<?php echo $nbJustificatifs ?> justificatifs reçus -
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
            $debutLibelle = substr($libelle, 0, 7);
            if ($debutLibelle != 'REFUSER') {
                ?>
                <tr>
                    <td><?php echo $date ?></td>
                    <td><?php echo $libelle ?></td>
                    <td><?php echo $montant ?></td>
                </tr>
                <?php
            }
        }
        ?>
    </table>
</div>
</div>














