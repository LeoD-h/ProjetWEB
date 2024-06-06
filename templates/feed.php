<?php
// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['idUser'])) {
    header("Location:../index.php?view=messages");
    die("");
}

include_once("libs/modele.php"); // listes
include_once("libs/maLibUtils.php"); // tprint
include_once("libs/maLibForms.php"); // mkTable, mkLiens, mkSelect ...

$PostsFeel = listerPost($_SESSION['idUser']);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="page.css">
</head>
<body>
    <div class="container-feed">
        <div class="post-feed">
            <div class="image-container-feed">
            <?php
            // Lister les conversations actives sous forme de liens
            if ($PostsFeel) {
                echo "<ul>";
                foreach ($PostsFeel as $post) {  // Changer $PostsFeel en $post
                    $id = $post['id'];
                    $title = $post['title'];
                    $body = $post['body'];
                    $date = $post['created_at'];
                    $idTenue = $post['TenueID'];
                    echo '<div class="">';
                    echo "<a href='#' class=\"nom-conversation\" onclick='toggleMessages($id)'>$title</a>";
                    echo "<img src=\"ressources/drapeaufr.png\" alt=\"Image Placeholder\">";
                    echo "<p class=\"\">$body - $date</p>";
                    echo '</div>';
                }
                echo "</ul>";
            } else {
               
            }
            ?>
            </div>
            <div class="content-feed">
                <?php
                if ($PostsFeel) {
                    foreach ($PostsFeel as $post) {  // Changer $PostsFeel en $post
                        $messagesFeel = listerMessagesFeel($post['id'], $format = "asso"); // Utiliser l'id du post actuel
                        if ($messagesFeel) {
                            foreach ($messagesFeel as $message) { // Changer $messagesFeel en $message
                                $auteur = $message['auteur'];
                                $contenu = $message['contenu'];
                                $date = $message['date'];
                                echo "<span class=\"username-feed\">$auteur - $date</span> ";
                                echo "<p>$contenu</p>";
                            }
                        } else {
                            echo "<p>Aucun message</p>";
                        }
                    }
                }
                ?>
                </div>
                <div class="form_feed_input">
                <form action="controleur.php" method="post" class="input-comm">
                    <textarea type="text" name="contenu" class="input_text_comm" placeholder="Ajouter un commentaire"></textarea>
                    <input type="hidden" name="idFeel" value="<?php echo $id; ?>">
                    <input type="hidden" name="idAuteur" value="<?php echo $id; ?>">
                    <button type="submit" name="action" value="PublierMessage">Publier</button>
                </form>
            </div>
            </div>
        </div>
</body>
</html>
