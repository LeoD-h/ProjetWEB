<?php
include_once ("libs/modele.php");
include_once ("libs/maLibUtils.php"); // tprint
include_once ("libs/maLibForms.php");
$vetements = $_SESSION['vetements'];
$vetementsoiree = $_SESSION['vetementssoiree'];
$vetementsport = $_SESSION['vetementssport'];
// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php") {
    header("Location:../index.php?view=login");
    die("");
}
if (!valider("connecte", "SESSION")) {

    include ("templates/login.php");

} else {

    ?>

    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <title>Votre Page</title>
        <!-- <link rel="stylesheet" type="text/css" href="style.css"> -->
        <link rel="icon" type="image/png" href="/path/to/your/favicon.png">
        <style>
            body {
                margin: 0;
                padding: 0;
                font-family: Arial, sans-serif;
                background-color: #ccc;
            }

            .slider {
                display: flex;
                overflow: hidden;
                /* width: 80%; */
                height: 90%;
                top: -80%;
                max-width: 450px;
                min-width: 400px;
                float: right;
                text-align: center;
                position: relative;
            }

            .slider-container {
                display: flex;
                transition: transform 0.5s ease-in-out;
            }

            .slider div {
                min-width: 100%;
                box-sizing: border-box;
            }

            .slider div:nth-child(odd) {
                background-color: #3498db;
                color: white;
            }

            .slider div:nth-child(even) {
                background-color: #2ecc71;
                color: white;
            }

            .arrow {
                position: absolute;
                top: 50%;
                transform: translateY(-50%);
                background-color: rgba(0, 0, 0, 0.5);
                color: white;
                border: none;
                padding: 10px;
                cursor: pointer;
                z-index: 10;
                /* Ensure the arrows are always on top */
            }

            .arrow-left {
                left: 10px;
            }

            .arrow-right {
                right: 10px;
            }

            .main {
                padding: 20px;
                margin: 10px;
                border: solid red;
                height: 800px;
            }

            .imge {
                width: auto%;
                /* Ajustez la largeur selon vos besoins */
                height: 18%;
                /* Utilisez "auto" pour conserver les proportions de l'image */
                display: block;
                /* Pour que les images soient des blocs et puissent être centrées */
                margin: 0 auto;
                /* Centre l'image horizontalement */
            }

            .tee {
                text-align: center;
                /* Centre le contenu de la div */
            }

            .gauche-div-tenues,
            .gauche-div-tenues p,
            .gauche-div-tenues h1,
            .gauche-div-tenues form {
                display: inline;
            }

            .small-chart {
                width: 100% !important;
                height: 100% !important;
            }

            .bordercanvas {
                border: 1px solid black;
                padding: 10px;
                width: 70%%;
                height: 63%;
            }

            .borderdecanvas {
                border: 1px solid black;
                padding: 10px;
                width: 45%;
                margin-left: 3%;
                height: 60%;
                display: flex;
                flex-direction: column;
                background-color: #fdf1b8;
            }

            .info {
                flex: 1;
                height: 30%;
                border: 1px solid black;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 10px;
                box-sizing: border-box;
            }

            .emoji {
                width: 20%;
                border: 1px solid black;
                height: 100%;
                display: flex;
                align-items: right;
                justify-content: right;
                box-sizing: border-box;
                right: -15%;
                position: relative;
            }

            .textinfo {
                font-size: 20px;
                font-weight: bold;
                text-align: center;
            }

            .texteinfo {
                font-size: 20px;
                font-weight: bold;
                text-align: center;
            }
        </style>
    </head>

    <body>
        <div class="main">
            <div class="gauche-div-tenues">
                <?php

                if (isset($_SESSION['todayForecast']) && count($_SESSION['todayForecast']) > 0) {
                    // if (1 == 1) {
                    $todayForecast = $_SESSION['todayForecast'];
                    $recentForecast = $todayForecast[0]; // Get the most recent forecast
                    $temperature = $recentForecast['température'];
                    $humidite = $recentForecast['humidité'];
                    // $temperature = 5;
                    // $_POST['temperature_range'] = $temperature;
                    echo "<h1>Prévision météorologique récente :</h1>";
                    echo "<br>";
                    // Définir le message en fonction de la température
                    if ($temperature > 27) {
                        $message = "Il fait très chaud";
                        $range = "0";
                    } elseif ($temperature > 24 && $temperature <= 27) {
                        $message = "Il fait chaud";
                        $range = "1";
                    } elseif ($temperature > 21 && $temperature <= 24) {
                        $message = "Il fait agréablement chaud";
                        $range = "2";
                    } elseif ($temperature > 18 && $temperature <= 21) {
                        $message = "Il fait doux";
                        $range = "3";
                    } elseif ($temperature > 15 && $temperature <= 18) {
                        $message = "Il fait moyen";
                        $range = "4";
                    } elseif ($temperature > 12 && $temperature <= 15) {
                        $message = "Il fait un peu frais";
                        $range = "5";
                    } elseif ($temperature > 9 && $temperature <= 12) {
                        $message = "Il fait frais";
                        $range = "6";
                    } elseif ($temperature > 6 && $temperature <= 9) {
                        $message = "Il fait assez froid";
                        $range = "7";
                    } elseif ($temperature > 3 && $temperature <= 6) {
                        $message = "Il fait froid";
                        $range = "8";
                    } elseif ($temperature >= -10 && $temperature <= 3) {
                        $message = "Il fait très froid";
                        $range = "9";
                    }
                    echo "<p>{$message}</p>";
                    echo "<br>";
                    echo "<p>Température récente: {$temperature}°C</p>";
                    echo "<br>";
                    echo "<form id='autoSubmitForm' action='controleur.php' method='post'>";
                    echo "<input type='hidden' name='temperature_range' value='{$range}'>";
                    echo "<input type='hidden' name='submitted_range' id='submitted_range' value='{$range}'>"; // Champ caché pour stocker la plage soumise
                    echo "<br>";
                    echo "<input type='submit' name='action' value='Actualiser'>"; // Champ caché pour l'action
                    echo "</form>";
                    echo "<br>";
                    echo "<br>";
                    echo "<br>";
                    echo "<br>";




                    // echo "<table border='1'>";
                    // echo "<tr><th>Heure</th><th>Température (°C)</th><th>Humidité (%)</th></tr>";
                    // foreach ($todayForecast as $hourlyForecast) {
                    //     echo "<tr>";
                    //     echo "<td>{$hourlyForecast['heure']}</td>";
                    //     echo "<td>{$hourlyForecast['température']}</td>";
                    //     echo "<td>{$hourlyForecast['humidité']}</td>";
                    //     echo "</tr>";
                    // }
                    // echo "</table>";
                    // Convert PHP array to JSON
                    // Convert PHP array to JSON
                    $hours = array_column($todayForecast, 'heure');
                    $temperatures = array_column($todayForecast, 'température');
                    ?>
                    <div class="borderdecanvas">
                        <div class="info">
                            <div class="texteinfo">


                                <p class="textinfo">Température récente: <?php echo $temperature; ?>°C</p>
                                <br>
                                <p class="texteinfo">Humidité récente: <?php echo $humidite; ?>%</p>
                            </div>
                            <div class="emoji">
                                <?php
                                if ($temperature < 10 && $humidite < 60) {
                                    echo "<img src='ressources/pluie.png' alt='Nuageux'>";
                                } elseif ($temperature >10 && $humidite <60) {
                                    echo "<img src='ressources/soleil.png' alt='Soleil'>";
                                } elseif ($temperature > 10 && ($humidite < 100 || $humidite > 70)) {
                                    echo "<img src='ressources/pluie.png' alt='Pluie'>";
                                } else {
                                    echo "<img src='ressources/nuage.jpeg' alt='Orage'>";
                                }
                                ?>

                            </div>
                        </div>
                        <div class="bordercanvas">
                            <canvas id="temperatureChart" class="small-chart"></canvas>
                        </div>
                    </div>
                    <script>
                        // Get data from PHP
                        const hours = <?php echo json_encode($hours); ?>;
                        const temperatures = <?php echo json_encode($temperatures); ?>;

                        // Create Chart.js chart
                        const ctx = document.getElementById('temperatureChart').getContext('2d');
                        const temperatureChart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: hours,
                                datasets: [{
                                    label: 'Température (°C)',
                                    data: temperatures,
                                    borderColor: 'rgba(75, 192, 192, 1)',
                                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: false, // Ensure the chart size is fixed
                                scales: {
                                    x: {
                                        title: {
                                            display: true,
                                            text: 'Heure'
                                        }
                                    },
                                    y: {
                                        title: {
                                            display: true,
                                            text: 'Température (°C)'
                                        }
                                    }
                                }
                            }
                        });
                    </script>

                </div>
                <div class="slider">
                    <button class="arrow arrow-left" onclick="moveSlide(-1)">&#9664;</button>
                    <div class="slider-container" id="slider-container">
                        <!-- Slide pour les vêtements -->
                        <div class="tee">
                            <?php
                            foreach ($vetements as $vetement) {
                                $vetementID = $vetement['VetementID'];
                                $imagePath = "uploads/{$vetementID}.png";
                                echo "<img src='{$imagePath}' alt='Vetement Image' class='imge'>";
                            }
                            if (isset($temperature)) {
                                echo "<p>Tenue pour une météo de : $temperature °degres</p>";
                            }
                            ?>
                        </div>
                        <!-- Slide pour les vêtements de soirée -->
                        <div class="tee">
                            <?php

                            foreach ($vetementsoiree as $vetement) {
                                $vetementID = $vetement['VetementID'];
                                $imagePath = "uploads/{$vetementID}.png";
                                echo "<img src='{$imagePath}' alt='Vetement Soiree Image' class='imge'>";
                            }
                            if (isset($temperature)) {
                                echo "<p>Tenue pour une météo de sport à : $temperature °degres</p>";
                            }
                            ?>
                        </div>
                        <!-- Slide pour les vêtements de sport -->
                        <div class="tee">
                            <?php

                            foreach ($vetementsport as $vetement) {
                                $vetementID = $vetement['VetementID'];
                                $imagePath = "uploads/{$vetementID}.png";
                                echo "<img src='{$imagePath}' alt='Vetement Soiree Image' class='imge'>";
                            }
                            if (isset($temperature)) {
                                echo "<p>Tenue pour une météo de sport à : $temperature °degres</p>";
                            }
                            ?>
                        </div>
                    </div>
                    <button class="arrow arrow-right" onclick="moveSlide(1)">&#9654;</button>
                </div>

            </div>
            <script type='text/javascript'>
                let currentSlide = 0;

                function moveSlide(direction) {
                    const sliderContainer = document.getElementById('slider-container');
                    const totalSlides = sliderContainer.children.length;

                    currentSlide += direction;

                    if (currentSlide < 0) {
                        currentSlide = totalSlides - 1;
                    } else if (currentSlide >= totalSlides) {
                        currentSlide = 0;
                    }

                    const offset = -currentSlide * 100;
                    sliderContainer.style.transform = `translateX(${offset}%)`;
                }

                document.addEventListener('DOMContentLoaded', function () {
                    console.log('DOM fully loaded and parsed');

                    var form = document.getElementById('autoSubmitForm');
                    var formData = new FormData(form);
                    var actionUrl = form.getAttribute('action'); // Utilisez getAttribute pour obtenir l'URL de l'action

                    console.log('Température récente:', document.getElementById('submitted_range').value);
                    console.log('Formulaire action:', actionUrl);
                    console.log('Formulaire data:', formData);

                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', actionUrl, true); // Utilisez actionUrl ici
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState == 4 && xhr.status == 200) {
                            console.log('Formulaire soumis avec succès.');
                            // console.log('Réponse du serveur: ' + xhr.responseText);
                        }
                    };
                    console.log('Envoi du formulaire...');
                    xhr.send(formData);
                });

                function reloadPage() {
                    location.reload();
                }
                setInterval(reloadPage, 3600000);
            </script>
            <?php
                } else {
                    echo "<p>Aucune donnée de température disponible.</p>";
                }
                ?>

    </body>

    </html>
    <?php
}
?>