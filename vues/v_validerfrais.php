<?php
$lesVisiteurs = $pdo->getVisiteur();
?>
<div id="contenu">
    <h2>Validation des frais par visiteur</h2>

    
        <div class="corpsForm">
            <p> <!-- choix du visiteur par liste déroulante nom et prénom -->
                <label for="choixvisiteur">Choisir Visiteur : </label>
                <select name="choixVisiteur">
                       <?php
                    $bdd = new PDO('mysql:host=localhost;dbname=gsbV2;charset=utf8', 'root', '');
                    $reponse = $bdd->query('SELECT visiteur.id FROM visiteur');
                    while ($donnees = $reponse->fetch()) {
                         echo "<option value='".$donnees['id'].">".$donnees['id']."</option>";
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
