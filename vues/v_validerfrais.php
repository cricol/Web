<div id="contenu">
    <h2>Validation des frais par visiteur</h2>
<form action="index.php?uc=validerfrais&action=selectionnervisiteur" method="POST">
    <div class="corpsForm">
        <p> <!-- choix du visiteur avec une liste déroulante nom et prénom -->
            <label for="choixvisiteur">Choisir Visiteur : </label>
            <select name="choixVisiteur">
                <?php

                while ($result = $lesVisiteurs->fetch()) {
                    echo "<option value='" . $result['nom'] . "'>" . $result['nom'] ." ". $result['prenom'] . "</option>";
                }
                ?> 
            </select>
        </p>

    </div>
    <div class="piedForm">
        <p>
            <input type="submit" value="Valider" size="20" />
            <input type="reset" value="Effacer" size="20" />
        </p> 
    </div>
</form>