<?php

// Chargement des classes
require_once('Manager.php'); // Need the abstract class
require_once('PostManager.php');
require_once('CommentManager.php');


// To don't repeat $postManager = new \Voldre\Blog\Model\PostManager() ; It's too long

use \Voldre\Blog\Model\PostManager;
use \Voldre\Blog\Model\CommentManager;

// No need to use \Voldre\...\Manager, because we can't instantiate from it (abstract class)


function listPosts()
{
    $postManager = new PostManager(); // Création d'un objet
    $answer = $postManager->DB_articles_home(); // Appel d'une fonction de cet objet
    $stats = $postManager->DB_stats();

    require('blog_home_view.php');
}

function post()
{
    $postManager = new PostManager();
    $commentManager = new CommentManager();

    $request = $postManager->DB_show_article($_GET['articleID']);
    $answer_comments = $commentManager->DB_show_comments($_GET['articleID']);

    require('blog_article_view.php');
}

function addComment()
{
    $commentManager = new CommentManager();
                        
    $commentManager->DB_insert_comment($_POST['pseudo'],$_GET['articleID'], $_POST['content']);
    // No view for this function !
}

function modifComment()
{
    $postManager = new PostManager();
    $commentManager = new CommentManager();

    $request = $postManager->DB_show_article($_GET['articleID']);

    $comment = $commentManager->DB_show_comment($_GET['commentID']);

    require('blog_modif_comment_view.php');
}

function editComment()
{
        
    $commentManager = new CommentManager();
    $commentManager->DB_edit_comment($_POST['pseudo'],$_POST['content'],$_GET['commentID']);  

}

function error($e) // No need to insert an alone function in a Class
{
    require("blog_error_view.php");
}



/* Compare with the normal controller.php

function listPosts()
{
    
    $stats = DB_stats();
    $answer = DB_articles_home();

    require('blog_home_view.php');
}

function post()
{
    $request = DB_show_article($_GET['articleID']);
    $answer_comments = DB_show_comments($_GET['articleID']);

    require('blog_article_view.php');
}

*/