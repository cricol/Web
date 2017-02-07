  
    <form action="index.php?uc=validerfrais&action=validerSelectionVisiteur" method="post">

            <p>

                <label for="choiMois" accesskey="n">Mois : </label>
                <select id="choiMois" name="choiMois">
                    <?php
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
                    ?>    

                </select>
            </p>
        </div>

        <div class="piedForm">
            <p>
                <input id="ok" type="submit" value="Valider" size="20" />
                <input id="annuler" type="reset" value="Effacer" size="20" />
            </p> 
        </div>

    </form>

