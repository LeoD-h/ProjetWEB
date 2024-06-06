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
$email = ListeEmail($_SESSION['idUser']);
$city = ListeLocalisation($_SESSION['idUser']);
$prenom = ListePrenom($_SESSION['idUser']);
$pseudo = ListePseudo($_SESSION['idUser']);
// définit mkTable
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire Interactif</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="app-container">
        <div class="container-profil">
            <div class="sidebar">
                <div class="menu-item" onclick="toggleSection('pseudo')">Nom d'utilisateur</div>
                <div id="section-pseudo" class="section">
                <form action="controleur.php" method="post">
                    <h3>Nom d'utilisateur</h3>

                    <div>
                        <input type="text" id="showMessageButton" name="pseudo">
                        <button type="submit" name="action" value="Modpseudo">Modifier le pseudo</button>
                    </div>
                    </form>

                </div>
                <div class="menu-item" onclick="toggleSection('prenom')">Nom</div>
                <div id="section-prenom" class="section">
                <form action="controleur.php" method="post">
                    <h3>Nom</h3>
                    <div>
                        <input type="text" id="showMessageButton" name="nom">
                        <button type="submit" name="action" value="Modnom">Modifier le nom</button>
                    </div>
                    </form>

                </div>
                <div class="menu-item" onclick="toggleSection('email')">Adresse mail</div>
                <div id="section-email" class="section">
                <form action="controleur.php" method="post">
                    <h3>Adresse mail</h3>
                    <div>
                        <input type="mail" id="showMessageButton" name="email">
                        <button type="submit" name="action" value="Modemail">Modifier l'email</button>
                    </div>
                </form>
                </div>
                <div class="menu-item" onclick="toggleSection('loc')">Localisation</div>
                <div id="section-loc" class="section">
                <form action="controleur.php" method="post">
                    <h3>Localisation</h3>
                    <div>
                        <input type="text" id="showMessageButton" name="ville">
                        <button type="submit" name="action" value="Modville">Modifier la ville</button>
                    </div>
                    </form>
                    </div>
                <div class="menu-item" onclick="toggleSection('mdp')">Mot de passe</div>
                <div id="section-mdp" class="section">
                <form action="controleur.php" method="post">
                    <h3>Mot de passe</h3>
                    <div>
                        <input type="password" id="showMessageButton" name="mdp">
                        <button type="submit" name="action" value="Modpasse">Modifier le mot de passe</button>
                    </div>
                    </form>

                </div>
            </div>
            <div class="summary">
                <h3 class="carte_profil">Votre carte de membre</h3>
                <img class="drapeau_profil" src="ressources/drapeaufr.png" alt="drapeau">
                <div class="profile-card">
                <?php
                    echo '<div class="profile-picture"><span class="profile-letter">'. substr($pseudo, 0, 1) .'</span></div>';
                ?>
                    <div class="profile-info">
                    <?php
                        echo '<h4 id="profile-name">Pseudo : '. $pseudo . '</h4>';

                        echo '<h4 class="profile-name">Nom : '. $prenom .'</h4>';
                        
                        echo '<h4 class="profile-name">Adresse mail : '. $email .'</h4>';

                        echo '<h4 class="profile-name">Ville : '. $city .'</h4>';

                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>

        function toggleSection(sectionId) {
            const sections = document.querySelectorAll('.section');
            sections.forEach(section => {
                if (section.id === 'section-' + sectionId) {
                    section.style.display = section.style.display === 'block' ? 'none' : 'block';
                } else {
                    section.style.display = 'none';
                }
            });
        }

        function updateSummary() {
            const showMessageButton = document.getElementById('showMessageButton').checked;
            const messageButtonText = document.getElementById('messageButtonText').value;

            const messageButton = document.getElementById('message-button');
            if (showMessageButton) {
                messageButton.style.display = 'block';
                messageButton.textContent = messageButtonText || 'Message';
            } else {
                messageButton.style.display = 'none';
            }

            const mainInput = document.getElementById('main-input');
            if (showMessageButton) {
                mainInput.style.display = 'block';
            } else {
                mainInput.style.display = 'none';
            }
        }

    </script>

