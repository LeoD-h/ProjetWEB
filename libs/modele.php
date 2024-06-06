<?php


// inclure ici la librairie faciliant les requêtes SQL
include_once ("maLibSQL.pdo.php");


function listerUtilisateurs($classe = "both")
{
	// NB : la présence du symbole '=' indique la valeur par défaut du paramètre s'il n'est pas fourni
	// Cette fonction liste les utilisateurs de la base de données 
	// et renvoie un tableau d'enregistrements. 
	// Chaque enregistrement est un tableau associatif contenant les champs 
	// id,pseudo,blacklist,connecte,couleur

	// Lorsque la variable $classe vaut "both", elle renvoie tous les utilisateurs
	// Lorsqu'elle vaut "bl", elle ne renvoie que les utilisateurs blacklistés
	// Lorsqu'elle vaut "nbl", elle ne renvoie que les utilisateurs non blacklistés

	$SQL = "select id pseudo, Prépseudo, passe, Adresse_email, Blacklist, Connecte, Admin, Ville from users";
	if ($classe == "bl")
		$SQL .= " where blacklist=1";
	if ($classe == "nbl")
		$SQL .= " where blacklist=0";

	// echo $SQL;
	return parcoursRs(SQLSelect($SQL));

}

function listerPrenomUtilisateursBlocked()
{
	$SQL = "SELECT id, pseudo FROM users WHERE blacklist=1";
	return parcoursRs(SQLSelect($SQL));

}

function listerPrenomUtilisateursDeblocked()
{
	$SQL = "SELECT id, pseudo FROM users WHERE blacklist=0";
	return parcoursRs(SQLSelect($SQL));

}

function listerPrenomUtilisateurs()
{
	$SQL = "SELECT id, pseudo FROM users WHERE Admin=0";
	return parcoursRs(SQLSelect($SQL));
}

function listerPrenomUtilisateursAdmin()
{
	$SQL = "SELECT id, pseudo FROM users WHERE Admin=1";
	return parcoursRs(SQLSelect($SQL));
}

function interdireUtilisateur($idUser)
{
	// cette fonction affecte le booléen "blacklist" à vrai
	$SQL = "UPDATE users SET blacklist=1 WHERE id='$idUser'";
	// les apostrophes font partie de la sécurité !! 
	// Il faut utiliser addslashes lors de la récupération 
	// des données depuis les formulaires

	SQLUpdate($SQL);
}

function autoriserUtilisateur($idUser)
{
	// cette fonction affecte le booléen "blacklist" à faux 
	$SQL = "UPDATE users SET blacklist=0 WHERE id='$idUser'";
	SQLUpdate($SQL);
}

function promouvoirUtilisateur($idUser)
{
	// cette fonction affecte le booléen "Admin" à vrai
	$SQL = "UPDATE users SET Admin=1 WHERE id='$idUser'";
	SQLUpdate($SQL);
}

function retrograderUtilisateur($idUser)
{
	// cette fonction affecte le booléen "Admin" à faux
	$SQL = "UPDATE users SET Admin=0 WHERE id='$idUser'";
	SQLUpdate($SQL);
}
function verifUserBdd($login, $passe)
{
	// Vérifie l'identité d'un utilisateur 
	// dont les identifiants sont passes en paramètre
	// renvoie faux si user inconnu
	// renvoie l'id de l'utilisateur si succès

	$SQL = "SELECT id FROM users WHERE pseudo='$login' AND passe='$passe'";

	return SQLGetChamp($SQL);
	// si on avait besoin de plus d'un champ
	// on aurait du utiliser SQLSelect
}

function isAdmin($idUser)
{
	// vérifie si l'utilisateur est un administrateur
	$SQL = "SELECT Admin FROM users WHERE id='$idUser'";
	// die("$SQL");
	return SQLGetChamp($SQL);
}



function deleteUsers($idUser)
{

	return SQLDelete("DELETE FROM users WHERE id=$idUser");
}

