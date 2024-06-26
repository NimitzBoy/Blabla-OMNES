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
    if (isset($_POST["adresseMail"], $_POST["motDePasse"], $_POST["nom"], $_POST["prenom"], $_POST["Numero_de_telephone"], $_FILES["user_photo"], $_FILES["photo_permis"], $_POST["Numero_du_permis"], $_POST["date_obtention_permis"])) {
        $email = htmlspecialchars($_POST["adresseMail"], ENT_QUOTES, 'UTF-8');
        $motDePasse = $_POST["motDePasse"];
        $nom = htmlspecialchars($_POST["nom"], ENT_QUOTES, 'UTF-8');
        $prenom = htmlspecialchars($_POST["prenom"], ENT_QUOTES, 'UTF-8');
        $numero = htmlspecialchars($_POST["Numero_de_telephone"], ENT_QUOTES, 'UTF-8');
        $numeroPermis = htmlspecialchars($_POST["Numero_du_permis"], ENT_QUOTES, 'UTF-8');
        $dateObtentionPermis = htmlspecialchars($_POST["date_obtention_permis"], ENT_QUOTES, 'UTF-8');

        // Validation de l'email
        if (!endsWith($email, '@edu.ece.fr') && !endsWith($email, '@gmail.com') && !endsWith($email, '@omnesintervenant.com')) {
            header('Location: creationCompte.php');
            exit();
        }

        // Traitement de l'upload de la photo de profil
        $photo = $_FILES["user_photo"];
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($photo["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Vérification si l'image est bien un fichier image
        $check = getimagesize($photo["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "Le fichier n'est pas une image.";
            $uploadOk = 0;
        }

        // Vérifier si le fichier existe déjà
        if (file_exists($targetFile)) {
            echo "Désolé, le fichier existe déjà.";
            $uploadOk = 0;
        }

        // Vérifier la taille du fichier
        if ($photo["size"] > 500000) { // 500 KB
            echo "Désolé, votre fichier est trop volumineux.";
            $uploadOk = 0;
        }

        // Autoriser certains formats de fichier
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Désolé, seuls les fichiers JPG, JPEG, PNG et GIF sont autorisés.";
            $uploadOk = 0;
        }

        // Vérifier si $uploadOk est défini à 0 par une erreur
        if ($uploadOk == 0) {
            echo "Désolé, votre fichier n'a pas été téléchargé.";
        } else {
            if (move_uploaded_file($photo["tmp_name"], $targetFile)) {
                echo "Le fichier ". htmlspecialchars(basename($photo["name"])) . " a été téléchargé.";
            } else {
                echo "Désolé, une erreur s'est produite lors du téléchargement de votre fichier.";
            }
        }

        // Traitement de l'upload du permis de conduire
        $photoPermis = $_FILES["photo_permis"];
        $targetDirPermis = "uploads/";
        $targetFilePermis = $targetDirPermis . basename($photoPermis["name"]);
        $uploadOkPermis = 1;
        $imageFileTypePermis = strtolower(pathinfo($targetFilePermis, PATHINFO_EXTENSION));

        // Vérification si le fichier est bien une image
        $checkPermis = getimagesize($photoPermis["tmp_name"]);
        if ($checkPermis !== false) {
            $uploadOkPermis = 1;
        } else {
            echo "Le fichier n'est pas une image.";
            $uploadOkPermis = 0;
        }

        // Vérifier si le fichier existe déjà
        if (file_exists($targetFilePermis)) {
            echo "Désolé, le fichier existe déjà.";
            $uploadOkPermis = 0;
        }

        // Vérifier la taille du fichier
        if ($photoPermis["size"] > 500000) { // 500 KB
            echo "Désolé, votre fichier est trop volumineux.";
            $uploadOkPermis = 0;
        }

        // Autoriser certains formats de fichier
        if ($imageFileTypePermis != "jpg" && $imageFileTypePermis != "png" && $imageFileTypePermis != "jpeg" && $imageFileTypePermis != "gif") {
            echo "Désolé, seuls les fichiers JPG, JPEG, PNG et GIF sont autorisés.";
            $uploadOkPermis = 0;
        }

        // Vérifier si $uploadOkPermis est défini à 0 par une erreur
        if ($uploadOkPermis == 0) {
            echo "Désolé, votre fichier n'a pas été téléchargé.";
        } else {
            if (move_uploaded_file($photoPermis["tmp_name"], $targetFilePermis)) {
                echo "Le fichier ". htmlspecialchars(basename($photoPermis["name"])) . " a été téléchargé.";
            } else {
                echo "Désolé, une erreur s'est produite lors du téléchargement de votre fichier.";
            }
        }

        if ($uploadOk == 1 && $uploadOkPermis == 1) {
            try {
                $stmt = $bdd->prepare("INSERT INTO Utilisateur (email, mot_de_passe, nom, prenom, numero, photo, photo_permis, numero_permis, date_obtention_permis) VALUES (:email, :motDePasse, :nom, :prenom, :numero, :photo, :photoPermis, :numeroPermis, :dateObtentionPermis)");
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':motDePasse', $motDePasse);
                $stmt->bindParam(':nom', $nom);
                $stmt->bindParam(':prenom', $prenom);
                $stmt->bindParam(':numero', $numero);
                $stmt->bindParam(':photo', $targetFile);
                $stmt->bindParam(':photoPermis', $targetFilePermis);
                $stmt->bindParam(':numeroPermis', $numeroPermis);
                $stmt->bindParam(':dateObtentionPermis', $dateObtentionPermis);

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
}
?>


