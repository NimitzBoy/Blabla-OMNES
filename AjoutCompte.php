<?php
require_once("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["adresseMail"], $_POST["motDePasse"], $_POST["nom"], $_POST["prenom"],$_POST["Numero_de_telephone"])) {
        $email = htmlspecialchars($_POST["adresseMail"], ENT_QUOTES, 'UTF-8');
        $motDePasse = $_POST["motDePasse"];
        $nom = htmlspecialchars($_POST["nom"], ENT_QUOTES, 'UTF-8');
        $prenom = htmlspecialchars($_POST["prenom"], ENT_QUOTES, 'UTF-8');
        $numero = htmlspecialchars($_POST["Numero_de_telephone"], ENT_QUOTES, 'UTF-8');

        try {
            $stmt = $bdd->prepare("INSERT INTO Utilisateur (email, mot_de_passe, nom, prenom, numero) VALUES (:email, :motDePasse, :nom, :prenom, :numero)");
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':motDePasse', $motDePasse);
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':prenom', $prenom);
            $stmt->bindParam(':numero', $numero);

            if ($stmt->execute()) {
                echo "Données ajoutées avec succès.";
            } else {
                echo "Erreur lors de l'ajout des données.";
            }
        } catch (PDOException $e) {
            echo 'ERREUR : ' . $e->getMessage();
        }
    }
}
?>




