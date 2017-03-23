<div>
    <form action="index.php?uc=suiviPaiement&action=miseEnPaiement" method="POST">
        <p>
            <input type="hidden" name="VisiteurSelectionner" value="<?php echo $VisiteurSelectionner ?>" />
            <input type="hidden" name="leMois" value="<?php echo $leMois ?>" />
            <input id="ok" type="submit" value="Mise en Paiment de la Fiche de Frais" size="20" onclick="
                    return confirm('Voulez-vous vraiment Mettre ce frais en Rembourser ?');"/> 


        </p> 


    </form>
</div>