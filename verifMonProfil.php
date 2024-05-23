<?php
require_once("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    if(isset($_POST['Mes_trajets']))
    {
        $Nom = htmlspecialchars($_POST['Mes_trajets']);
    
    //verification des données POST
    var_dump($_POST);

    // ID de l'utilisateur dont on veut afficher les trajets
    $id_utilisateur = $_POST['id_utilisateur'];
try{
    // Préparation et exécution de la requête SQL
    $sql = "SELECT t.* FROM trajet t INNER JOIN ustilisateur u ON t.id_utilisateur=u.id WHERE u.id = :id_utilisateur";
    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(':id_utilisateur', $id_utilisateur);
    $stmt->execute();
    
    // Vérification des résultats et affichage
    if ($stmt->rowCount() > 0) {
        echo "<table>
        <tr>
        <th>ID</th>
        <th>Départ</th>
        <th>Arrivée</th>
        <th>Date</th>
        </tr>";
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>
            <td>" . htmlspecialchars($row['id_trajet']) . "</td>
            <td>" . htmlspecialchars($row['lieu_depart']) . "</td>
            <td>" . htmlspecialchars($row['lieu_arrivee']) . "</td>
            <td>" . htmlspecialchars($row['date_depart']) . "</td>
            </tr>";
        }
        echo "</table>";
    } else {
        echo "Aucun trajet trouvé";
    }

}catch(PDOException $e) {
    echo 'ERREUR : ' . $e->getMessage();
        }
    }
}

?>
