<?php
// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['idUser'])) {
    header("Location:../index.php?view=messages");
    die("");
}

include_once("libs/modele.php"); // listes
include_once("libs/maLibUtils.php"); // tprint
include_once("libs/maLibForms.php"); // mkTable, mkLiens, mkSelect ...

$conversations = listerConversations($_SESSION['idUser']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
	<link rel="stylesheet" href="css/page.css">
    <title>Conversations du site</title>

    <script>
        function toggleMessages(conversationId) {
            // Masquer tous les conteneurs de messages
            var messageContainers = document.getElementsByClassName('message-container');
            for (var i = 0; i < messageContainers.length; i++) {
                messageContainers[i].style.display = 'none';
            }

            // Afficher le conteneur de messages sélectionné
            var selectedContainer = document.getElementById('messages-' + conversationId);
            if (selectedContainer) {
                selectedContainer.style.display = 'block';
                document.getElementsByClassName('message-form')[0].style.display = 'flex';
                updateFormConversationId(conversationId); // Mettre à jour l'idConv du formulaire
                scrollToBottom(selectedContainer); // Faire défiler vers le bas
            }
        }

        function updateFormConversationId(conversationId) {
            var form = document.getElementById('messageForm');
            form.elements['idConv'].value = conversationId;
        }

        function scrollToBottom(container) {
            container.scrollTop = container.scrollHeight;
        }

        // Afficher le premier conteneur de messages par défaut
        window.onload = function() {
            var firstContainer = document.getElementsByClassName('message-container')[0];
            if (firstContainer) {
                firstContainer.style.display = 'block';
                document.getElementsByClassName('message-form')[0].style.display = 'flex';
                var firstConversationId = firstContainer.id.split('-')[1];
                updateFormConversationId(firstConversationId); // Mettre à jour l'idConv du formulaire avec le premier id
                scrollToBottom(firstContainer); // Faire défiler vers le bas
            }
        }
    </script>
</head>
<body>

<div class="container">
    <div class="conversations">
        <div class="titre-conversation">
            <h3>Conversations du site</h3>
        </div>
        <?php
        // Lister les conversations actives sous forme de liens
        if ($conversations) {
            echo "<ul>";
            foreach ($conversations as $conversation) {
                $id = $conversation['Id'];
                $theme = $conversation['Theme'];
                $User1 = listerUser1Conv($id);
                $User2 = listerUser2Conv($id);

                if ($User1 == $_SESSION['idUser']) {
                    $User = $User2;
                    $UserAutre = NomUser($User);
                } else {
                    $User = $User1;
                    $UserAutre = NomUser($User);
                }
                echo '<div class="div-conversation">';
                echo "<a href='#' class=\"nom-conversation\" onclick='toggleMessages($id)'>$theme</a>";
                echo "<p class=\"user-conversation\">Conversation avec : $UserAutre</p>";
                echo '</div>';
            }
            echo "</ul>";
        } else {
            echo "Aucune conversation active.";
        }
        ?>
    </div>

    <div class="messages">
        <?php
        // Préparer les conteneurs de messages pour chaque conversation
        if ($conversations) {
            foreach ($conversations as $conversation) {
                $id = $conversation['Id'];
                echo "<div id='messages-$id' class='message-container'>";
                $messages = listerMessages($id, $format = "asso");
                if ($messages) {
                    foreach ($messages as $message) {
                        if ($message['idAuteur'] == $_SESSION['idUser']) {
                            $auteur = $message['auteur'];
                            $contenu = $message['contenu'];
                            echo "<div class='comment-feed'>";
                            echo "<p><strong>$auteur</strong></p>";
                            echo "<p>$contenu</p>";
                            echo "</div>";
                        } else {
                            $idConv = $message['IdConv'];
                            $auteur = $message['auteur'];
                            $contenu = $message['contenu'];
                            echo "<div class='message'>";
                            echo "<p><strong>$auteur</strong></p>";
                            echo "<p>$contenu</p>";
                            echo "</div>";
                        }
                    }
                } else {
                    echo "Aucun message pour cette conversation.";
                }
                echo "</div>";
            }
        }
        ?>
        <form action="controleur.php" method="post" class="message-form" id="messageForm">
            <?php 
            $id = $idConv; 
            $idAuteur = $_SESSION['idUser']; 
            ?>
            <input type="hidden" name="idConv" value="<?php echo $id; ?>">
            <input type="hidden" name="idAuteur" value="<?php echo $idAuteur; ?>">
            <input type="text" name="messagesU" value="">
            <button type="submit" name="action" value="EnvoyerMessage">Envoyer le message</button>
        </form>
    </div>
</div>

</body>
</html>
