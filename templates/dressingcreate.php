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
            background-color: #EC5656;
        }

        a.lvetement {
            background-color: #00ff00;
        }

        .content {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            padding: 10px;
        }

        .box {
            width: 150px;
            height: 200px;
            background-color: yellow;
            margin: 15px;
        }

        .box1 {
            width: 150px;
            height: 200px;
            background-color: green;
            margin: 15px;
        }

        .box2 {
            width: 150px;
            height: 200px;
            background-color: blue;
            margin: 15px;
        }

        .box3 {
            width: 150px;
            height: 200px;
            background-color: pink;
            margin: 15px;
        }

        .box4 {
            width: 150px;
            height: 200px;
            background-color: orange;
            margin: 15px;
        }

        .box5 {
            width: 150px;
            height: 200px;
            background-color: brown;
            margin: 15px;
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
            margin-left: 10px;
        }

        .main-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
        }

        .sidebar {
            background-color: #56ECDA;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            border: solid;
            height: 500px;
            width: 250px;
        }

        .creation-content {
            flex-grow: 1;
            height: 500px;
            margin-left: 10px;
            width: 300px;
            border: solid;
        }

        .dress {
            color: black;
            text-decoration: none;
            padding: 10px;
            border: dashed red;
            margin: 25px;
            background-color: #E2DEDE;
            height: 600px;
        }

        .body1 {
            border: solid;
            height: 50%;
            width: 90%;
            margin: 5px;
            margin-left: 10px;
            background-color: #DD9FE2;
        }

        .body2 {
            border: solid;
            height: 100%;
            width: 90%;
            margin: 5px;
            margin-left: 10px;
            background-color: #DD9FE2;
        }

        .body3 {
            border: solid;
            height: 30%;
            width: 90%;
            margin: 5px;
            margin-left: 10px;
            background-color: #DD9FE2;
        }

        .body4 {
            border: solid;
            height: 20px;
            width: 85px;
            margin: 5px;
            margin-left: 10px;
            background-color: #56ECDA;
            position: absolute;
            bottom: 430px;
        }

        .selected {
            border: 20px solid blue;
        }

        .selected {
            background-color: yellow;
        }

        .square {
            cursor: pointer;
        }

        .triangle {
            cursor: pointer;
            position: relative;
        }

        .triangle img {
            max-width: 100%;
            max-height: 100%;
            position: absolute;
            top: 0;
            left: 0;
        }
    </style>
</head>

