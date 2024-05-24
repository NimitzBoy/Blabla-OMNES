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
        function confirmDeletion(userId) {
            if (confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')) {
                document.getElementById('deleteForm-' + userId).submit();
            }
        }
    </script>
</head>
<body>
    <h1>Liste des Utilisateurs</h1>
    <?php
    // Liste des emails des administrateurs
    $adminEmails = ["mathilde.admin@gmail.com", "arnaud.admin@gmail.com", "william.admin@gmail.com"];
    
    // Traitement de la suppression
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_user_id'])) {
        $deleteUserId = $_POST['delete_user_id'];
        // Vérifier si l'utilisateur à supprimer n'est pas un administrateur
        $checkEmailSql = "SELECT email FROM utilisateur WHERE id_utilisateur = :id";
        $checkEmailStmt = $bdd->prepare($checkEmailSql);
        $checkEmailStmt->bindParam(':id', $deleteUserId, PDO::PARAM_INT);
        $checkEmailStmt->execute();
        $userEmail = $checkEmailStmt->fetchColumn();
        
        if (!in_array($userEmail, $adminEmails)) {
            $deleteSql = "DELETE FROM utilisateur WHERE id_utilisateur = :id";
            $deleteStmt = $bdd->prepare($deleteSql);
            $deleteStmt->bindParam(':id', $deleteUserId, PDO::PARAM_INT);
            try {
                $deleteStmt->execute();
                echo '<p>Utilisateur supprimé avec succès.</p>';
            } catch (PDOException $e) {
                echo '<p>Erreur lors de la suppression de l\'utilisateur: ' . $e->getMessage() . '</p>';
            }
        } else {
            echo '<p>Erreur: Impossible de supprimer un compte administrateur.</p>';
        }
    }

    // Requête SQL pour récupérer les utilisateurs avec leur photo
    $sql = "SELECT * FROM utilisateur"; 
    try {
        $stmt = $bdd->query($sql);

        // Vérifier si des utilisateurs sont trouvés
        if ($stmt->rowCount() > 0) {
            echo '<table>';
            echo '<tr><th>ID</th><th>Nom</th><th>Prénom</th><th>Email</th><th>Mot de passe</th><th>Numero</th><th>Photo</th><th>Action</th></tr>';
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($row['id_utilisateur']) . '</td>';
                echo '<td>' . htmlspecialchars($row['nom']) . '</td>';
                echo '<td>' . htmlspecialchars($row['prenom']) . '</td>';
                echo '<td>' . htmlspecialchars($row['email']) . '</td>';
                echo '<td>' . htmlspecialchars($row['mot_de_passe']) . '</td>';
                echo '<td>' . htmlspecialchars($row['numero']) . '</td>';
                echo '<td>';
                // Afficher la photo de l'utilisateur s'il en a une
                if (!empty($row['photo'])) {
                    echo '<img src="' . htmlspecialchars($row['photo']) . '" alt="Photo de profil" style="max-width: 100px; max-height: 100px;">';
                } else {
                    echo 'Pas de photo';
                }
                echo '</td>';
                echo '<td>';
                // Vérifier si l'utilisateur n'est pas un administrateur avant d'afficher le bouton de suppression
                if (!in_array($row['email'], $adminEmails)) {
                    echo '<form id="deleteForm-' . htmlspecialchars($row['id_utilisateur']) . '" method="POST" style="display:inline;">';
                    echo '<input type="hidden" name="delete_user_id" value="' . htmlspecialchars($row['id_utilisateur']) . '">';
                    echo '<button type="button" onclick="confirmDeletion(' . htmlspecialchars($row['id_utilisateur']) . ')">Supprimer</button>';
                    echo '</form>';
                } else {
                    echo 'Administrateur';
                }
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


