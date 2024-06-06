<?php
// Ce fichier permet de tester les fonctions développées dans le fichier bdd.php (première partie)

// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) == "users.php") {
    header("Location:../index.php?view=users");
    die("");
}

include_once ("libs/modele.php");
include_once ("libs/maLibUtils.php"); // tprint
include_once ("libs/maLibForms.php");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Typology Information</title>
    <link rel="stylesheet" href="page.css">
</head>
<body>
    <div class="principal_propos">
    <div class="container_propos">
        <div class="card">
            <img src="ressources/logo.png" alt="Notre Histoire">
            <h2>NOTRE PROJET</h2>
            <p>Notre mission est de créer un site web, utile ainsi qu'utilisable dans l'optique d'un projet à IG2I Centrale Lille</p>
        </div>
        <div class="card">
            <img src="ressources/logo.png" alt="Ingrédients & Formulation">
            <h2>VOS CO-OWNER</h2>
            <p>Tout deux en 1ère année, à IG2I Centrale Lille en tant qu'étudiant ingénieur en Informatique et Industriel</p>
        </div>
        <div class="card">
            <img src="ressources/logo.png" alt="Packaging">
            <h2>L'OPTIQUE</h2>
            <p>Le site a été prévu pour allier votre garde-robe au choix difficile qu'est le fait de mettre une tenue en accord à la météo</p>
        </div>
        <div class="card">
            <img src="ressources/logo.png" alt="B Corp">
            <h2>Algorithme</h2>
            <p>Vos tenues sont données suivant un algorithme précis en fonction de la météo, des informations indiquées ainsi qu'en fonction du taux d'humidité</p>
        </div>
    </div>
    </div>
</body>
</html>
