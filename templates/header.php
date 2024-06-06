<?php
 include_once "libs/maLibUtils.php";
 include_once "libs/maLibSQL.pdo.php";
 include_once "libs/maLibSecurisation.php"; 
 include_once "libs/modele.php"; 
// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
	header("Location:../index.php");
	die("");
}

// Pose qq soucis avec certains serveurs...
echo "<?xml version=\"1.0\" encoding=\"utf-8\" ?>";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<!-- **** H E A D **** -->
<head>	
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>WeatherFit</title>
    <link rel="icon" sizes="32x20" type="ressources/logo.png" href="ressources/logo.png">
	<link rel="stylesheet" type="text/css" href="css/page.css"> 
	

</head>
<!-- **** F I N **** H E A D **** -->


<!-- **** B O D Y **** -->
<body>

<div id="header">
                <div class="recherche">
                <a href="index.php?view=accueil" style="text-decoration:none" class="logo" id="logo"><img src="ressources/logo.png" alt="Logo du site"></a>
                    <textarea placeholder="Rechercher des tenues"></textarea>
                    <button>🔎</button>

                    
                    <?php
                    if (valider("connecte", "SESSION")) {
                        echo '<a href="index.php?view=profil" style="text-decoration:none" class="profil" id="profil"><p class="profil_redirection">' . substr($_SESSION['pseudo'], 0, 1) . '</p></a>';                        
                    }
                    if (!valider("connecte", "SESSION")) {
                        echo '<a href="index.php?view=login" style="text-decoration:none" class="log" id="log">Se connecter</a>';
                    }
                
                    if (valider("connecte", "SESSION")) {
                        // echo '<a href="controleur.php?action=profil" style="text-decoration:none" class="profil" id="profil"><p class="profil_redirection">K</p></a>';
                        echo '<a href="controleur.php?action=Logout" style="text-decoration:none" class="log2" id="log2">Logout</a>';
                    }
                    ?>
                    
                </div>
                <div class="profil_log">
                
                <?php
    // if (!valider("connecte", "SESSION")) {
    //     echo '<a href="index.php?view=login" style="text-decoration:none" class="log" id="log">Se connecter</a>';
    // }

    // if (valider("connecte", "SESSION")) {
    //     // echo '<a href="controleur.php?action=profil" style="text-decoration:none" class="profil" id="profil"><p class="profil_redirection">K</p></a>';
    //     echo '<a href="controleur.php?action=Logout" style="text-decoration:none" class="log" id="log">Logout</a>';
    // }
    ?>
            </div>
            <div class="menu">
            <a href="index.php?view=dressing" style="text-decoration:none" class="menu_1" id="dressing">Dressing</a>
            <a href="index.php?view=tenues" style="text-decoration:none" class="menu_1" id="tenues">Tenues</a>
            <a href="index.php?view=feed" style="text-decoration:none" class="menu_1" id="feed">Feed</a>                
            <a href="index.php?view=messages" style="text-decoration:none" class="menu_1" id="messages">Messages</a>                
            <a href="index.php?view=propos" style="text-decoration:none" class="menu_1" id="propos">A propos</a>            
            </div>
        </div>








