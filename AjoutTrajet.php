<?php
require_once("config.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["Adresse_de_départ"], $_POST["Adresse_d'arrivée"], $_POST["Prix_du_trajet_par_personne"], $_POST["Date_départ"])){
        $lieu_depart = $_POST["Adresse_de_départ"];
        $lieu_arrivee = $_POST["Adresse_d'arrivée"];
        $date_depart = $_POST["Date_départ"];
        $type_trajet = $_POST["type_trajet"];
        $prix = $_POST["Prix_du_trajet_par_personne"];
        try {
            $stmt = $bdd->prepare("INSERT INTO trajet (lieu_depart, lieu_arrivee, prix, date_depart, type_trajet) VALUES (:lieu_depart, :lieu_arrivee, :prix, :date_depart, :type_trajet)");
            $stmt->bindParam(':lieu_depart', $lieu_depart);
            $stmt->bindParam(':lieu_arrivee', $lieu_arrivee);
            $stmt->bindParam(':date_depart', $date_depart);
            $stmt->bindParam(':prix', $prix);
            $stmt->bindParam(':type_trajet', $type_trajet);
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