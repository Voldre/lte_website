<?php // require better than include in this case

require("blog_model.php");



if (isset($_GET['articleID']))  // Si on est arrivé ici en cliquant sur un article...

{
    $articleID = (int) htmlspecialchars($_GET['articleID']); // This line must be in the controller, because we must work on the DB 

    $request = DB_show_article($articleID); // The request is execute only if $_GET['articleID'] exist
    
    $answer_comments = DB_show_comments($articleID);

    require("blog_article_view.php");
}
else
{
    echo "<p>Vous n'avez pas sélectionné d'article, souhaitez vous retourner sur la <a href=\"blog_home_controller.php\">page d'accueil du Forum</a>?</p>";
    exit();   
}


// Où dois-je placer le code qui permet d'ajouter des commentaires? Ce n'est ni un visuel, ni une conduite à suivre?
// Est-ce plutôt à placer dans le modèle? Car la fonction réalise la condition + l'insertion + le message de confirmation?

// Dans ce cas là, le controller n'aurait qu'une ligne : DB_insert_comments(....);  car tout le reste est dans le modèle.

if (isset($_POST['content']) && isset($_POST['pseudo']))
{
    if (strlen($_POST['content']) <= 10 || strlen($_POST['pseudo']) <= 3)
    { 
        echo "<p>Votre pseudo ou votre commentaire n'est pas valide.</p>";
            
    }
    else
    {
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $content = htmlspecialchars($_POST['content']);

        DB_insert_comment($pseudo,$articleID,$content);

        echo "<p> Votre commentaire a bien été publié!</p>";   
    }
}

// Don't close the PHP Tag