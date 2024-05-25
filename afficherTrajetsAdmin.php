<?php
require_once("config.php");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Trajets</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>

    <script>
        // fonction de suppression pour les tajets 
        function confirmDeletion(trajetId) { 
            if (confirm('Êtes-vous sûr de vouloir supprimer ce trajet ?')) {
                document.getElementById('deleteForm-' + trajetId).submit();
            }
        }
    </script>
    
</head>
<body>
    <h1>Liste des Trajets</h1>
    <?php
    
    // Traitement de la suppression
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_trajet_id'])) {
        $deleteUserId = $_POST['delete_trajet_id'];
        $deleteSql = "DELETE FROM trajet WHERE id_trajet = :id";
        $deleteStmt = $bdd->prepare($deleteSql);
        $deleteStmt->bindParam(':id', $deleteUserId, PDO::PARAM_INT);
        try {
            $deleteStmt->execute();
            echo '<p>Trajet supprimé avec succès.</p>';
        } catch (PDOException $e) {
            echo '<p>Erreur lors de la suppression du trajet: ' . $e->getMessage() . '</p>';
        }
    }

    // Requête SQL pour récupérer les utilisateurs
    $sql = "SELECT * FROM trajet"; 
    try {
        $stmt = $bdd->query($sql);

        // Vérifier si des utilisateurs sont trouvés
        if ($stmt->rowCount() > 0) {
            echo '<table>';
            echo '<tr><th>ID</th><th>ID conducteur</th><th>Date de départ</th><th>Lieu de départ</th><th>Lieu d\'arrivée</th><th>Place disponible</th><th>Prix</th><th>Type de trajet</th></tr>';
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($row['id_trajet']) . '</td>';
                echo '<td>' . htmlspecialchars($row['conducteur_id']) . '</td>';
                echo '<td>' . htmlspecialchars($row['date_depart']) . '</td>';
                echo '<td>' . htmlspecialchars($row['lieu_depart']) . '</td>';
                echo '<td>' . htmlspecialchars($row['lieu_arrivee']) . '</td>';
                echo '<td>' . htmlspecialchars($row['places_disponibles']) . '</td>';
                echo '<td>' . htmlspecialchars($row['prix']) . '</td>';
                echo '<td>' . htmlspecialchars($row['type_trajet']) . '</td>';
                echo '<td>';
                echo '<form id="deleteForm-' . htmlspecialchars($row['id_trajet']) . '" method="POST" style="display:inline;">';
                echo '<input type="hidden" name="delete_trajet_id" value="' . htmlspecialchars($row['id_trajet']) . '">';
                echo '<button type="button" onclick="confirmDeletion(' . htmlspecialchars($row['id_trajet']) . ')">Supprimer</button>';
                echo '</form>';
                echo '</td>';
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo '<p>Aucun utilisateur trouvé.</p>';
        }
    } catch(PDOException $e) {
        echo "Erreur: " . $e->getMessage();
    }
    ?>
</body>
</html>
