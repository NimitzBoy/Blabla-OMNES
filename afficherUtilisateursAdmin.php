<?php
require_once("config.php");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Utilisateurs</title>
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
        function confirmDeletion(userId) { // fonction de suppression des comptes
            if (confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')) {
                document.getElementById('deleteForm-' + userId).submit();
            }
        }
    </script>
</head>
<body>
    <h1>Liste des Utilisateurs</h1>
    <?php
    
    // Traitement de la suppression
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_user_id'])) {
        $deleteUserId = $_POST['delete_user_id'];
        $deleteSql = "DELETE FROM utilisateur WHERE id_utilisateur = :id";
        $deleteStmt = $bdd->prepare($deleteSql);
        $deleteStmt->bindParam(':id', $deleteUserId, PDO::PARAM_INT);
        try {
            $deleteStmt->execute();
            echo '<p>Utilisateur supprimé avec succès.</p>';
        } catch (PDOException $e) {
            echo '<p>Erreur lors de la suppression de l\'utilisateur: ' . $e->getMessage() . '</p>';
        }
    }

    // Requête SQL pour récupérer les utilisateurs
    $sql = "SELECT * FROM utilisateur"; 
    try {
        $stmt = $bdd->query($sql);

        // Vérifier si des utilisateurs sont trouvés
        if ($stmt->rowCount() > 0) {
            echo '<table>';
            echo '<tr><th>ID</th><th>Nom</th><th>Prénom</th><th>Email</th><th>Mot de passe</th><th>Numero</th></tr>';
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($row['id_utilisateur']) . '</td>';
                echo '<td>' . htmlspecialchars($row['nom']) . '</td>';
                echo '<td>' . htmlspecialchars($row['prenom']) . '</td>';
                echo '<td>' . htmlspecialchars($row['email']) . '</td>';
                echo '<td>' . htmlspecialchars($row['mot_de_passe']) . '</td>';
                echo '<td>' . htmlspecialchars($row['numero']) . '</td>';
                echo '<td>';
                echo '<form id="deleteForm-' . htmlspecialchars($row['id_utilisateur']) . '" method="POST" style="display:inline;">';
                echo '<input type="hidden" name="delete_user_id" value="' . htmlspecialchars($row['id_utilisateur']) . '">';
                echo '<button type="button" onclick="confirmDeletion(' . htmlspecialchars($row['id_utilisateur']) . ')">Supprimer</button>';
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

