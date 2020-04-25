<?php

 
include("header_2.php");

include("menu.php");

?>


<body style="background-image:none;background-color:black;">

<section class="first">


<?php
    $reponse = $bdd ->query('SELECT * FROM articles ORDER BY date_creation DESC LIMIT 5');    
            
while ($donnees = $reponse->fetch()) 
{ 
    $articleID = $donnees['ID'];


?>
    <article class="blog">
                
    <!--tout l'article affiché sur la page d'accueil sert de lien web vers l'article en détail -->

     <a class="blog" href="page_forum_article.php?articleID=<?php echo $articleID ; ?>">

        <?php
        echo "<h5>Ecrit par : ", $donnees['auteur'] , "</h5>";
        echo "<h4 class=\"blog\">", $donnees['title'] , "</h4>";
        echo "<p class=\"blog\">", nl2br($donnees['content']), "</p>";

                /*n12br() est une méthode qui permet de conserver les sauts de lignes, donc rajouter les <br/>
                 Sans : texte texte texte... texte
                 Avec : texte texte
                        texte...
                        texte 
                */

        echo "<p class=\"blog\">Date de création : ", $donnees['date_creation'],"</p>";
        ?>
    </article>

</a>
    
    <br/>

    <?php
}
$reponse->closeCursor(); 

?>


<p>Aller sur la page dédiée à <a href="page_forum_creation.php">la création d'articles</a>.</p>



</body>
</html>