<body>
    <div class="dress">
        <div class="navbar">
            <div class="left">
                <a href="index.php?view=dressing" class="home">Home</a>
                <a href="#" class="creation">Creation</a>
                <a href="index.php?view=dressinglvetement" class="lvetement">Liste vetements</a>
            </div>
            <div class="right">
                <a href="index.php?view=dressingaddvetement" class="close">X</a>
            </div>
        </div>
        <div class="main-content">
            <div class="sidebar">
            <div class="body1 triangle tr1" data-vetement=""></div>
            <div class="body2 triangle tr2" data-vetement=""></div>
            <div class="body1 triangle tr3" data-vetement=""></div>
            <div class="body3 triangle tr4" data-vetement=""></div>
            <div class="body3 triangle tr5" data-vetement=""></div>


                <form id="formVetements" action="controleur.php" method="post" style="display: none;">
                    <input type="hidden" name="vetement1" id="vetement1">
                    <input type="hidden" name="vetement2" id="vetement2">
                    <input type="hidden" name="vetement3" id="vetement3">
                    <input type="hidden" name="vetement4" id="vetement4">
                    <input type="hidden" name="vetement5" id="vetement5">
                    <input type="hidden" name="check" id="check">
                    <input type="hidden" name="action" id="submitValue" value="outcreate">
                </form>
            </div>
            <button class="body4" id="saveButton">Enregistrer</button>
            <div class="creation-content">
                <div class="content">
                    <?php
                    $idUser = $_SESSION["idUser"];
                    $vetements = lvetement($idUser);
                    
                    foreach ($vetements as $vetement) {
                        // Vérifiez si le champ Id_famille est vide
                        if (empty($vetement['Id_famille'])) {
                            $partiecorps = $vetement['Zoner'];
                            $boxClass = '';
                    
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
                                    $boxClass = 'box5';
                            }
                    
                            echo "<div class='$boxClass square' data-vetement-id='{$vetement['VetementID']}'>";
                            echo "<p>Nom : {$vetement['pseudo']}</p>";
                            echo '<img style="max-width: 150px; max-height: 200px;" src="uploads/' . $vetement['VetementID'] . '.png" alt="Image">';
                            echo "</div>";
                        }
                    }
                    
                    ?>
                </div>
            </div>
        </div>
    </div>
    <script>document.addEventListener('DOMContentLoaded', () => {
    let selectedSquare = null;
    let selectedTriangle = null;

    const squares = document.querySelectorAll('.square');
    const triangles = document.querySelectorAll('.triangle');
    const saveButton = document.getElementById('saveButton');
    const check = document.getElementById('check');

    if(squares.length ==0){
        check.value = "false";
        console.log("check.value", check.value);
        console.log("free");
        
    }
    squares.forEach(square => {
        square.addEventListener('click', () => {
            if (selectedSquare) {
                selectedSquare.classList.remove('selected');
            }
            selectedSquare = square;
            square.classList.add('selected');
            changeColorIfBothSelected();
        });
    });

    triangles.forEach(triangle => {
        triangle.addEventListener('click', () => {
            if (selectedTriangle) {
                selectedTriangle.classList.remove('selected');
            }
            selectedTriangle = triangle;
            triangle.classList.add('selected');
            if (selectedSquare) {
                const imgSrc = selectedSquare.querySelector('img').src;
                let img = triangle.querySelector('img');
                if (!img) {
                    img = document.createElement('img');
                    img.style.maxWidth = '100%';
                    img.style.maxHeight = '100%';
                    img.style.position = 'absolute';
                    img.style.top = '0';
                    img.style.left = '0';
                    triangle.appendChild(img);
                }
                img.src = imgSrc;
                triangle.dataset.vetement = selectedSquare.getAttribute('data-vetement-id');
                triangle.classList.remove('selected');
                selectedSquare.classList.remove('selected');
                selectedSquare = null;
                selectedTriangle = null;
            }
        });
    });

    saveButton.addEventListener('click', (e) => {
        e.preventDefault();
        submitForm();
    });

    function submitForm() {
        // Récupérez les valeurs des triangles et mettez-les dans les champs du formulaire
        document.getElementById("vetement1").value = document.querySelector(".tr1").dataset.vetement;
        document.getElementById("vetement2").value = document.querySelector(".tr2").dataset.vetement;
        document.getElementById("vetement3").value = document.querySelector(".tr3").dataset.vetement;
        document.getElementById("vetement4").value = document.querySelector(".tr4").dataset.vetement;
        document.getElementById("vetement5").value = document.querySelector(".tr5").dataset.vetement;

        // Définir la valeur du champ caché pour le bouton submit
        document.getElementById("submitValue").value = "outcreate";

        // Ajoutez cette ligne pour vérifier que la fonction est appelée
        console.log('submitForm called, submitValue:', document.getElementById("submitValue").value);

        // Soumettez le formulaire
        document.getElementById("formVetements").submit();
    }

    function changeColorIfBothSelected() {
        if (selectedSquare && selectedTriangle) {
            selectedSquare.style.backgroundColor = 'white';
            selectedTriangle.style.borderBottomColor = 'white';
            selectedTriangle.dataset.vetement = selectedSquare.getAttribute('data-vetement-id');
            selectedSquare.classList.remove('selected');
            selectedTriangle.classList.remove('selected');
            selectedSquare = null;
            selectedTriangle = null;
        }
    }
});

    </script>
</body>

</html>
<?php
}
?>
