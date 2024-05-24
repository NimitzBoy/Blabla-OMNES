<?php
require_once("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['Adresse_mail'];
    $password = $_POST['Mot_de_passe'];

    // requête SQL pour sélectionner l'utilisateur correspondant à l'adresse e-mail
    $sql = "SELECT * FROM utilisateur WHERE email = :email";
    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(':email', $email);
    if(!$stmt->execute()) {
        // Gestion des erreurs de la requête SQL
        echo "Erreur lors de l'exécution de la requête SQL.";
        exit;
    }

    if ($stmt->rowCount() > 0) {
        // l'utilisateur est trouvé -> récupérer les données de l'utilisateur
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($email === "mathilde.admin@gmail.com" || $email === "william.admin@gmail.com" || $email === "arnaud.admin@gmail.com" && $password === $row['mot_de_passe']){
            $_SESSION['user_id'] = $row['id_utilisateur'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['prenom'] = $row['prenom'];
            header("Location: CompteAdministrateur.php");
        }else if ($password === $row['mot_de_passe']){
            $_SESSION['user_id'] = $row['id_utilisateur'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['prenom'] = $row['prenom'];
            header("Location: BlablaOmnesConnectePassager.php");
        } else {
            // mot de passe incorrect
            echo "Mot de passe incorrect.";
        }
    } else {
        // utilisateur non trouvé
        echo "Adresse e-mail non enregistrée.";
    }
}
?>