</body>
</html>
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
$email = ListeEmail($_SESSION['idUser']);
$city = ListeLocalisation($_SESSION['idUser']);
$prenom = ListePrenom($_SESSION['idUser']);
$pseudo = ListePseudo($_SESSION['idUser']);
// définit mkTable
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire Interactif</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="app-container">
        <div class="container-profil">
            <div class="sidebar">
                <div class="menu-item" onclick="toggleSection('pseudo')">Nom d'utilisateur</div>
                <div id="section-pseudo" class="section">
                <form action="controleur.php" method="post">
                    <h3>Nom d'utilisateur</h3>

                    <div>
                        <input type="text" id="showMessageButton" name="pseudo">
                        <button type="submit" name="action" value="Modpseudo">Modifier le pseudo</button>
                    </div>
                    </form>

                </div>
                <div class="menu-item" onclick="toggleSection('prenom')">Nom</div>
                <div id="section-prenom" class="section">
                <form action="controleur.php" method="post">
                    <h3>Nom</h3>
                    <div>
                        <input type="text" id="showMessageButton" name="nom">
                        <button type="submit" name="action" value="Modnom">Modifier le nom</button>
                    </div>
                    </form>

                </div>
                <div class="menu-item" onclick="toggleSection('email')">Adresse mail</div>
                <div id="section-email" class="section">
                <form action="controleur.php" method="post">
                    <h3>Adresse mail</h3>
                    <div>
                        <input type="mail" id="showMessageButton" name="email">
                        <button type="submit" name="action" value="Modemail">Modifier l'email</button>
                    </div>
                </form>
                </div>
                <div class="menu-item" onclick="toggleSection('loc')">Localisation</div>
                <div id="section-loc" class="section">
                <form action="controleur.php" method="post">
                    <h3>Localisation</h3>
                    <div>
                        <input type="text" id="showMessageButton" name="ville">
                        <button type="submit" name="action" value="Modville">Modifier la ville</button>
                    </div>
                    </form>
                    </div>
                <div class="menu-item" onclick="toggleSection('mdp')">Mot de passe</div>
                <div id="section-mdp" class="section">
                <form action="controleur.php" method="post">
                    <h3>Mot de passe</h3>
                    <div>
                        <input type="password" id="showMessageButton" name="mdp">
                        <button type="submit" name="action" value="Modpasse">Modifier le mot de passe</button>
                    </div>
                    </form>

                </div>
            </div>
            <div class="summary">
                <h3 class="carte_profil">Votre carte de membre</h3>
                <img class="drapeau_profil" src="ressources/drapeaufr.png" alt="drapeau">
                <div class="profile-card">
                <?php
                    echo '<div class="profile-picture"><span class="profile-letter">'. substr($pseudo, 0, 1) .'</span></div>';
                ?>
                    <div class="profile-info">
                    <?php
                        echo '<h4 id="profile-name">Pseudo : '. $pseudo . '</h4>';

                        echo '<h4 class="profile-name">Nom : '. $prenom .'</h4>';
                        
                        echo '<h4 class="profile-name">Adresse mail : '. $email .'</h4>';

                        echo '<h4 class="profile-name">Ville : '. $city .'</h4>';

                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>

        function toggleSection(sectionId) {
            const sections = document.querySelectorAll('.section');
            sections.forEach(section => {
                if (section.id === 'section-' + sectionId) {
                    section.style.display = section.style.display === 'block' ? 'none' : 'block';
                } else {
                    section.style.display = 'none';
                }
            });
        }

        function updateSummary() {
            const showMessageButton = document.getElementById('showMessageButton').checked;
            const messageButtonText = document.getElementById('messageButtonText').value;

            const messageButton = document.getElementById('message-button');
            if (showMessageButton) {
                messageButton.style.display = 'block';
                messageButton.textContent = messageButtonText || 'Message';
            } else {
                messageButton.style.display = 'none';
            }

            const mainInput = document.getElementById('main-input');
            if (showMessageButton) {
                mainInput.style.display = 'block';
            } else {
                mainInput.style.display = 'none';
            }
        }

    </script>

</body>
</html>
