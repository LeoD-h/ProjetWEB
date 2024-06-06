<?php
// Ce fichier permet de tester les fonctions développées dans le fichier bdd.php (première partie)

// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) == "users.php")
{
	header("Location:../index.php?view=users");
	die("");
}

include_once("libs/modele.php");
include_once("libs/maLibUtils.php"); // tprint
include_once("libs/maLibForms.php"); 
// définit mkTable
?>
<div class="principal-admin">
<div class="container-admin">
        <div class="left-menu-admin">
            <ul>
                <li><a href="#" onclick="showContent('accueil')">Accueil</a></li>
                <li><a href="#" onclick="showContent('autoriser')">Autoriser</a></li>
                <li><a href="#" onclick="showContent('interdire')">Interdire</a></li>
                <li><a href="#" onclick="showContent('promouvoir')">Promouvoir</a></li>
                <li><a href="#" onclick="showContent('retrograder')">Rétrograder</a></li>
                <li><a href="#" onclick="showContent('supprimer')">Supprimer</a></li>
            </ul>
        </div>

        <div class="content-body-admin">
            <div id="accueil" class="content-div-admin">
			    <h4 style="text-align:center; margin-bottom:7%">Administration du site</h4>
                <?php
                    $users = listerUtilisateurs("nbl");
                    mkTable($users);// ,array("id","pseudo"));
                ?>
			</div>
            <div id="autoriser" class="content-div-admin">
                <h4 style="text-align:center; margin-bottom:7%">Deblock Utilisateurs</h4>
                    <div id="main2">
                        <table class="table-admin">
                        <thead class="thead-admin">
                            <tr>
                                <th class="th-admin" colspan="2">Utilisateur</th>
                            </tr>
                        </thead>
                        <tbody class="tbody-admin">
                            <?php
                                $pseudoU = listerPrenomUtilisateursBlocked();
                                foreach ($pseudoU as $user) 
                                {
                                    echo '<tr class="tr-admin" onclick="selectUserId(this, \'' . htmlspecialchars($user['id']) . '\')"><td class="td-admin">' . htmlspecialchars($user['id']) . '</td><td class="td-admin">' . htmlspecialchars($user['pseudo']) . '</td></tr>';
                                }
                            ?>
                        </tbody>
                    </table>
            </div>
            <div class="form-group-admin">
                <form action="controleur.php" method="post">
                    <input type="hidden" id="selectedUserDeblock" name="selectedUserDeblock" value="">
                    <button type="submit" class="btn-admin" name="action" value="AutoriserU">Autoriser</button>
                </form>   
            </div> 
        </div>

            <div id="interdire" class="content-div-admin">
            <h4 style="text-align:center; margin-bottom:7%">Block Utilisateurs</h4>
            <div id="main2">
            <table class="table-admin">
            <thead class="thead-admin">
                <tr>
                    <th class="th-admin" colspan="2">Utilisateur</th>
                </tr>
            </thead>
            <tbody class="tbody-admin">
                <?php
                $pseudoU2 = listerPrenomUtilisateursDeblocked();
                foreach ($pseudoU2 as $user2) {
                    echo '<tr class="tr-admin" onclick="selectUserId(this, \'' . htmlspecialchars($user2['id']) . '\')"><td class="td-admin">' . htmlspecialchars($user2['id']) . '</td><td class="td-admin">' . htmlspecialchars($user2['pseudo']) . '</td></tr>';
                }
                
                ?>
            </tbody>
        </table>
            </div>
            <div class="form-group-admin">
        <form action="controleur.php" method="post">
        <input type="hidden" id="selectedUserBlock" name="selectedUserBlock" value="">
            <button type="submit" class="btn-admin" name="action" value="InterdireU">Interdire</button>
            </form>   
            </div> 
        </div>
        
            <div id="promouvoir" class="content-div-admin">
            <h4 style="text-align:center; margin-bottom:7%">Promouvoir Utilisateurs</h4>
            <div id="main2">
            <table class="table-admin">
            <thead class="thead-admin">
                <tr>
                    <th class="th-admin" colspan="2">Utilisateur</th>
                </tr>
            </thead>
            <tbody class="tbody-admin">
                <?php
                $pseudoU2 = listerPrenomUtilisateurs();
                foreach ($pseudoU2 as $user2) {
                    echo '<tr class="tr-admin" onclick="selectUserId(this, \'' . htmlspecialchars($user2['id']) . '\')"><td class="td-admin">' . htmlspecialchars($user2['id']) . '</td><td class="td-admin">' . htmlspecialchars($user2['pseudo']) . '</td></tr>';
                }
                
                ?>
            </tbody>
        </table>
            </div>
            <div class="form-group-admin">
        <form action="controleur.php" method="post">
        <input type="hidden" id="selectedUserUtilisateurProm" name="selectedUserUtilisateurProm" value="">
            <button type="submit" class="btn-admin" name="action" value="PromouvoirU">Promouvoir</button>
            </form>   
            </div>
        </div>

        <div id="retrograder" class="content-div-admin">
        <h4 style="text-align:center; margin-bottom:7%">Retrograder Utilisateurs</h4>
            <div id="main2">
            <table class="table-admin">
            <thead class="thead-admin">
                <tr>
                    <th class="th-admin" colspan="2">Utilisateur</th>
                </tr>
            </thead>
            <tbody class="tbody-admin">
                <?php
                $pseudoU2 = listerPrenomUtilisateursAdmin();
                foreach ($pseudoU2 as $user2) {
                    echo '<tr class="tr-admin" onclick="selectUserId(this, \'' . htmlspecialchars($user2['id']) . '\')"><td class="td-admin">' . htmlspecialchars($user2['id']) . '</td><td class="td-admin">' . htmlspecialchars($user2['pseudo']) . '</td></tr>';
                }
                
                ?>
            </tbody>
        </table>
            </div>
            <div class="form-group-admin">
        <form action="controleur.php" method="post">
        <input type="hidden" id="selectedUserUtilisateurRetr" name="selectedUserUtilisateurRetr" value="">
            <button type="submit" class="btn-admin" name="action" value="RetrograderU">Retrograder</button>
            </form>   
            </div>
        </div>

            <div id="supprimer" class="content-div-admin">
            <h4 style="text-align:center; margin-bottom:7%">Supprimer Utilisateurs</h4>
            <div id="main2">
            <table class="table-admin">
            <thead class="thead-admin">
                <tr>
                    <th class="th-admin" colspan="2">Utilisateur</th>
                </tr>
            </thead>
            <tbody class="tbody-admin">
                <?php
                $pseudoU2 = listerPrenomUtilisateurs();
                foreach ($pseudoU2 as $user2) {
                    echo '<tr class="tr-admin" onclick="selectUserId(this, \'' . htmlspecialchars($user2['id']) . '\')"><td class="td-admin">' . htmlspecialchars($user2['id']) . '</td><td class="td-admin">' . htmlspecialchars($user2['pseudo']) . '</td></tr>';
                }
                
                ?>
            </tbody>
        </table>
            </div>
            <div class="form-group-admin">
        <form action="controleur.php" method="post">
        <input type="hidden" id="selectedUserUtilisateurSupp" name="selectedUserUtilisateurSupp" value="">
            <button type="submit" class="btn-admin" name="action" value="SupprimerU">Supprimer</button>
            </form>   
            </div>
            </div>
        </div>
    </div>
</div>



<script>
		function showContent(contentId) {
			var contentDivs = document.getElementsByClassName("content-div-admin");
			for (var i = 0; i < contentDivs.length; i++) {
				contentDivs[i].style.display = "none";
			}
			document.getElementById(contentId).style.display = "block";
		}

        function selectUserId(row, userId) {
            // Enlever la surbrillance de toutes les lignes
            var rows = document.querySelectorAll('.tr-admin');
            rows.forEach(function(r) {
                r.classList.remove('selected-row');
            });
            
            // Ajouter la surbrillance à la ligne cliquée
            row.classList.add('selected-row');
            
            // Mettre à jour la valeur de l'input caché
            document.getElementById('selectedUserDeblock').value = userId;
            document.getElementById('selectedUserBlock').value = userId;
            document.getElementById('selectedUserUtilisateurProm').value = userId;
            document.getElementById('selectedUserUtilisateurRetr').value = userId;
            document.getElementById('selectedUserUtilisateurSupp').value = userId;
        }
</script>






