<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $prenom = $_POST["prenom"];
    $motDePasse = $_POST["mot_de_passe"];

    require 'config.php';
    try{
        $bdd = new PDO($Serveur,$User,$Pass);
        echo 'Connexion reussie !';
    }
    catch (PDOException $e)
    {
        echo 'ERREUR :'.$e->getMessage();
    }
    
    $stmt = $bdd->prepare("INSERT INTO users (Id, login, MotDePasse) VALUES (NULL, :prenom, :motDePasse)");
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':motDePasse', $motDePasse);
    if ($stmt->execute()) {
        echo "Données ajoutées avec succès.";
    } else {
        echo "Erreur lors de l'ajout des données.";
    }
}
?>
