<?php

$title = 'Editer un commentaire'; 

ob_start();

        echo "<p>Vous êtes sur la page de l'article  " , $_GET['articleID'], ".</p>";

        while ($data_article = $request->fetch()) 
        { 
    ?>

    <article class="blog">  
            <?php
            echo "<h5>Ecrit par : ", $data_article['pseudo'] , "</h5>";
            echo "<h4 class=\"blog\">", $data_article['title'] , "</h4>";
            echo "<p class=\"blog\">", nl2br($data_article['content']), "</p>";

            echo "<p class=\"blog\">Date de création : ", $data_article['date_creation'],"</p>";
            ?>
    </article>

    <?php   
        }
    $request->closeCursor();

    
    echo "<p>Vous souhaitez modifier ce commentaire : </p>";

    while ($data_comments = $comment->fetch()) 
    { 
    ?>
        <article class="blog">
            <?php
            echo "<p>", $data_comments['date_commentaire'],"</p>";
            echo "<p class=\"gras\">", $data_comments['Auteur'], "</p>";
            echo "<p>", nl2br($data_comments['Content']),"</p>";
            ?>
        </article>
        <br/>


    <h4>Ecrivez le nouveau commentaire</h4>

    <form method="post" action="index.php?action=addComment&amp;articleID=<?=$_GET['articleID']?>&amp;commentID=<?=$_GET['commentID']?>">

    <p><label>Pseudo :<input type="text" name="pseudo" value="<?=$data_comments['Auteur']?>" /></label></p>

    <p>Commentaire :<textarea name="content" rows="3" cols="50"><?=$data_comments['Content']?></textarea></p>

    <input type="submit" value="Envoyer" />
    </form>

    <?php
    } // On close ici, car on a besoin de la BDD dans le formulaire
    $comment->closeCursor(); 
    
$content = ob_get_clean();

require('template.php'); ?>