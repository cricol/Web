<div id="contenu">
    <h2>Validation des frais par visiteur</h2>
    <form action="index.php?uc=suiviPaiement&action=afficheFraisaValider" method="POST">
        <div class="corpsForm">

            <p>
                <label for="choiMois" accesskey="n">Mois : </label>
                <select id="choiMois" name="choiMois">

                    <?php
                    //Initialise les variables tmpMois, tmpMoisDouble pour avoir le 1er mois des fiches de frais en etat Validee
                    foreach ($lesFichesFrais as $uneFicheFrais) {
                        if ($uneFicheFrais['libelle'] == 'Validée et mise en paiement') {
                            $tmpMoisDouble = array($uneFicheFrais['mois']);
                            $tmpMois = array($uneFicheFrais['mois']);

                            $mois = $uneFicheFrais['mois'];
                            $numAnnee = substr($uneFicheFrais['mois'], 0, 4);
                            $numMois = substr($uneFicheFrais['mois'], 4, 6);
                            ?>
                            <option value = "<?php echo $mois ?>"><?php echo $numMois . "/" . $numAnnee ?></option>
                            <?php
                            break;
                        }
                    }

                    //Recupere tout les mois avec une fiche de frais en etat Validee
                    foreach ($lesFichesFrais as $uneFicheFrais) {

                        if ($uneFicheFrais['libelle'] == 'Validée et mise en paiement') {
                            array_push($tmpMois, $uneFicheFrais['mois']);
                            $diff = array_diff($tmpMois, $tmpMoisDouble);
                            if ($diff != null) {
                                array_push($tmpMoisDouble, $uneFicheFrais['mois']);

                                $mois = $uneFicheFrais['mois'];
                                $numAnnee = substr($uneFicheFrais['mois'], 0, 4);
                                $numMois = substr($uneFicheFrais['mois'], 4, 6);
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
                        }
                    }
                    ?>    


                </select>
            </p>
            <p> <!-- choix du visiteur avec une liste déroulante nom et prénom -->
                <label for="choiVisiteur">Choisir Visiteur : </label>
                <select id="choiVisiteur" name="choiVisiteur">
                    <?php
                    foreach ($lesVisiteurs as $unvisiteur) {
                        if ($unvisiteur['fonction'] == 1) {
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
