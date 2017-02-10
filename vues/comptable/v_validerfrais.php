<div id="contenu">
    <h2>Validation des frais par visiteur</h2>
    <form action="index.php?uc=validerfrais&action=validerSelectionVisiteur" method="POST">
        <div class="corpsForm">
            <p> <!-- choix du visiteur avec une liste déroulante nom et prénom -->
                <label for="choixVisiteur">Choisir Visiteur : </label>
                <select id="choixVisiteur" name="choixVisiteur">
                    <?php
                    while ($result = $lesVisiteurs->fetch()) {

                        echo "<option value='" . $result['id'] . "'>" . $result['nom'] . " " . $result['prenom'] . "</option>";
                    }
                    ?> 
                </select>
            <p>
                <label for="choiMois" accesskey="n">Mois : </label>
                <select id="choiMois" name="choiMois">
                    <?php
                    if($valider != 'ok'){
                        ?>
                     <option selected value="<?php echo $mois ?>"><?php echo $numMois . "/" . $numAnnee ?> </option>;
                     <?php
                }
                else{
                    foreach ($lesMois as $unMois) {
                        $mois = $unMois['mois'];
                        $numAnnee = $unMois['numAnnee'];
                        $numMois = $unMois['numMois'];
                        if ($mois == $moisASelectionner) {
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
                    ?>    

                    
                </select>
            </p>
            </p>
        </div>

        <div class="piedForm">
            <p>
                <input id="ok" type="submit" value="Valider" size="20" />
                <input id="annuler" type="reset" value="Effacer" size="20" />
            </p> 
        </div>
    </form>

