<?php

// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
	header("Location:../index.php");
	die("");
}
include_once ("libs/modele.php");
include_once ("libs/maLibUtils.php"); // tprint
include_once ("libs/maLibForms.php");
// Pose qq soucis avec certains serveurs...
echo "<?xml version=\"1.0\" encoding=\"utf-8\" ?>";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<!-- **** H E A D **** -->
<head>	
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>TinyMVC ...</title>
	<link rel="stylesheet" type="text/css" href="css/page.css"> 
	

</head>
<!-- **** F I N **** H E A D **** -->


<!-- **** B O D Y **** -->
<body>

<div id="footer" class="container_liste">
    <div class="liste_gauche">
        <ul>
            <li><a href="index.php?view=dressing" style="text-decoration:none" class="" id="dressing">Dressing</a></li>
            <li><a href="index.php?view=tenues" style="text-decoration:none" class="" id="tenues">Tenues</a></li>
            <li><a href="index.php?view=feed" style="text-decoration:none" class="" id="feed">Feed</a></li>
            <li><a href="index.php?view=achats" style="text-decoration:none" class="" id="achats">Achats</a></li>
            <li><a href="index.php?view=propos" style="text-decoration:none" class="" id="propos">A propos</a></li>
        </ul>
    </div>
    
    <div class="liste_middle">
        <ul>
            <div>Aide : </div>
            <li><a href="index.php?view=accueil" style="text-decoration:none" class="" id="tuto">Tutoriel</a></li>
            <li><a href="index.php?view=tenues" style="text-decoration:none" class="" id="meteo">Meteo Du Jour</a></li>
            <li><a href="index.php?view=meteo" style="text-decoration:none" class="" id="tenues">Tenues Du Jour</a></li>
            <?php

            if (! valider("connecte","SESSION")) {
            } else 
            {
	            if ($_SESSION["isAdmin"]) 
                {
		            echo '<li><a href="index.php?view=admin" style="text-decoration:none" >Admin</a></li>';
	            }
            }
            ?>
        </ul>
    </div>
    
    <div class="liste_droite">
        <div class="liste_deco">
        <?php
		// Si l'utilisateur est connecte, on affiche un lien de deconnexion 
		if (valider("connecte","SESSION"))
		{
			echo "Utilisateur <b>$_SESSION[pseudo]</b> connecté depuis <b>$_SESSION[heureConnexion]</b> &nbsp; "; 
			echo "<a href=\"controleur.php?action=Logout\">Se Déconnecter</a>";
		}
		?>
        </div>
    </div>
</div>