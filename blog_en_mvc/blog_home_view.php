
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />

    <meta charset="utf-8" />

    <title>blog_accueil</title>

    <link rel="stylesheet" href="MVC_style.css" />
</head>

<body>

<p> Mes statistiques :</p>

<?php         

while ($data_stats = $stats->fetch()) 
{ 
    echo "<p>Nombre de messages dans le ", $data_stats['ID_article'], "eme article  :  ", $data_stats['nombre_commentaires'], " commentaires.</p>";
}
$stats->closeCursor();



while ($data_answer = $answer->fetch()) 
{ 
    $articleID = $data_answer['ID'];
?>

    <article class="blog">
                
         <a class="blog" href="blog_article_controller.php?articleID=<?php echo $articleID ; ?>">
            
        <?php
            echo "<h4 class=\"blog\">", $data_answer['title'] , "</h4>";
            echo "<p class=\"blog\">", nl2br($data_answer['content']), "</p>";
            
            
            echo "<p class=\"blog\">", $data_answer['date_creation'],"</p>";
        ?>
    </article>
        </a>       
    <br/>

<?php
}
$answer->closeCursor(); 
?>


<p>Aller sur la page dédiée à <a href="blog_formulaire_creation.php">la création d'articles</a>.</p>



</body>
</html>