
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />

    <meta charset="utf-8" />

    <title>blog_accueil</title>

    <link rel="stylesheet" href="MVC_style.css" />
</head>


<body style="margin-left:6%;">

    <p><a href="blog_home_controller.php">Retourner à l'accueil</a></p>
    <?php

        echo "<p>Vous êtes sur la page de l'article  " , $_GET['articleID'], "  pour changer d'article, changer le numéro dans l'URL.</p>";


        $request_number = $request->rowCount();

        if ($request_number == 0) 
        {     
            echo "<p class=\"red\"> Cet article n'existe pas!</p>";
            exit(); 
        }

        while ($data_article = $request->fetch()) 
        { 
    ?>

    <article class="blog">  
            <?php   // On affiche l'article comme sur la page d'accueil
            echo "<h5>Ecrit par : ", $data_article['pseudo'] , "</h5>";
            echo "<h4 class=\"blog\">", $data_article['title'] , "</h4>";
            echo "<p class=\"blog\">", nl2br($data_article['content']), "</p>";

            echo "<p class=\"blog\">Date de création : ", $data_article['date_creation'],"</p>";
            ?>
    </article>

    <?php   
        }
    $request->closeCursor();




    // Partie commentaire
    ?>
    <p>Vous pouvez commenter cet article:</p>
    <form method="post">
    <p><label>Pseudo :<input type="text" name="pseudo" /></label></p>

    <p>Commentaire :<textarea name="content" rows="3" cols="50">

    </textarea></p>

    <input type="submit" value="Envoyer" />
    </form>




    <?php
    while ($data_comments = $answer_comments->fetch()) 
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

    <?php
    }
    $answer_comments->closeCursor(); 
    ?>

</body>
</html>