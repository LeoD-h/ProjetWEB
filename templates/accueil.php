<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Récupération des données météorologiques</title>
    <link rel="stylesheet" type="text/css" href="style.css">

    <?php
    if (basename($_SERVER["PHP_SELF"]) != "index.php") {
        header("Location:../index.php?view=accueil");
        die("");
    }

    // Chargement eventuel des données en cookies
    $login = valider("login", "COOKIE");
    $passe = valider("passe", "COOKIE");
    if ($checked = valider("remember", "COOKIE"))
        $checked = "checked";

    // Initialiser la variable $city avec une valeur par défaut vide
    $city = '';

    // Vérifier si l'utilisateur est connecté et définir $city
    if (isset($_SESSION['idUser'])) {
        $city = ListeLocalisation($_SESSION['idUser']);
    }

    // Définir la date du jour au format texte
    $timezone = new DateTimeZone('Europe/Paris'); // Assurez-vous que le fuseau horaire est correct
    $dateDuJour = (new DateTime('now', $timezone))->format('l d F Y');

    ?>

</head>

<body>

    <div id="page_accueil_tutorial">
        <div id="banniere" class="banniere">
            <img src="ressources/test.JPEG" alt="paysage du site">
            <div class="banniere-content">
                <h1>Vous souhaitez de l'aide ?</h1>
                <div>
                    <h6>Demander à Valentin !</h6>
                    <button id="tutorial_button">Tutoriel de Valentin</button>
                </div>
            </div>
        </div>
        <div class="container_accueil">
            <div class="affiche_meteo" id="affiche_meteo">
                <?php
                // Utilisez la ville de l'entrée de l'utilisateur ou de la variable $city
                $cityToUse = isset($_GET['city']) ? $_GET['city'] : (isset($city) ? $city : null);

                if (!$cityToUse): ?>
                    <form id="form_meteo" method="get" action="">
                        <h1 class="titre_accueil">Choisissez une ville pour obtenir les données météorologiques :</h1>
                        <label for="city">Ville :</label>
                        <input type="text" id="city" name="city" required>
                        <button type="submit">Obtenir la météo</button>
                    </form>
                <?php endif; ?>

                <?php
                function kelvinToCelsius($tempKelvin)
                {
                    return round($tempKelvin - 273.15, 2);
                }

                if ($cityToUse) {
                    $api_key = '**********************';
                    $url = "http://api.openweathermap.org/data/2.5/forecast?q=$cityToUse&appid=$api_key";
                    $response = file_get_contents($url);
                    $data = json_decode($response, true);

                    if ($data && isset($data['list']) && count($data['list']) > 0) {
                        $todayForecast = [];
                        $now = new DateTime('now', new DateTimeZone('UTC')); // Assuming timezone is UTC
                        $today = $now->format('Y-m-d');

                        foreach ($data['list'] as $weather) {
                            $dateTime = new DateTime($weather['dt_txt']);
                            $date = $dateTime->format('Y-m-d');
                            $hour = $dateTime->format('H');

                            // Vérifier si la date et l'heure correspondent à aujourd'hui
                            if ($date == $today && $hour >= $now->format('H')) {
                                $todayForecast[] = [
                                    'heure' => $dateTime->format('H:i'),
                                    'température' => kelvinToCelsius($weather['main']['temp']),
                                    'humidité' => $weather['main']['humidity']
                                ];
                            }
                        }

                        // Stocker les prévisions météorologiques dans la session
                        session_start();
                        $_SESSION['todayForecast'] = $todayForecast;

                        // Ajouter une ligne de débogage pour vérifier le stockage dans la session
                        // echo "<pre>";
                        // print_r($_SESSION['todayForecast']);
                        // echo "</pre>";

                        echo "<h1 class='titre_accueil'>Prévisions météorologiques pour $cityToUse aujourd'hui :</h1>";
                        echo "<p>Aujourd'hui, nous sommes le " . $now->format('d-m-Y') . ".</p>";

                        if (count($todayForecast) > 0) {
                            echo "<table border='1'>";
                            echo "<tr><th>Heure</th><th>Température (°C)</th><th>Humidité (%)</th></tr>";
                            foreach ($todayForecast as $hourlyForecast) {
                                echo "<tr>";
                                echo "<td>{$hourlyForecast['heure']}</td>";
                                echo "<td>{$hourlyForecast['température']}</td>";
                                echo "<td>{$hourlyForecast['humidité']}</td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                        } else {
                            echo "<p>Aucune prévision disponible pour aujourd'hui à partir de maintenant.</p>";
                        }
                    } else {
                        echo "<p>Impossible de récupérer les prévisions météorologiques pour la ville $cityToUse.</p>";
                    }
                }


                ?>
            </div>


            <div class="affiche_tenue" id="affiche_tenue">
                <h1 class="titre_accueil">Tenue Du Jour :</h1>
                <img src="ressources/tenue.jpg" alt="tenue du jour">
            </div>
        </div>
    </div>
    </div>

    <div class="fleche_container_accueil">
        <div id="fleche_haut_1">
            <img src="ressources/fleche_haut.png" alt="flèche tuto">
            <p>Ici, vous accèdez à votre dressing</p>
        </div>
        <div id="fleche_haut_2">
            <img src="ressources/fleche_haut.png" alt="flèche tuto">
            <p>Ici, vous accèdez à vos diffèrentes tenues du jour</p>
        </div>
        <div id="fleche_haut_3">
            <img src="ressources/fleche_haut.png" alt="flèche tuto">
            <p>Ici, vous accèdez à votre feed</p>
        </div>
        <div id="fleche_haut_4">
            <img src="ressources/fleche_haut.png" alt="flèche tuto">
            <p>Ici, vous accèdez à vos messages</p>
        </div>
        <div id="fleche_haut_5">
            <img src="ressources/fleche_haut.png" alt="flèche tuto">
            <p>Ici, vous accèdez à la page "à propos" du site</p>
        </div>
        <div id="texte_1">
            <p>Dans cette section, vous avez la possibilité de visualiser la météo journalière de votre ville</p>
        </div>
        <div id="texte_2">
            <p>Vous pourrez retrouver ici la tenue du jour en fonction des prévisions météorologiques</p>
        </div>
        <div id="texte_3">
            <p>Vous pourrez retrouver ici la tenue du jour en fonction des prévisions météorologiques</p>
        </div>

        <script>
            // Déclaration des fonctions à utiliser
            function fonction1() {
                document.getElementById("page_accueil_tutorial").style.filter = "blur(5px)";
                console.log("Fonction 1 exécutée");
            }

            function fonction2() {
                document.getElementById("fleche_haut_1").style.display = "block";
                console.log("Fonction 2 exécutée");
            }

            function fonction3() {
                document.getElementById("fleche_haut_1").style.display = "none";
                document.getElementById("fleche_haut_2").style.display = "block";
                console.log("Fonction 3 exécutée");
            }

            function fonction4() {
                document.getElementById("fleche_haut_2").style.display = "none";
                document.getElementById("fleche_haut_3").style.display = "block";
                console.log("Fonction 4 exécutée");
            }

            function fonction5() {
                document.getElementById("fleche_haut_3").style.display = "none";
                document.getElementById("fleche_haut_4").style.display = "block";
                console.log("Fonction 5 exécutée");
            }

            function fonction6() {
                document.getElementById("fleche_haut_4").style.display = "none";
                document.getElementById("fleche_haut_5").style.display = "block";
                console.log("Fonction 6 exécutée");
            }

            function fonction7() {
                document.getElementById("fleche_haut_5").style.display = "none";
                document.getElementById("texte_1").style.display = "block";
                document.getElementById("page_accueil_tutorial").style.filter = "none";
                document.getElementById("header").style.filter = "blur(5px)";
                document.getElementById("footer").style.filter = "blur(5px)";
                document.getElementById("banniere").style.filter = "blur(5px)";
                document.getElementById("affiche_tenue").style.filter = "blur(5px)";
                console.log("Fonction 7 exécutée");
            }

            function fonction8() {
                document.getElementById("texte_1").style.display = "none";
                document.getElementById("texte_2").style.display = "block";
                document.getElementById("affiche_meteo").style.filter = "blur(5px)";
                document.getElementById("affiche_tenue").style.filter = "none";
                console.log("Fonction 7 exécutée");
            }

            function fonction9() {
                document.getElementById("texte_2").style.display = "none";
                document.getElementById("texte_3").style.display = "block";
                document.getElementById("affiche_tenue").style.filter = "blur(5px)";
                document.getElementById("banniere").style.visibility = "hidden";
                document.getElementById("texte_3").style.display = "block";
                console.log("Fonction 7 exécutée");
            }

            function fonction10() {
                document.getElementById("texte_3").style.display = "none";
                document.getElementById("affiche_meteo").style.filter = "none";
                document.getElementById("affiche_tenue").style.filter = "none";
                document.getElementById("header").style.filter = "none";
                document.getElementById("footer").style.filter = "none";
                document.getElementById("banniere").style.visibility = "visible";
                document.getElementById("banniere").style.filter = "none";
                console.log("Fonction 8 exécutée");
                window.location.reload();
            }
            // Tableau des fonctions
            const fonctions = [fonction1, fonction2, fonction3, fonction4, fonction5, fonction6, fonction7, fonction8, fonction9, fonction10];

            // Index pour suivre la fonction actuelle
            let indexFonctionActuelle = 0;

            // Fonction globale pour gérer les clics
            function gererClic(event) {
                // Appel de la fonction actuelle
                fonctions[indexFonctionActuelle]();

                // Mise à jour de l'index pour la prochaine fonction
                indexFonctionActuelle = (indexFonctionActuelle + 1) % fonctions.length;

                // Si le clic est supérieur ou égal au deuxième, enlever l'écouteur de clic de l'élément courant et l'ajouter à tout le document
                if (indexFonctionActuelle === 1) {
                    tutorial_button.removeEventListener('click', gererClic);
                    document.addEventListener('click', gererClic);
                }
            }

            // Sélection du bouton initial
            const tutorial_button = document.getElementById('tutorial_button');

            // Ajout de l'écouteur d'événement pour le clic sur le bouton initial
            tutorial_button.addEventListener('click', gererClic);

        </script>

</body>

</html>
