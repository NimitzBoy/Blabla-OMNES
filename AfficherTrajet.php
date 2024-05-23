<?php
require_once("config.php");

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: connexionPassager.php");
    exit();
}

if (isset($_POST["Lieu_Départ"], $_POST["destination"])) {
    $lieu_depart = $_POST["Lieu_Départ"];
    $lieu_arrivee = $_POST["destination"];
    $date_depart = $_POST["date_départ"];

    try {
        $stmt = $bdd->prepare("SELECT * FROM trajet WHERE lieu_depart = :lieu_depart AND lieu_arrivee = :lieu_arrivee AND date_depart = :date_depart");
        $stmt->bindParam(':lieu_depart', $lieu_depart);
        $stmt->bindParam(':lieu_arrivee', $lieu_arrivee);
        $stmt->bindParam(':date_depart', $date_depart);
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($results) {
            echo "<h1>Liste des Trajets</h1>";
            foreach ($results as $row) {
                echo "<div class='trajet'>";
                echo "<p>Adresse de départ: " . htmlspecialchars($row['lieu_depart']) . "</p>";
                echo "<p>Adresse d'arrivée: " . htmlspecialchars($row['lieu_arrivee']) . "</p>";
                echo "<p>Date de départ: " . htmlspecialchars($row['date_depart']) . "</p>";
                echo "<p>Prix du trajet par personne: " . htmlspecialchars($row['prix']) . "€</p>";
                echo "<form method='post' action='reserverTrajet.php'>";
                echo "<input type='hidden' name='trajet_id' value='" . htmlspecialchars($row['id_trajet']) . "'>";
                echo "<button type='submit'>Réserver</button>";
                echo "</form>";
                echo "</div><hr>";
            }
        } else {
            echo "Aucun trajet trouvé avec ces lieux de départ, d'arrivée et cette date.";
        }
    } catch (PDOException $e) {
        echo 'ERREUR : ' . $e->getMessage();
    }
} else {
    echo "Veuillez spécifier à la fois le lieu de départ et le lieu d'arrivée.";
}
?>