function changerCouleur($idUser, $couleur = "black")
{
	// cette fonction modifie la valeur du champ 'couleur' de l'utilisateur concerné
	$sql = "
	  UPDATE users
	  SET couleur = '$couleur'
	  WHERE id = '$idUser';
	";
	return SQLUpdate($sql);
}

function changerPasse($idUser, $passe)
{
	$SQL = "UPDATE users SET passe='$passe' WHERE id='$idUser'";
	return SQLUpdate($SQL);
}

function addTenue($idUser, $nom, $description, $couleur, $type, $marque, $prix, $moment, $saison, $chaud, $autre)
{
	// Ajoute d'abord les critères dans CritereVetements
	$idCritere = addCritere($moment, $saison, $chaud, $autre);

	// Ensuite, ajoute la tenue dans Vetements en associant l'ID de critère
	$SQL = "INSERT INTO `Vetements` (`pseudo`, `Type_de_vetement`, `Couleur`, `Marque`, `Prix`, `IDCritere`, `id`) VALUES ('$nom', '$type', '$couleur', '$marque', $prix, $idCritere, $idUser);";
	SQLInsert($SQL);

	$sql_id = "SELECT MAX(VetementID) AS last_inserted_id FROM Vetements;";

	return SQLGetChamp($sql_id);
}

function addCritere($moment, $saison, $chaud, $autre)
{
	// Ajoute les critères dans CritereVetements
	$SQL = "INSERT INTO `CritereVetements` (`Choix_moment`, `Choix_Saison`, `Note_chaud`, `Zoner`) VALUES ($moment, $saison, $chaud, '$autre');";
	// Exécute la requête SQL pour insérer les critères dans CritereVetements
	$idCritere = SQLInsert($SQL);

	return $idCritere;
}


function lvetement($idUser)
{
	$SQL = "SELECT Vetements.*, CritereVetements.*
	FROM Vetements
	JOIN CritereVetements ON Vetements.IDCritere = CritereVetements.CritereID
	WHERE Vetements.id = $idUser;
	";
	// die("SQL : $SQL");
	return parcoursRs(SQLSelect($SQL));
}

// function ajouterphoto($idVetement,$idphoto){
// 	$sql = "";
// }

function ListeEmail($idUser)
{
	$SQL = " SELECT Adresse_email ";
	$SQL .= " FROM users WHERE id='$idUser'";
	return SQLGetChamp($SQL);
}

function ListeLocalisation($idUser)
{
	$SQL = " SELECT Ville ";
	$SQL .= " FROM users WHERE id='$idUser'";
	return SQLGetChamp($SQL);
}

function ListePrenom($idUser)
{
	$SQL = " SELECT prépseudo ";
	$SQL .= " FROM users WHERE id='$idUser'";
	return SQLGetChamp($SQL);
}

function ListePseudo($idUser)
{
	$SQL = " SELECT pseudo ";
	$SQL .= " FROM users WHERE id='$idUser'";
	return SQLGetChamp($SQL);
}

function ModifierEmail($idUser, $email)
{
	$SQL = "UPDATE users SET Adresse_email='$email' WHERE id='$idUser'";
	return SQLUpdate($SQL);
}

function ModifierLocalisation($idUser, $city)
{
	$SQL = "UPDATE users SET Ville='$city' WHERE id='$idUser'";
	return SQLUpdate($SQL);
}

function ModifierPrenom($idUser, $pseudo)
{
	$SQL = "UPDATE users SET pseudo='$pseudo' WHERE id='$idUser'";
	return SQLUpdate($SQL);
}

function ModifierNom($idUser, $nom)
{
	$SQL = "UPDATE users SET Prépseudo='$nom' WHERE id='$idUser'";
	return SQLUpdate($SQL);
}

function ModifierMdp($idUser, $mdp)
{
	$SQL = "UPDATE users SET passe='$mdp' WHERE id='$idUser'";
	return SQLUpdate($SQL);
}

