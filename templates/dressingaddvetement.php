<?php
include_once("libs/modele.php");
include_once("libs/maLibUtils.php"); // tprint
include_once("libs/maLibForms.php");
// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
	header("Location:../index.php?view=login");
	die("");
}
if(!valider("connecte","SESSION")){

    include("templates/login.php");

}else
{

    ?>

    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Formulaire de création</title>
        <style>
            body {
                margin: 0;
                    padding: 0;
                    font-family: Arial, sans-serif;
                    background-color: #ccc;



            }
            .containerr {
                display: flex;
                width: 100%;
                max-width: 100%;
                /* height: 95%; */
                background-color: #dcdcdc;
                padding: 20px;
                box-sizing: border-box;
            }
            .form-section, .preview-section {
                flex: 1;
                padding: 20px;
                box-sizing: border-box;
            }
            .form-section {
                border-right: 1px solid #ccc;
            }
            .form-group {
                margin-bottom: 15px;
            }
            .form-group label {
                display: block;
                margin-bottom: 5px;
            }
            .form-group input,
            .form-group select,
            .form-group textarea {
                width: 100%;
                padding: 5px;
                border: 1px solid #ccc;
                border-radius: 5px;
                background-color: #90ee90;
                box-sizing: border-box;
            }
            .form-group input[type="range"] {
                width: 100%;
            }
            .buttons {
                display: flex;
                justify-content: space-between;
                margin-top: 20px;
            }
            .buttons button {
                padding: 10px 20px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
            }
            .buttons .add {
                background-color: #4CAF50;
                color: white;
            }
            .buttons .preview-button {
                background-color: #008CBA;
                color: white;
            }
            .preview-section {
                display: flex;
                flex-direction: column;
                align-items: center;
            }
            .preview {
                width: 70%;
                /* max-width: 300px; */
                background-color: #f5f5f5;
                padding: 20px;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                text-align: center;
                height:70%
            }
            .preview img {
                max-width: 100%;
            }
            .preview-text {
                margin-top: 10px;
            }
            .containerr{
                color: black;
                text-decoration: none;
                padding:10px;
                border: dashed red;
                margin:25px;
                background-color:#E2DEDE;
                height:auto;
                width:100%;

            }
            .imgd2{
                position: relative;
                top:-40px;
            }
            .preview-text {
                position: relative;
                top:-120px;
            }
                    .trigerinfoH {
            display: inline-block;
            padding: 10px;
            border: 1px solid #000;
            cursor: pointer;
            position: relative;
        }

        .infoHover {
            display: none;
            position: relative;
            border: solid;
            background-color: #f5f5f5;
            height: 200px;
            width: 150px;
            right: -560px; /* Ajuste cette valeur selon tes besoins */
            z-index: 10;
        }

        .preview:hover .infoHover {
            display:block     ;
            background-color: yellow;
        }

        /* .trigerinfoH:hover {
            background-color: red;
        } */

        </style>
    </head>
    <body>
        <div class="containerr">
            <div class="form-section">
            <form action="controleur.php" method="GET">
                <h2>Création</h2>
                <div class="form-group">
                    <label for="nom">Nom :</label>
                    <input type="text" name="nom" id="nom">
                </div>
                <div class="form-group">
                    <label for="type">Type :</label>
                    <input name="type" type="text" id="type">
                </div>
                <div class="form-group">
                    <label for="couleur">Couleur :</label>
                    <input name="couleur"  type="text" id="couleur">
                </div>
                <div class="form-group">
                    <label for="marque">Marque :</label>
                    <input name="marque"  type="text" id="marque">
                </div>
                <div class="form-group">
                    <label for="prix">Prix :</label>
                    <input name="prix"  type="text" id="prix">
                </div>
                <div class="form-group">
                    <label for="moment">Moment :</label>
                    <input name="moment"  type="range" id="moment" min="1" max="10" value="4">
                </div>
                <div class="form-group">
                    <label for="saison">Saison :</label>
                    <input name="saison"  type="range" id="saison" min="1" max="10" value="10">
                </div>
                <div class="form-group">
                    <label for="chaud">Chaud :</label>
                    <input name="chaud"  type="range" id="chaud" min="1" max="10" value="10">
                </div>
                <div class="form-group">
                 <label for="partie-corps">Corps (Tête, Torse, Jambe, Chaussette, Chaussure) :</label>
                <select id="partie-corps" name="partiecorps">
                    <option value="tete">Tête</option>
                    <option value="torse">Torse</option>
                    <option value="jambe">Jambe</option>
                    <option value="chaussette">Chaussette</option>
                    <option value="chaussure">Chaussure</option>
                </select>
                </div>


                <div class="buttons">
                    <!-- <button class="preview-button" onclick="window.location.href='index.php?view=dressingcreate'">Ajouter l'image</button> -->

                    
                    <button type="submit" name="action" value="submit1" class="add">Ajouter</button>
                    <!-- <input type="submit" name="submit1" value="Send Request" /> -->
            </form>
                </div>
            </div>
            <div class="preview-section">
                <h2>Aperçu :</h2>
                <div class="preview">
                    <img class="imgd2" style="width:65%" src="ressources/IMG-V/nike-black.jpeg" alt="Aperçu">
                    <div class="preview-text">
                        <p>

                        Pull Nike - 90 $</p>
                        <p style="float:left">Ajouté le 12.03.24</p>
                        <p class="trigerinfoH" style="float:right">©IDMSCA.R</p>
                            <div class="infoHover">
                                <p >Saison : Ete</p>
                                <p >Moment : Soirée </p>
                                <p>Chaud : 3/10</p>
                                <p >Autre : 6/10</p>

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