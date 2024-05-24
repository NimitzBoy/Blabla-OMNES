<?php
require_once("config.php");

function endsWith($string, $endString) { // fonction qui permet de comparer la fin des adresses mails
    $len = strlen($endString);
    if ($len == 0) {
        return true;
    }
    return (substr($string, -$len) === $endString);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["adresseMail"], $_POST["motDePasse"], $_POST["nom"], $_POST["prenom"],$_POST["Numero_de_telephone"])) {
        $email = htmlspecialchars($_POST["adresseMail"], ENT_QUOTES, 'UTF-8');
        $motDePasse = $_POST["motDePasse"];
        $nom = htmlspecialchars($_POST["nom"], ENT_QUOTES, 'UTF-8');
        $prenom = htmlspecialchars($_POST["prenom"], ENT_QUOTES, 'UTF-8');
        $numero = htmlspecialchars($_POST["Numero_de_telephone"], ENT_QUOTES, 'UTF-8');

        if (!endsWith($email, '@edu.ece.fr') || !endsWith($email, '@gmail.com') || !endsWith($email, '@omnesintervenant.com')) {
            header('Location: creationCompte.php');
        }

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




