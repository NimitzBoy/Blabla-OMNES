<!DOCTYPE html>
<html lang="fr">

<head>
    <title>BlablaOMNES.com</title>
    <meta charset="UTF-8">
    <link rel="stylesheet">
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
        function confirmDeletion(campusId) {
            if (confirm('Êtes-vous sûr de vouloir supprimer ce campus ?')) {
                document.getElementById('deleteForm-' + campusId).submit();
            }
        }
    </script>
</head>

<body>

<?php
require_once("config.php");

// Traitement de la suppression de campus
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_id_campus'])) {
    $deleteIdCampus = $_POST['delete_id_campus'];
    $sql = "DELETE FROM campus WHERE id_campus = :id";
    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(':id', $deleteIdCampus, PDO::PARAM_INT);
    try {
        $stmt->execute();
        echo '<p>Campus supprimé avec succès.</p>';
    } catch (PDOException $e) {
        echo '<p>Erreur lors de la suppression du campus : ' . $e->getMessage() . '</p>';
    }
}

// Traitement de l'ajout de campus
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Ajout_campus'])) {
    $campusName = $_POST['Ajout_campus'];
    if (!empty($campusName)) {
        $sql = "INSERT INTO campus (nom) VALUES (:nom)";
        $stmt = $bdd->prepare($sql);
        $stmt->bindParam(':nom', $campusName, PDO::PARAM_STR);
        try {
            $stmt->execute();
            echo '<p>Campus ajouté avec succès.</p>';
        } catch (PDOException $e) {
            echo '<p>Erreur lors de l\'ajout du campus : ' . $e->getMessage() . '</p>';
        }
    } else {
        echo '<p>Erreur : Le nom du campus ne peut pas être vide.</p>';
    }
}
?>

<h1>Ajout Campus</h1>
<form method="post" action="">
    <div><input type="text" name="Ajout_campus" required><br></div>
    <button type="submit">Ajouter</button>
</form>

<h1>Liste des Campus</h1>
<?php
// Requête SQL pour récupérer la liste des campus
$sql = "SELECT * FROM campus";
try {
    $stmt = $bdd->query($sql);

    // Vérifier si des campus sont trouvés
    if ($stmt->rowCount() > 0) {
        echo '<table>';
        echo '<tr><th>ID</th><th>Nom</th><th>Action</th></tr>';
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($row['id_campus']) . '</td>';
            echo '<td>' . htmlspecialchars($row['nom']) . '</td>';
            echo '<td>';
            echo '<form id="deleteForm-' . htmlspecialchars($row['id_campus']) . '" method="POST" style="display:inline;">';
            echo '<input type="hidden" name="delete_id_campus" value="' . htmlspecialchars($row['id_campus']) . '">';
            echo '<button type="button" onclick="confirmDeletion(' . htmlspecialchars($row['id_campus']) . ')">Supprimer</button>';
            echo '</form>';
            echo '</td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo '<p>Aucun campus trouvé.</p>';
    }
} catch (PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}
?>
</body>
</html>
