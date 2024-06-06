<?php
session_start();

include_once "libs/maLibUtils.php";
include_once "libs/maLibSQL.pdo.php";
include_once "libs/maLibSecurisation.php";
include_once "libs/modele.php";

$addArgs = "";

if ($action = valider("action")) {
    ob_start();
    echo "Action = '$action' <br />";
    // ATTENTION : le codage des caractères peut poser PB si on utilise des actions comportant des accents... 
    // A EVITER si on ne maitrise pas ce type de problématiques

    /* TODO: A REVOIR !!
    // Dans tous les cas, il faut etre logue... 
    // Sauf si on veut se connecter (action == Connexion)

    if ($action != "Connexion") 
        securiser("login");
    */

    // Un paramètre action a été soumis, on fait le boulot...
    switch ($action) {


        // Connexion //////////////////////////////////////////////////
        case 'Connexion':
            // On verifie la presence des champs login et passe
            if ($login = valider("login"))
                if ($passe = valider("passe")) {

                    // On verifie l'utilisateur, 
                    // et on crée des variables de session si tout est OK
                    // Cf. maLibSecurisation
                    if (verifUser($login, $passe)) {

                        // tout s'est bien passé, doit-on se souvenir de la personne ? 
                        if (valider("remember")) {
                            setcookie("login", $login, time() + 60 * 60 * 24 * 30);
                            setcookie("passe", $password, time() + 60 * 60 * 24 * 30);
                            setcookie("remember", true, time() + 60 * 60 * 24 * 30);
                        } else {
                            setcookie("login", "", time() - 3600);
                            setcookie("passe", "", time() - 3600);
                            setcookie("remember", false, time() - 3600);
                        }

                    }
                }

            // On redirigera vers la page index automatiquement
            break;

        case 'Logout':
            session_destroy();
            break;

        case 'submit1':


            if (isset($_GET['partiecorps'])) {

                $autre = $_GET['partiecorps'];

                //     die("La partie est : $partiecorps");
            }




            // die("La partie est : $partiecorps");
            $addArgs = "?view=dressingaddvetement";
            if (valider("connecte", "SESSION"))

                if ($nom = valider("nom", "GET"))
                    if ($type = valider("type", "GET"))
                        if ($couleur = valider("couleur", "GET"))
                            if ($marque = valider("marque", "GET"))

                                if ($prix = valider("prix", "GET"))
                                    if ($moment = valider("moment", "GET"))
                                        if ($saison = valider("saison", "GET"))
                                            if ($chaud = valider("chaud", "GET"))

                                            // die("check");
                                            {

                                                // die("Nom : $nom
                                                //     Type : $type
                                                //     Marque : $marque 
                                                //     Couleur :$couleur
                                                //     Prix : $prix 
                                                //     Moment : $moment
                                                //     Saison : $saison
                                                //     CHaud : $chaud
                                                //     Autre : $autre");

                                                $idUser = $_SESSION["idUser"];

                                                $idVetement = addTenue($idUser, $nom, $description, $couleur, $type, $marque, $prix, $moment, $saison, $chaud, $autre);
                                                // die("critere");
                                                // $idCritere = addCritere($moment,$saison,$chaud,$autre);
                                                // die("end");

                                                // die("$idVetement");
                                                // die("end");
                                                $addArgs = "?view=dressingaddvetementimage&idVetement=" . $idVetement;
                                                //   die("end1"); 


                                            }
            break;
        // //     }
        // //     $addArgs .= "$idUser";
        // // break;

        // case 'rep2':
        //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //         if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        //             $allowed = ['jpeg', 'jpg', 'png', 'gif'];
        //             $filename = $_FILES['image']['name'];
        //             $filetype = pathinfo($filename, PATHINFO_EXTENSION);

        //             if (in_array($filetype, $allowed)) {
        //                 $newFilename = 'uploads/' . uniqid() . '.' . $filetype;

        //                 if (move_uploaded_file($_FILES['image']['tmp_name'], $newFilename)) {
        //                     echo json_encode(['filePath' => $newFilename]);
        //                     exit;
        //                 } else {
        //                     echo json_encode(['error' => 'Failed to move uploaded file. Check the permissions of the uploads directory.']);
        //                     exit;
        //                 }
        //             } else {
        //                 echo json_encode(['error' => 'Invalid file type.']);
        //                 exit;
        //             }
        //         } else {
        //             echo json_encode(['error' => 'No file uploaded or upload error.']);
        //             exit;
        //         }
        //     } else {
        //         echo json_encode(['error' => 'Invalid request method.']);
        //         exit;
        //     }
        //     $addArgs = "?view=dressing";
        //     break;
        case 'outcreate':
            $check = $_POST['check'];
            
            if ($check != "false") {
                $check = 1;
                // Récupérez les identifiants des vêtements à partir des données POST
                $vetement1 = valider("vetement1", "POST");
                $vetement2 = valider("vetement2", "POST");
                $vetement3 = valider("vetement3", "POST");
                $vetement4 = valider("vetement4", "POST");
                $vetement5 = valider("vetement5", "POST");
                // die("$vetement1 $vetement2 $vetement3 $vetement4 $vetement5");

                // Récupérez les détails des vêtements en utilisant les identifiants


                // die("$vetement1 $vetement2 $vetement3 $vetement4 $vetement5");
                // Affichez les détails des vêtements

                $rcritere = recupcritere($vetement1, $vetement2, $vetement3, $vetement4, $vetement5);

                $idfamille = creerfamille($rcritere);

                ajouterFamille($idfamille, $vetement1, $vetement2, $vetement3, $vetement4, $vetement5);
                // die("check");
                
                // die("$idfamille");

                // case 'test':
                //     session_destroy();
            }else{
                
                $addArgs = "?view=dressingaddvetement";
            }
            break;
        case 'Actualiser';
            $test = ""; // Initialisation de la variable $test
            $temperature = $_POST['temperature_range'];
            // die("$temperature");

            $x = trouvertenue($temperature); // Appel de la fonction trouvertenue avec la température 4
            $y = trouverletenue($x);

            // die("$x $temperature");
            // die("test$x");   
            $_SESSION['vetements'] = $y;
            $z = trouvertenuesoiree($x);
            $_SESSION['vetementssoiree'] = $z;
            $f = trouvertenuesport($x);
            $_SESSION['vetementssport'] = $f;
            foreach ($y as $i) { // Boucle foreach pour itérer sur les éléments de $x
                $test .= $i['VetementID'];
            }
            // die("$test");

            $addArgs = "?view=tenues";
            // }
            //  die("$test");
            break;
        case 'formVetements':


            // Vérifie si le formulaire a été soumis
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Récupère les valeurs des champs du formulaire
                $vetement1 = $_POST['vetement1'];
                $vetement2 = $_POST['vetement2'];
                $vetement3 = $_POST['vetement3'];
                $vetement4 = $_POST['vetement4'];
                $vetement5 = $_POST['vetement5'];

                // Faites ce que vous voulez avec ces valeurs
                // Par exemple, vous pouvez les utiliser pour effectuer des opérations en base de données ou les afficher
                // Pour l'exemple, affichons simplement ces valeurs
                echo "Vêtement 1 : " . $vetement1 . "<br>";
                echo "Vêtement 2 : " . $vetement2 . "<br>";
                echo "Vêtement 3 : " . $vetement3 . "<br>";
                echo "Vêtement 4 : " . $vetement4 . "<br>";
                echo "Vêtement 5 : " . $vetement5 . "<br>";
            }



            break;

        case 'Modemail':
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Récupère les valeurs des champs du formulaire
                $email = $_POST['email'];
                $idUser = $_SESSION["idUser"];
                ModifierEmail($idUser, $email);
                $addArgs = "?view=profil";

            }
            break;


        case 'Modnom':
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Récupère les valeurs des champs du formulaire
                $nom = $_POST['nom'];
                $idUser = $_SESSION["idUser"];
                ModifierNom($idUser, $nom);
                $addArgs = "?view=profil";

            }
            break;

        case 'Modpseudo':
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Récupère les valeurs des champs du formulaire
                $pseudo = $_POST['pseudo'];
                $idUser = $_SESSION["idUser"];
                ModifierPrenom($idUser, $pseudo);
                $addArgs = "?view=profil";

            }
            break;

        case 'Modville':
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Récupère les valeurs des champs du formulaire
                $city = $_POST['ville'];
                $idUser = $_SESSION["idUser"];
                ModifierLocalisation($idUser, $city);
                $addArgs = "?view=profil";

            }
            break;

        case 'Modpasse':
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Récupère les valeurs des champs du formulaire
                $mdp = $_POST['mdp'];
                $idUser = $_SESSION["idUser"];
                ModifierMdp($idUser, $mdp);
                session_destroy();
                $addArgs = "?view=login";

            }
            break;

        case 'CreateU':
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Récupère les valeurs des champs du formulaire
                $pseudo = $_POST['pseudo'];
                $prépseudo = $_POST['nom'];
                $passe = $_POST['password'];
                $passeconfirm = $_POST['confirm_password'];
                $email = $_POST['email'];
                $ville = $_POST['ville'];
                $idUser = $_SESSION["idUser"];
                if ($passe == $passeconfirm)
                    createUsers($pseudo, $prépseudo, $passe, $email, $ville);
                $addArgs = "?view=login";

            }
            break;
        case 'AutoriserU':
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Récupère les valeurs des champs du formulaire
                $idUser = $_POST['selectedUserDeblock'];
                AutoriserUtilisateur($idUser);
                $addArgs = "?view=admin";
            }
            break;

        case 'InterdireU':
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Récupère les valeurs des champs du formulaire
                $idUser = $_POST['selectedUserBlock'];
                InterdireUtilisateur($idUser);
                $addArgs = "?view=admin";
            }
            break;

        case 'PromouvoirU':
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Récupère les valeurs des champs du formulaire
                $idUser = $_POST['selectedUserUtilisateurProm'];
                promouvoirUtilisateur($idUser);
                $addArgs = "?view=admin";
            }
            break;

        case 'RetrograderU':
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Récupère les valeurs des champs du formulaire
                $idUser = $_POST['selectedUserUtilisateurRetr'];
                retrograderUtilisateur($idUser);
                $addArgs = "?view=admin";
            }
            break;

        case 'SupprimerU':
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Récupère les valeurs des champs du formulaire
                $idUser = $_POST['selectedUserUtilisateurSupp'];
                deleteUsers($idUser);
                $addArgs = "?view=admin";
            }
            break;

        case 'EnvoyerMessage':
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Récupère les valeurs des champs du formulaire
                $idAuteur = $_POST["idAuteur"];
                $idConv = $_POST["idConv"];
                $contenu = $_POST["messagesU"];
                AddMessage($idConv, $idAuteur, $contenu);
                $addArgs = "?view=messages";
            }
            break;

        case 'PublierMessage':
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Récupère les valeurs des champs du formulaire
                $idAuteur = $_POST["idAuteur"];
                $idFeel = $_POST["idFeel"];
                $date = date("Y-m-d H:i:s");
                $contenu = $_POST["contenu"];
                addMessageFeel($idAuteur, $contenu, $date, $idFeel);
                $addArgs = "?view=feed";
            }
            break;
    }

}

// On redirige toujours vers la page index, mais on ne connait pas le répertoire de base
// On l'extrait donc du chemin du script courant : $_SERVER["PHP_SELF"]
// Par exemple, si $_SERVER["PHP_SELF"] vaut /chat/data.php, dirname($_SERVER["PHP_SELF"]) contient /chat

$urlBase = dirname($_SERVER["PHP_SELF"]) . "/index.php";
// On redirige vers la page index avec les bons arguments

header("Location:" . $urlBase . $addArgs);

// On écrit seulement après cette entête
ob_end_flush();

?>