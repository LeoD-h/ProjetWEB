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
    <link rel="stylesheet" href="page.css">
</head>
<body>
<div class="container_inscription">
    <div class="principal_form1">
        <div class="principal_form">
            <form action="controleur.php" method="post">
                <div class="form-wrapper">
                    <div class="form-container">
                        <h1 class="h1_form">Créer un compte</h1>
                        <div class="form-group">
                            <label for="username">Nom d'utilisateur</label>
                            <input type="text" id="username" name="pseudo" required>
                        </div>
                        <div class="form-group">
                            <label for="nom">Nom</label>
                            <input type="text" id="nom" name="nom" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Adresse mail</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="ville">Ville</label>
                            <input type="text" id="ville" name="ville" required>
                        </div>
                        <button type="submit" class="btn" name="action" value="CreateU">Créer un compte</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="sidebar">
        <div class="sidebar-item">
        <div class="form-group">
                            <label for="password">Mot de passe</label>
                            <input type="password" id="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Confirmer le mot de passe</label>
                            <input type="password" id="confirm_password" name="confirm_password" required>
                        </div>
        </div>
        <div class="sidebar-item">
        <div class="form-group">
                    <p class="p_form">Vous avez déjà un compte ? <a href="index.php?view=login">Connectez-vous ici</a></p>
                    </div>    
    </div>
    </div>
</div>
</body>
</html>
