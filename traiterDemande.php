<?php
require_once("config.php");

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: connexionConducteur.php");
    exit();
}

// Vérifier les paramètres
if (isset($_GET['id_trajet']) && isset($_GET['id_passager'])) {
    $id_trajet = $_GET['id_trajet'];
    $id_passager = $_GET['id_passager'];

    try {
        // Mettre à jour le statut de la réservation
        $stmt = $bdd->prepare("UPDATE reservation SET statut = 'accepté' WHERE id_trajet = :id_trajet AND id_passager = :id_passager");
        $stmt->bindParam(':id_trajet', $id_trajet);
        $stmt->bindParam(':id_passager', $id_passager);
        $stmt->execute();

        // Ajouter une notification pour le passager
        $notification = "Votre réservation pour le trajet n° " . $id_trajet . " a été acceptée.";
        $stmt = $bdd->prepare("UPDATE utilisateur SET notifications = :notification WHERE id_utilisateur = :id_passager");
        $stmt->bindParam(':notification', $notification);
        $stmt->bindParam(':id_passager', $id_passager);
        $stmt->execute();

        echo "<h2>Réservation acceptée avec succès.</h2>";
    } catch (Exception $e) {
        echo "Erreur : " . $e->getMessage();
    }
} else {
    echo "<h2>Paramètres manquants.</h2>";
}
?>

