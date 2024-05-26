<?php
require_once("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["montant"]) && isset($_SESSION['user_id'])) {
        $id_utilisateur = $_SESSION['user_id'];
        $montant = floatval($_POST["montant"]);

        try {
            // Récupérer le portefeuille actuel de l'utilisateur
            $stmt = $bdd->prepare("SELECT wallet FROM utilisateur WHERE id_utilisateur = :id_utilisateur");
            $stmt->bindParam(':id_utilisateur', $id_utilisateur);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                // Mettre à jour le portefeuille de l'utilisateur
                $nouveau_solde = $result['wallet'] + $montant;
                $stmt_update = $bdd->prepare("UPDATE utilisateur SET wallet = :wallet WHERE id_utilisateur = :id_utilisateur");
                $stmt_update->bindParam(':wallet', $nouveau_solde);
                $stmt_update->bindParam(':id_utilisateur', $id_utilisateur);
                $stmt_update->execute();
                echo "Portefeuille augmenté avec succès.";
            } else {
                echo "Utilisateur non trouvé.";
            }
        } catch (PDOException $e) {
            echo 'ERREUR : ' . $e->getMessage();
        }
    } else {
        echo "Données invalides.";
    }
}
?>
