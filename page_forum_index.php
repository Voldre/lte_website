<?php

 
include("header_2.php");

include("menu.php");

?>


<body style="background-image:none;background-color:black;">




<section class="first">

<?php  // Afficher des pages pour naviguer entre les articles : 5 articles par page

// Compter le nombre d'articles

$reponse_articles = $bdd ->query('SELECT COUNT(ID) AS nb_articles FROM articles');

$nb_articles = 0 ;

while ($donnees_articles = $reponse_articles->fetch())
{
    $nb_articles = $donnees_articles['nb_articles']; // On stock le nb d'articles
}
$reponse_articles->closeCursor();

$nb_pages = floor( 1 + $nb_articles / 5); // Attention, si 5 articles alors 1+1 = 2! Mais la page 2 sera vide ! ! ! (pas grave grave, mais bête)
// floor permet de faire un arrondis inférieur, donc si on a 2,6 pages, on a 2 pages
// Le "+1" permet d'en placer une obligatoire, et ensuite, si le nb_articles est > a 5, on en rajoute 1, >10 on en rajoute 2, etc...

echo "<p>Nombres de Pages: ",$nb_pages, "<br/>Nombres d'articles: ", $nb_articles,"</p>";
echo "<div class=\"blog\">";
for ($page = 1 ; $page <= $nb_pages ; $page++) 
{
    ?>
<a href=<?php echo "\"page_forum_index.php?page=",$page,"\""?>><?php echo $page;?></a>
<?php
}
?>

</span> <br /><br />
</div>
<?php
  //  $reponse = $bdd ->query('SELECT * FROM articles ORDER BY date_creation DESC LIMIT 5');    
    
  // Passons par les jointures pour récupérer la correspondance PSEUDO = Nom d'auteur quand membres.ID = articles.ID_auteur

  if (isset($_GET['page']))
  {
    $_GET['page'] = (int) htmlspecialchars($_GET['page']);

    $numero_article = 5 * ($_GET['page']-1);
    // Valeur du premier numéro d'article selon la page 

        //Si valeur fausse, on met à la page 1
        if ($numero_article < 0)
        {
            $numero_article = 0;
            $_GET['page'] = 1;
        }

        $reponse = $bdd ->query('SELECT *, articles.ID AS ID_article FROM articles INNER JOIN membres ON membres.ID = articles.ID_auteur 
        ORDER BY date_creation DESC LIMIT ' . $numero_article . ',5'); // Si le numéro de page est présent, alors on commence au numéro de l'article (5* (numero_page - 1))
        
        // IL EST HYPER IMPORTANT DE METTRE DES "." dans le code SQL pour concaténer des éléments!
        // Contrairement aux fonctions PHP, la virgule ne fonctionne pas ici!
        // En SQL, la seule concaténation autorisé c'est le "."
        
        // Donc vraiment, faut prendre l'habitude de concaténer par des "." et pas des ","

 }
else
{
     $reponse = $bdd ->query('SELECT *, articles.ID AS ID_article FROM articles INNER JOIN membres ON membres.ID = articles.ID_auteur ORDER BY date_creation DESC LIMIT 0,5');
}                                                       // Si pas de page sélectionner, on commence par défaut au 1er article (page 1 en gros)

while ($donnees = $reponse->fetch()) 
{ 
    $articleID = $donnees['ID_article'];


?>
    <article class="blog">
                
    <!--tout l'article affiché sur la page d'accueil sert de lien web vers l'article en détail -->

     <a class="blog" href="page_forum_article.php?articleID=<?php echo $articleID ; ?>">

        <?php
        echo "<h5>Ecrit par : ", $donnees['pseudo'] , "</h5>"; // Autorisé car on extrait aussi "pseudo" de la table "membres"
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