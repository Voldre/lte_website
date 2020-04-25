<?php 
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=test', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)); // ACCESS DENIED = LOGIN/MDP faux  OU host=sql.hebergeur.blabla 
        // Un objet (variable...) contenant la BDD, type mysql se trouvant chez moi, son nom est 'test', le login : 'root', mot de passe : ''
                                                                    //array(PDO::... => ...) est Un outil pour AFFICHER mieux les erreurs
        }
        catch (Exception $e)
        {
                die('Erreur : ' . $e->getMessage());
        }  
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />

    <meta charset="utf-8" />

    <title>blog_accueil</title>

    <link rel="stylesheet" href="style.css" />
</head>

<body>

<?php

include("header.php");

?>

<p> Mes statistiques :</p>

<?php

$stats = $bdd ->query('SELECT ID, ID_article, COUNT(ID_article) AS nombre_commentaires, Content  FROM commentaires GROUP BY ID_article ');
         
while ($donnees = $stats->fetch()) 
{ 
    echo "<p>Nombre de messages dans le ", $donnees['ID_article'], "eme article  :  ", $donnees['nombre_commentaires'], " commentaires.</p>";
}

$stats->closeCursor();

?>

<?php
    $reponse = $bdd ->query('SELECT * FROM articles ORDER BY date_creation DESC LIMIT 5');    
            
while ($donnees = $reponse->fetch()) 
{ 
    $articleID = $donnees['ID'];


?>
    <article class="blog">
                
    <!--tout l'article affiché sur la page d'accueil sert de lien web vers l'article en détail -->

     <a class="blog" href="blog_article_commentaires.php?articleID=<?php echo $articleID ; ?>">

        <?php
        echo "<h4 class=\"blog\">", $donnees['title'] , "</h4>";
        echo "<p class=\"blog\">", nl2br($donnees['content']), "</p>";

                /*n12br() est une méthode qui permet de conserver les sauts de lignes, donc rajouter les <br/>
                 Sans : texte texte texte... texte
                 Avec : texte texte
                        texte...
                        texte 
                */

        echo "<p class=\"blog\">", $donnees['date_creation'],"</p>";
        ?>
    </article>

</a>
    
    <br/>

    <?php
}
$reponse->closeCursor(); 

?>


<p>Aller sur la page dédiée à <a href="blog_formulaire_creation.php">la création d'articles</a>.</p>



</body>
</html>