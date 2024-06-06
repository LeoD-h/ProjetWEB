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

            a.home {
                background-color: #00ff00;

            }

            a.creation {
                background-color: #00ff00;

            }

            a.lvetement {

                background-color: #EC5656;
            }

            .box {
                max-width: 200px;
                min-width: 100px;
                max-height: 150px;
                background-color: #ffcccc;
                margin: 10px;
                position: relative !important;
                text-align: center;
            }

            .star,
            .close {
                font-size: 30px;
            }

            .star {
                color: red;
                margin-right: 10px;
            }

            .close {
                color: black;
                text-decoration: none;
                /* Désactive le soulignement */
                margin-left: 10px;
            }

            .main-content {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 20px;
            }

            .creation-content {
                flex-grow: 1;
                display: grid;
                height: 610px;
                margin-left: 10px;
                width: 300px;
                border-top: solid;
                border-right: solid;
                border-left: solid;
            }

            .dress {
                color: black;
                text-decoration: none;
                padding: 10px;
                border: dashed red;
                margin: 25px;
                background-color: #E2DEDE;
                height: 700px;
            }

            .b1,
            .b2,
            .b3,
            .b4,
            .b5 {

                /* border:solid; */
                border-bottom: solid;
                /* background:blue; */
                width: 100%;
                height: 70%;
                display: flex;
                overflow-x: auto;

            }

            .container-b1, .container-b2, .container-b3, .container-b4, .container-b5{
                text-align: center;
                overflow-x: auto;
                margin: 0;
            }

            .titre-dressing-vetement{
                display: block;
                margin: 0;
            }

            
        </style>
    </head>

    <body>
        <div class="dress">
            <div class="navbar">
                <div class="left">
                    <a href="index.php?view=dressing" class="home">Home</a>
                    <a href="index.php?view=dressingcreate" class="creation">Creation</a>
                    <a href="#" class="lvetement">Liste vetements</a>
                </div>
                <div class="right">
                    

                    <a href="index.php?view=dressingaddvetement" class="close">X</a>
                </div>
            </div>
            <?php

            $idUser = $_SESSION["idUser"];
            ?>
            <div class="main-content">
                <div class="creation-content">
                    <div class="container-b1">
                        <h3 class="titre-dressing-vetement">Tête</h3>
                    <div class="b1">
                        <?php
                        $vetements = lvetement($idUser);
                        foreach ($vetements as $vetement) {
                            $partiecorps = $vetement['Zoner'];
                            $boxClass = '';
                            switch ($partiecorps) {
                                case 'tete':
                                    $boxClass = 'box';
                                    echo "<div class='$boxClass'>";
                                    echo "<p>Nom : {$vetement['pseudo']}</p>";
                                    echo '<img style="max-width: 70px; max-height: 70px;" src="uploads/' . $vetement['VetementID'] . '.png" alt="Image">';
                                    echo "</div>";
                                    break;
                                default:
                                    $boxClass = 'box5';
                            }
                        }
                        ?>
                    </div>
                </div>
                <div class="container-b2">
                        <h3 class="titre-dressing-vetement">Haut</h3>
                    <div class="b2">
                        <?php
                        $vetements = lvetement($idUser);
                        foreach ($vetements as $vetement) {
                            $partiecorps = $vetement['Zoner'];
                            $boxClass = '';
                            switch ($partiecorps) {
                                case 'torse':
                                    $boxClass = 'box';
                                    echo "<div class='$boxClass'>";
                                    echo "<p>Nom : {$vetement['pseudo']}</p>";
                                    echo '<img style="max-width: 70px; max-height: 70px;" src="uploads/' . $vetement['VetementID'] . '.png" alt="Image">';
                                    echo "</div>";
                                    break;
                            }
                        }
                        ?>
                    </div>
                </div>
                <div class="container-b3">
                        <h3 class="titre-dressing-vetement">Bas</h3>
                    <div class="b3">
                        <?php
                        $vetements = lvetement($idUser);
                        foreach ($vetements as $vetement) {
                            $partiecorps = $vetement['Zoner'];
                            $boxClass = '';
                            switch ($partiecorps) {
                                case 'jambe':
                                    $boxClass = 'box';
                                    echo "<div class='$boxClass'>";
                                    echo "<p>Nom : {$vetement['pseudo']}</p>";
                                    echo '<img style="max-width: 70px; max-height: 70px;" src="uploads/' . $vetement['VetementID'] . '.png" alt="Image">';
                                    echo "</div>";
                                    break;
                            }
                        }
                        ?>
                    </div>
                </div>
                <div class="container-b4">
                        <h3 class="titre-dressing-vetement">Chaussettes</h3>
                    <div class="b4">
                        <?php
                        $vetements = lvetement($idUser);
                        foreach ($vetements as $vetement) {
                            $partiecorps = $vetement['Zoner'];
                            $boxClass = '';
                            switch ($partiecorps) {
                                case 'chaussette':
                                    $boxClass = 'box';
                                    echo "<div class='$boxClass'>";
                                    echo "<p>Nom : {$vetement['pseudo']}</p>";
                                    echo '<img style="max-width: 70px; max-height: 70px;" src="uploads/' . $vetement['VetementID'] . '.png" alt="Image">';
                                    echo "</div>";
                                    break;
                            }
                        }
                        ?>
                    </div>
                </div>
                <div class="container-b5">
                        <h3 class="titre-dressing-vetement">Chaussures</h3>
                    <div class="b5">
                        <?php
                        $vetements = lvetement($idUser);
                        foreach ($vetements as $vetement) {
                            $partiecorps = $vetement['Zoner'];
                            $boxClass = '';
                            switch ($partiecorps) {
                                case 'chaussure':
                                    $boxClass = 'box';
                                    echo "<div class='$boxClass'>";
                                    echo "<p>Nom : {$vetement['pseudo']}</p>";
                                    echo '<img style="max-width: 70px; max-height: 70px;" src="uploads/' . $vetement['VetementID'] . '.png" alt="Image">';
                                    echo "</div>";
                                    break;
                            }
                        }
                        ?>
                    </div>
                </div>
                </div>
            </div>

        </div>
    </body>

    </html>
    <?php
}
?>