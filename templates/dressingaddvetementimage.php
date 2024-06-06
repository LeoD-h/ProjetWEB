<?php
include_once ("libs/modele.php");
include_once ("libs/maLibUtils.php"); // tprint
include_once ("libs/maLibForms.php");
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
        <title>Formulaire de création</title>
        <style>
            body {
                margin: 0;
                padding: 0;
                font-family: Arial, sans-serif;
                background-color: #ccc;



            }

            .container {
                display: flex;
                width: 100%;
                max-width: 100%;
                height: 90%;
                background-color: #dcdcdc;
                padding: 20px;
                box-sizing: border-box;
            }

            .form-section,
            .preview-section {
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
                height: 70%
            }

            .preview img {
                max-width: 100%;
            }

            .preview-text {
                margin-top: 10px;
            }

            .container {
                color: black;
                text-decoration: none;
                padding: 10px;
                border: dashed red;
                margin: 25px;
                background-color: #E2DEDE;
                height: 850px;

            }

            .imgd2 {
                position: relative;
                top: -40px;
            }

            .preview-text {
                position: relative;
                top: -120px;
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
                right: -560px;
                /* Ajuste cette valeur selon tes besoins */
                z-index: 10;
            }

            .preview:hover .infoHover {
                display: block;
                background-color: yellow;
            }

            /* .trigerinfoH:hover {
                    background-color: red;
                } */
            .term{
                border: 1px solid #000;
                height: 50px;
                width: 40px;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <div class="form-section">
                <h1>Upload an Image</h1>
                <form id="uploadForm" action="upload.php" method="post" enctype="multipart/form-data">
                    <input type="file" id="imageInput" name="image" accept="image/*" required>
                    <input type="hidden" id="hiddenInput" name="hiddenInput" value="">
                    <button type="submit" name="action">Upload</button>
                </form>
                <h2>Uploaded Image:</h2>
                <img id="uploadedImage" src="" alt="Uploaded Image will appear here" style="max-width: 80%;">
                <br>
                <br>
                <br>
                <a href="index.php?view=dressingaddvetement" class="creation">Creation</a>
                <script>
        document.getElementById('uploadForm').onsubmit = async function (event) {
            event.preventDefault();

            // Extraire l'ID du vêtement de l'URL
            const urlParams = new URLSearchParams(window.location.search);
            const idVetement = urlParams.get('idVetement');

            // Définir l'ID du vêtement dans l'input caché
            var hiddenInput = document.getElementById('hiddenInput');
            hiddenInput.value = idVetement;
            
            const formData = new FormData(document.getElementById('uploadForm'));
            formData.append('idVetement', idVetement); // Ajouter l'ID du vêtement aux données du formulaire
            
            try {
                const response = await fetch('upload.php', {
                    method: 'POST',
                    body: formData
                });

                const result = await response.json();
                if (response.ok && result.filePath) {
                    document.getElementById('uploadedImage').src = result.filePath;
                    console.log('Image uploaded:', result.filePath);
                    console.log('Hidden Input:', hiddenInput.value);
                } else {
                    alert(result.error || 'Image upload failed');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Image upload failed');
            }
        };
    </script>
                

            </div>
        </div>
    </body>

    </html>

    <?php
}

?>