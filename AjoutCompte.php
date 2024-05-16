<?php
require_once("config.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["adresseMail"]; 
    $motDePasse = $_POST["motDePasse"];
    $nom = $_POST["nom"]; 
    $prenom = $_POST["prenom"];
    //$numero = $_POST["Numero_de_telephone"];
    try {
        $stmt = $bdd->prepare("INSERT INTO Utilisateur (email, mot_de_passe,nom,prenom) VALUES (:email, :motDePasse, :nom, :prenom)");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':motDePasse', $motDePasse);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        //$stmt->bindParam(':numero', $numero);
        if ($stmt->execute()) {
            echo "Données ajoutées avec succès.";
        } else {
            echo "Erreur lors de l'ajout des données.";
        }
    } catch (PDOException $e) {
        echo 'ERREUR : ' . $e->getMessage();
    }
}
?>



