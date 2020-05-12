<?php

require('blog_model.php');

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

function error($e)
{
    require("blog_error_view.php");
}