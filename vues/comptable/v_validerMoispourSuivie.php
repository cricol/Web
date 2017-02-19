<div id="contenu">
    <h2>Suivre le Paiment des Fiches de Frais</h2>
    <form action="index.php?uc=suiviPaiement&action=afficheFraisaValider" method="POST">
        <div class="corpsForm">

            <p>
                <label for="choiMois" accesskey="n">Mois : </label>
                <select id="choiMois" name="choiMois">

                    <?php
                    //Initialise les variables tmpMois et visiteuraValider pour avoir les mois et les Visiteurs des fiches de frais en etat Validee
                    $visiteursaValider = array();
                    $tmpMois = array();
                    foreach ($lesFichesFrais as $uneFicheFrais) {
                        if ($uneFicheFrais['libelle'] == 'Validée et mise en paiement') {
                            array_push($tmpMois, $uneFicheFrais['mois']);
                            array_push($visiteursaValider, $uneFicheFrais['idVisiteur']);
                        }
                    }

                    $tmpMois = array_unique($tmpMois);
                    //Recupere tous les mois avec une fiche de frais en etat Validee
                    foreach ($tmpMois as $unMois) {
                        $mois = $unMois;
                        $numAnnee = substr($mois, 0, 4);
                        $numMois = substr($mois, 4, 6);
                        if ($mois == $moisSelectionner) {
                            ?>
                            <option selected value="<?php echo $mois ?>"><?php echo $numMois . "/" . $numAnnee ?> </option>
                            <?php
                        } else {
                            ?>
                            <option value="<?php echo $mois ?>"><?php echo $numMois . "/" . $numAnnee ?> </option>
                            <?php
                        }
                    }


                    $visiteursaValider = array_unique($visiteursaValider);
                    ?>    


                </select>
            </p>
            <p> 
                <label for="choiVisiteur">Choisir Visiteur : </label>
                <select id="choiVisiteur" name="choiVisiteur">
                    <?php
                    foreach ($lesVisiteurs as $unvisiteur) {
                        if ($unvisiteur['fonction'] == 1) {
                            foreach ($visiteursaValider as $visiteurFiche) {
                                if ($unvisiteur['id'] == $visiteurFiche) {
                                    $VisiteurSelectionner = str_replace(' ', '', $VisiteurSelectionner);
                                    if ($unvisiteur['id'] == $VisiteurSelectionner) {
                                        ?>
                                        <option selected value="<?php echo $unvisiteur['id'] ?>"   ><?php echo $unvisiteur['nom'] . " " . $unvisiteur['prenom'] ?></option> 
                                        <?php
                                    } else {
                                        ?>
                                        <option value="<?php echo $unvisiteur['id'] ?>" ><?php echo $unvisiteur['nom'] . " " . $unvisiteur['prenom'] ?></option>
                                        <?php
                                    }
                                }
                            }
                        }
                    }
                    ?> 
                </select>

            </p>

        </div>

        <div class="piedForm">
            <p>
                <input id="ok" type="submit" value="Valider" size="20" />

            </p> 
        </div>

    </form>
