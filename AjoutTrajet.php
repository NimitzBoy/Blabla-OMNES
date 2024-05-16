<?php
require_once("config.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["Adresse_de_départ"], $_POST["Adresse_d'arrivée"], $_POST["Prix_du_trajet_par_personne"])){
        $lieu_depart = $_POST["Adresse_de_départ"];
        $lieu_arrivee = $_POST["Adresse_d'arrivée"];
        //$type_trajet = $_POST[""];
        $prix = $_POST["Prix_du_trajet_par_personne"];
        try {
            $stmt = $bdd->prepare("INSERT INTO trajet (lieu_depart, lieu_arrivee,prix) VALUES (:lieu_depart, :lieu_arrivee, :prix)");
            $stmt->bindParam(':lieu_depart', $lieu_depart);
            $stmt->bindParam(':lieu_arrivee', $lieu_arrivee);
            $stmt->bindParam(':prix', $prix);
            if ($stmt->execute()) {
                echo "Données ajoutées avec succès.";
            } else {
                echo "Erreur lors de l'ajout des données.";
            }
        } catch (PDOException $e) {
            echo 'ERREUR : ' . $e->getMessage();
        }
    }
}
?>