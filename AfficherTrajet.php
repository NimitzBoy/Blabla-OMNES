<?php
require_once("config.php");

if (isset($_POST["Lieu Départ"], $_POST["destination"])) {
    $lieu_depart = $_POST["Lieu Départ"];
    $lieu_arrivee = $_POST["destination"];

    try {
        $stmt = $bdd->prepare("SELECT * FROM trajet WHERE lieu_depart = :lieu_depart AND lieu_arrivee = :lieu_arrivee");
        $stmt->bindParam(':lieu_depart', $lieu_depart);
        $stmt->bindParam(':lieu_arrivee', $lieu_arrivee);
        $stmt->execute();

        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Affichage des détails du premier trajet trouvé correspondant
            echo "<h1>Détails du Trajet</h1>";
            echo "<p>Adresse de départ: " . $row['lieu_depart'] . "</p>";
            echo "<p>Adresse d'arrivée: " . $row['lieu_arrivee'] . "</p>";
            echo "<p>Prix du trajet par personne: " . $row['prix'] . "€</p>";
        } else {
            echo "Aucun trajet trouvé avec ces lieux de départ et d'arrivée.";
        }
    } catch (PDOException $e) {
        echo 'ERREUR : ' . $e->getMessage();
    }
} else {
    echo "Veuillez spécifier à la fois le lieu de départ et le lieu d'arrivée.";
}
?>
