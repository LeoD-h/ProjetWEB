<?php

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

            .navbar {
                display: flex;
                justify-content: space-between;
                align-items: center;
                /* background-color: #0000ff; */
                padding: 10px;
            }

            .navbar .left,
            .navbar .right {
                display: flex;
                align-items: center;
            }

            .navbar a {

                text-decoration: none;
                padding: 0px 20px;
                margin: 0 5px;
                margin-top: -5px;
                font-size: 150%;
            }

            .favorite {
                text-decoration: none;
                padding: 0px 20px;
                margin: 0 5px;
                margin-top: -5px;
                font-size: 120%;
            }

            .content {
                display: flex;
                flex-wrap: wrap;
                justify-content: space-around;
                padding: 20px;
            }

            .box {
                background-color: yellow;
               
            }

            .box p, .box1 p, .box2 p, .box3 p, .box4 p, .box5 p{
                margin: 2px 0;
                font-size: px;
            }
            .box, .box1, .box2, .box3, .box4, .box5 {
                width: 170px;
                height: 280px;
                margin: 15px;
                padding: 10px;
                box-sizing: border-box;
                text-align: center;
            }
            .box:hover, .box1:hover, .box2:hover, .box3:hover, .box4:hover, .box5:hover {
                background-color: red;
            }
            .box1 {
                background-color: green;
            }

            .box2 {
                background-color: blue;
            }

            .box3 {
                background-color: pink;
            }

            .box4 {
                background-color: orange;
            }

            .box5 {
                background-color: brown;
            }


            .star,
            .close {
                font-size: 30px;
            }

            .star {

                margin-right: 10px;
            }

            .close {
                color: black;
                text-decoration: none;
                margin-left: 10px;
            }

            a.home {
                background-color: #EC5656;

            }

            a.creation {
                background-color: #00ff00;

            }

            a.lvetement {

                background-color: #00ff00;
            }

            .dress {
                color: black;
                text-decoration: none;
                padding: 10px;
                border: dashed red;
                margin: 25px;
                background-color: #E2DEDE;
                height: auto;
            }

            
        </style>
    </head>

    <body>
        <div class="fakebody">
            <div class="dress">
                <div class="navbar">
                    <div class="left">
                        <a href="#" class="home">Home</a>
                        <a href="index.php?view=dressingcreate" class="creation">Creation</a>
                        <a href="index.php?view=dressinglvetement" class="lvetement">Liste vetements</a>
                    </div>
                    <div class="right">
                        

                        <a href="index.php?view=dressingaddvetement" class="close">X</a>
                    </div>
                </div>
                <div class="content">
                    <?php
                    $idUser = $_SESSION["idUser"];
                    $vetements = lvetement($idUser);
                    foreach ($vetements as $vetement) {
                        // Récupère la partie du corps associée à chaque vêtement
                        $partiecorps = $vetement['Zoner'];

                        // Initialise une variable pour la classe CSS de la boîte
                        $boxClass = '';

                        // Détermine la classe CSS en fonction de la partie du corps
                        switch ($partiecorps) {
                            case 'tete':
                                $boxClass = 'box';
                                break;
                            case 'torse':
                                $boxClass = 'box1';
                                break;
                            case 'jambe':
                                $boxClass = 'box2';
                                break;
                            case 'chaussette':
                                $boxClass = 'box3';
                                break;
                            case 'chaussure':
                                $boxClass = 'box4';
                                break;
                            default:
                                // En cas de partie du corps inconnue, utilise une classe par défaut
                                $boxClass = 'box5';
                        }

                        // Affiche la boîte avec la classe CSS déterminée
                        echo "<div class='$boxClass'>";
                        echo '<img style="max-width: 135px; max-height: 180px;" src="uploads/' . $vetement['VetementID'] . '.png" alt="Image">';
                        echo "<p>Nom : {$vetement['pseudo']}</p>";
                        echo "<p>Type : {$vetement['Type_de_vetement']}</p>";
                        echo "<p>Couleur : {$vetement['Couleur']}</p>";
                        echo "<p>Marque : {$vetement['Marque']}</p>";
                        echo "<p>Prix : {$vetement['Prix']}$</p>";
                        
                       
                        echo "</div>";
                    }
                    ?>


                </div>
            </div>
        </div>
    </body>

    </html>
    <?php
}
?>