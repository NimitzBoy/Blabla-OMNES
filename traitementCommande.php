<?php
$Mobilier = 200;
$Informatique = 500;
$Loisirs = 50;
   
if (isset($_POST["Identifiant_de_la_commande"], $_POST["Nom_du_produit"], $_POST["Quantité"], $_POST["Catégorie_du_produit"],$_POST["Type_de_client"]))
        if($_POST["Identifiant_de_la_commande"]== NULL ||  $_POST["Nom_du_produit"]== NULL || $_POST["Quantité"]== NULL || $_POST["Catégorie_du_produit"]== NULL ||  $_POST["Type_de_client"] == NULL){
            echo "il faut remplir tous les champs";
        }
       
        if ($_POST["Quantité"] > 5 && $_POST["Quantité"] < 9){
            $Mobilier = ($Mobilier * 0.8) * $_POST["Quantité"];
            echo 'Prix apres reduc :' . $Mobilier;
            $Informatique = $Informatique * 0.8;
            echo 'Prix apres reduc : ' . $Informatique;
            $Loisirs = $Loisirs * 0.8;
            echo 'Prix apres reduc : ' . $Loisirs;

        }
        if ($_POST["Quantité"] > 9){
            $Mobilier = $Mobilier * 1.5;
            echo 'Prix apres reduc : ' . $Mobilier;
            $Informatique = $Informatique * 1.5;
            echo 'Prix apres reduc : ' . $Informatique;
            $Loisirs = $Loisirs * 1.5;
            echo 'Prix apres reduc : ' . $Loisirs;
        }
        if ($_POST["Catégorie_du_produit"] === "Informatique"){

        }
        if ($_POST["Catégorie_du_produit"] === "Loisir"){

        }
    }
?>