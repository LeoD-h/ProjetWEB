
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
if ($checked = valider("remember", "COOKIE")) $checked = "checked"; 

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
    <div id ="banniere"class="banniere">
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
                function kelvinToCelsius($tempKelvin) {
                    return round($tempKelvin - 273.15, 2);
                }

                if ($cityToUse) {
                    $api_key = '0cf20a38d3af2a88183047f01385ff8f';
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
<div id="log_page">

	<h1>Connexion</h1>



 <form role="form" action="controleur.php">
  <div >
    <label for="email">Login</label>
    <input type="text" id="email" name="login" value="<?php echo $login;?>" >
  </div>
  <div >
    <label for="pwd">Passe</label>
    <input type="password"  id="pwd" name="passe" value="<?php echo $passe;?>">
  </div>
  <br>
  <button type="submit" name="action" value="Connexion" >Connexion</button>
</form>
<p>---------------------------------------------------------------------</p>
<br>
<h4>Vous ne faites pas encore parti de notre communauté ?</h4>
<?php
echo mkHeadLink("Inscrivez vous !","inscription",$view);
?>

</div>


