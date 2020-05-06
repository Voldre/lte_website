<?php // require better than include in this case

require("blog_model.php");

$stats = DB_stats();
$answer = DB_articles_home();

require("blog_home_view.php");

// Don't close the PHP Tag