function createUsers($pseudo, $prépseudo, $passe, $email, $ville)
{
	$intAdmin = $admin ? 1 : 0;
	return SQLInsert("
	  INSERT INTO users(pseudo, Prépseudo, passe, adresse_email, Blacklist, Connecte, Type_de_compte, Autres_informations_utilisateur, Langue, Ville)
	  VALUES ('$pseudo', '$prépseudo', '$passe', '$email', 0, 0, 'U', '', 'Fr', '$ville');
	");

}
function recupcritere($vetement1, $vetement2, $vetement3, $vetement4, $vetement5)
{
	$sql = "SELECT AVG(MoyenneCritere) AS MoyenneGlobale 
	FROM ( 
		SELECT AVG(cv.note_chaud) AS MoyenneCritere 
		FROM Vetements v 
		INNER JOIN CritereVetements cv ON v.IDCritere = cv.CritereID 
		WHERE v.VetementID IN ($vetement1, $vetement2, $vetement3, $vetement4, $vetement5)
	) AS SousRequete;
	";
	// die("$sql");
	return SQLGetChamp($sql);
}

function creerfamille($rcritere)
{
	// Insérer les données
	$sql = "INSERT INTO Famille_vetement (Rate) VALUES ('$rcritere')";
	SQLInsert($sql);

	// Récupérer l'ID du dernier enregistrement inséré
	$sql_id = "SELECT MAX(Id_famille) AS last_inserted_id FROM Famille_vetement;";

	return SQLGetChamp($sql_id);
}

function ajouterFamille($idfamille, $vetement1, $vetement2, $vetement3, $vetement4, $vetement5)
{

	$SQL = "UPDATE Vetements 
	SET Id_famille = $idfamille
	WHERE VetementID IN ($vetement1, $vetement2, $vetement3, $vetement4, $vetement5)";
	// die("$SQL");

	return SQLUpdate($SQL);
}
function trouvertenue($temperature)
{
	// Connexion à la base de données (à remplacer avec vos propres informations)
	// echo "$temperature";
	$temperaturem = $temperature;
	$sql = "SELECT Id_famille FROM famille_vetement WHERE rate = $temperature";
	// die("$sql");
	$result = SQLGetChamp($sql);
	while ($result == 0) {
		$temperature++;
		$temperaturem--;
		$sql = "SELECT Id_famille FROM famille_vetement WHERE rate = $temperature";
		// echo "$sql";
		$result = SQLGetChamp($sql);
		// echo "$result";
		// echo "tt";
		// die("$result");
		if ($result == 0 && $temperaturem > 0) {
			$sql = "SELECT Id_famille FROM famille_vetement WHERE rate = $temperaturem";
			// echo $sql;
			$result = SQLGetChamp($sql);
		} else {
			break;
		}
	}
	// echo "$result";
	// die("$temperature $temperaturem");
	//  die("$result");
	// $sql = "SELECT Id_famille FROM famille_vetement WHERE rate = $result";
	// die("$sql");
	// echo "$sql";
	// die($sql);
	// $resultu = SQLGetChamp($sql);
	// echo "$resultu";
	// die("$result");
	return $result;
}


function trouverletenue($result)
{

	$sql = "SELECT * FROM vetements WHERE Id_famille = $result";
	// die("$sql");
	// die("$result");
	// die($resultu);
	$results = parcoursRs(SQLSelect($sql));
	// die ("$results");
	return $results;
}








function trouvertenuesoiree($ban)
{
	// Connexion à la base de données (à remplacer avec vos propres informations)
	// // echo "$temperature";
	// die("$ban");
	$sql = "SELECT famille_vetement.Id_famille
            FROM famille_vetement 
            JOIN vetements ON vetements.Id_famille = famille_vetement.Id_famille 
            JOIN criterevetements ON vetements.IDCritere = criterevetements.CritereID 
            WHERE famille_vetement.Id_famille != $ban 
            GROUP BY famille_vetement.Id_famille 
            ORDER BY AVG(criterevetements.CritereID) DESC 
            LIMIT 1";


	$results = SQLGetChamp($sql);
	$sql = "SELECT * FROM vetements WHERE Id_famille = $results";
	$results = parcoursRs(SQLSelect($sql));

	// $sql = "SELECT *

	// die($results);
	return $results;
}

function trouvertenuesport($ban)
{
	// Connexion à la base de données (à remplacer avec vos propres informations)
	// // echo "$temperature";
	// die("$ban");
	$sql = "SELECT famille_vetement.Id_famille
            FROM famille_vetement 
            JOIN vetements ON vetements.Id_famille = famille_vetement.Id_famille 
            JOIN criterevetements ON vetements.IDCritere = criterevetements.CritereID 
            WHERE famille_vetement.Id_famille != $ban 
            GROUP BY famille_vetement.Id_famille 
            ORDER BY AVG(criterevetements.CritereID) ASC
            LIMIT 1";


	$results = SQLGetChamp($sql);
	$sql = "SELECT * FROM vetements WHERE Id_famille = $results";
	$results = parcoursRs(SQLSelect($sql));

	// $sql = "SELECT *

	// die($results);
	return $results;
}

// Exemple d'utilisation de la fonction



function listerConversations($idUser)
{
	// Liste toutes les conversations ($mode="tout")
	// OU uniquement celles actives  ($mode="actives"), ou inactives  ($mode="inactives")

	$SQL = " SELECT Id, Theme ";
	$SQL .= " FROM conversation ";
	$SQL .= " WHERE (UserID1='$idUser') OR (UserID2='$idUser')";

	return parcoursRs(SQLSelect($SQL));
}

function listerMessages($id, $format = "asso")
{
	// Liste les messages de cette conversation, au format JSON ou tableau associatif
	// Champs à extraire : contenu, auteur, couleur 
	// en ne renvoyant pas les utilisateurs blacklistés

	$SQL = "SELECT m.contenu, u.pseudo as auteur, u.id as idAuteur, IdConv";
	$SQL .= " FROM message m INNER JOIN users u ON m.idAuteur = u.id";
	$SQL .= " WHERE m.IdConv='$id'";
	$SQL .= " AND u.blacklist=0";
	$SQL .= " ORDER BY m.id ASC";

	return parcoursRs(SQLSelect($SQL));

}

function listerUser1Conv($id)
{
	// Liste les utilisateurs de la conversation
	$SQL = "Select u.id FROM conversation c JOIN users u ON c.UserID1 = u.id WHERE c.Id='$id'";
	return SQLGetChamp($SQL);
}

function listerUser2Conv($id)
{
	// Liste les utilisateurs de la conversation
	$SQL = "Select u.id FROM conversation c JOIN users u ON c.UserID2 = u.id WHERE c.Id='$id'";
	return SQLGetChamp($SQL);
}

function NomUser($User)
{
	$SQL = "SELECT pseudo FROM users WHERE id='$User'";
	return SQLGetChamp($SQL);
}

function addMessage($idConv, $idAuteur, $contenu)
{
	$SQL = "INSERT INTO message (IdConv, idAuteur, contenu) VALUES ('$idConv','$idAuteur','$contenu')";
	SQLInsert($SQL);
}
function addMessageFeel($idConv, $idAuteur, $contenu)
{
	$SQL = "INSERT INTO chatmessages (id, Contenu_du_message, Date_et_heure_du_message, TenueID) VALUES ('$idAuteur','$contenu','$date','$idFeel')";
	SQLInsert($SQL);
}
function listerMessagesFeel($idFeel, $format = "asso")
{
	// Liste les messages de cette conversation, au format JSON ou tableau associatif
	// Champs à extraire : contenu, auteur, couleur 
	// en ne renvoyant pas les utilisateurs blacklistés

	$SQL = "SELECT Contenu_du_message as contenu, u.pseudo as auteur, u.id as idAuteur, TenueID as IdFeel, Date_et_heure_du_message as date";
	$SQL .= " FROM chatmessages m INNER JOIN users u ON m.id = u.id";
	$SQL .= " WHERE m.IdConv='$idFeel'";

	$SQL .= " ORDER BY m.id ASC";

	return parcoursRs(SQLSelect($SQL));

}
function listerPost()
{
	$SQL = "SELECT p.*, u.pseudo as auteur FROM posts p INNER JOIN users u ON p.idAuteur = u.id";
	return parcoursRs(SQLSelect($SQL));
}


?>