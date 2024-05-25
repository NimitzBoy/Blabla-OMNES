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
        function confirmValidation(userId) {
            if (confirm('Êtes-vous sûr de vouloir valider le permis de cet utilisateur ?')) {
                document.getElementById('validateForm-' + userId).submit();
            }
        }
    </script>
</head>
<body>
    <h1>Liste des Utilisateurs</h1>
    <?php
    require_once("config.php");

    // Traitement de la validation du permis
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['validate_user_id'])) {
        $validateUserId = $_POST['validate_user_id'];
        // Mettre à jour la colonne 'validation_permis' dans la base de données
        $updateSql = "UPDATE utilisateur SET validation_permis = 1 WHERE id_utilisateur = :id";
        $updateStmt = $bdd->prepare($updateSql);
        $updateStmt->bindParam(':id', $validateUserId, PDO::PARAM_INT);
        try {
            $updateStmt->execute();
            echo '<p>Validation du permis de l\'utilisateur avec ID ' . $validateUserId . ' effectuée avec succès.</p>';
        } catch (PDOException $e) {
            echo '<p>Erreur lors de la validation du permis: ' . $e->getMessage() . '</p>';
        }
    }

    // Requête SQL pour récupérer les informations sur le permis de conduire des utilisateurs
    $sql = "SELECT id_utilisateur, prenom, photo_permis, numero_permis, date_obtention_permis, validation_permis FROM utilisateur WHERE email NOT IN ('arnaud.admin@gmail.com', 'mathilde.admin@gmail.com', 'william.admin@gmail.com')"; 
    try {
        $stmt = $bdd->query($sql);

        // Vérifier si des utilisateurs sont trouvés
        if ($stmt->rowCount() > 0) {
            echo '<table>';
            echo '<tr><th>ID Utilisateur</th><th>Prénom</th><th>Photo du permis</th><th>Numero du permis</th><th>Date d\'obtention du permis</th><th>Validation du permis</th><th>Action</th></tr>';
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($row['id_utilisateur']) . '</td>';
                echo '<td>' . htmlspecialchars($row['prenom']) . '</td>';
                echo '<td>';
                // Afficher la photo du permis de conduire de l'utilisateur s'il en a une
                if (!empty($row['photo_permis'])) {
                    echo '<img src="' . htmlspecialchars($row['photo_permis']) . '" alt="Photo du permis" style="max-width: 100px; max-height: 100px;">';
                } else {
                    echo 'Pas de photo';
                }
                echo '</td>';
                echo '<td>' . htmlspecialchars($row['numero_permis']) . '</td>';
                echo '<td>' . htmlspecialchars($row['date_obtention_permis']) . '</td>';
                echo '<td>' . ($row['validation_permis'] == 1 ? 'Validé' : 'Non validé') . '</td>';
                echo '<td>';
                echo '<form id="validateForm-' . htmlspecialchars($row['id_utilisateur']) . '" method="POST" style="display:inline;">';
                echo '<input type="hidden" name="validate_user_id" value="' . htmlspecialchars($row['id_utilisateur']) . '">';
                echo '<button type="button" onclick="confirmValidation(' . htmlspecialchars($row['id_utilisateur']) . ')">Valider</button>';
                echo '</form>';
                echo '</td>';
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo '<p>Aucune information sur le permis de conduire trouvée.</p>';
        }
    } catch(PDOException $e) {
        echo "Erreur: " . $e->getMessage();
    }
    ?>
</body>
</html>



