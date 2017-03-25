<?php
/**
* Connexion au serveur
*/
function connexionPDO() {
    $login = "dbo669148864";
    $mdp = "czCQuuir3QiLuVHS";
    $bd = "db669148864";
    $serveur = "db669148864.db.1and1.com:3306";
    try {
        $conn = new PDO("mysql:host=$serveur;dbname=$bd", $login, $mdp);        
        return $conn;
    } catch (PDOException $e) {
        print "Erreur de connexion PDO ";
        die();
    }
}

?>
