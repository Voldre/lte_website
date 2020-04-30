<?php

 
include("header_2.php");

include("menu.php");

?>


<body style="background-image:none;background-color:black;">

<section class="first">

<?php

if (isset($_GET['articleID']))  // Si on est arrivé ici en cliquant sur un article...
{
    $_GET['articleID'] = (int) htmlspecialchars($_GET['articleID']); // Anti faille XSS, + on vérifie que c'est un nombre (un entier), sinon on le met en nombre (=0)

    echo "<p>Vous êtes sur la page de l'article  " , $_GET['articleID'], "  pour changez d'article, changer le numéro dans l'URL.</p>";

       // $requete = $bdd ->prepare('SELECT * FROM articles WHERE ID = ?');  //On prend toute la ligne de cette article
    $requete = $bdd ->prepare('SELECT * FROM articles INNER JOIN membres ON membres.ID = articles.ID_auteur WHERE articles.ID = ? ORDER BY date_creation DESC LIMIT 5');
            // On                                                      
    
        //$requete->bindValue(':id', $_GET['articleID'], PDO::PARAM_INT); 

      $requete->execute(array($_GET['articleID']));

      // Nouveauté:  très utile : COMPTER LE NOMBRE DE REQUETES ENVOYEES
      $nombre_requete=$requete->rowCount(); // Permet de compter le nombre de requete envoyé par SQL
     
      // Utile pour vérifier s'il y en a 0 

      if ($nombre_requete == 0) // Verifie si une ligne existe (donc si l'article existe)
      {     
          echo "<p class=\"red\"> Cet article n'existe pas!</p>"; // S'il n'y a pas d'article, un message d'erreur apparaît
          exit();   // et la fonction exit() arrête totalement sa lecture du programme, du coup, on coupe tout à la ligne 47 !
      }
    while ($donnees = $requete->fetch()) 
    { 
?>

<article class="blog">  
        <?php   // On affiche l'article comme sur la page d'accueil
        echo "<h5>Ecrit par : ", $donnees['pseudo'] , "</h5>";
        echo "<h4 class=\"blog\">", $donnees['title'] , "</h4>";
        echo "<p class=\"blog\">", nl2br($donnees['content']), "</p>";

        echo "<p class=\"blog\">Date de création : ", $donnees['date_creation'],"</p>";
        ?>
</article>

<?php   
    }
    $requete->closeCursor();
}
else
{
    echo "<p>Vous n'avez pas sélectionné d'article, souhaitez vous retourner sur la <a href=\"page_forum_index.php\">page d'accueil du Forum</a>?</p>";
    exit();   // La référence de l'URL ne pointe pas d'article (mauvais label) : donc FIN DE L'EXECUTION DU PROGRAMME
}

// Partie commentaire



if (!(isset($_SESSION['id']) && isset($_SESSION['pseudo'])))
{

    echo "<p>Pour conmmenter un article, vous devez vous <a href=\"page_connexion.php\">connecter</a>.</p>";
    echo "<p>Si vous n'êtes pas encore inscrit, vous pouvez le faire via <a href=\"page_inscription.php\">cette page</a>.</p>";

}
else
{
    ?>
    <p>Vous pouvez commenter cet article:</p>
    <form method="post">

    <p>Commentaire :<textarea name="content" rows="3" cols="50"></textarea></p>

    <input type="submit" value="Envoyer" />
    </form>

    <?php
    if (isset($_POST['content']))
    {
        if (strlen($_POST['content']) <= 5)
        { 
            echo "<p>Votre commentaire n'est pas valide.</p>";
                
        }
        else
        {
            // Insertion du commentaire dans la base de données.
        
            $_POST['content'] = htmlspecialchars($_POST['content']);
        

            // On oublie le nom d'auteur qui pose beaucoup de problèmes (en cas de changement de pseudo)
            // Et on passe plutôt par l'ID du membre.

            $requete_2 = $bdd ->prepare('INSERT INTO commentaires(ID_article, ID_auteur, Content, date_commentaire) VALUES (?, ?, ?, NOW() ) ');  
                                                                                            
            $requete_2 -> execute(array($_GET['articleID'],$_SESSION['id'], $_POST['content'])); // Pas oublier de récupérer l'ID de l'article où se trouve ce commentaire
                    

            echo "<p> Votre commentaire a bien été publié!</p>";
            
        $requete_2->closeCursor();
        }
    }
}



// ***************** Affichage des commentaires actuels **********************

    // Première utilisation des jointures

     $reponse = $bdd ->prepare('SELECT *, commentaires.ID_auteur , membres.pseudo , membres.ID AS ID_membre FROM commentaires LEFT JOIN membres 
     ON commentaires.ID_auteur = membres.ID
     WHERE ID_article = ? ORDER BY date_commentaire DESC LIMIT 0,10');    
     
     // On utilise les 2 tables pour pouvoir associer l'ID du membre à son pseudo et donc son image
     // On utilise donc la table commentaire pour avoir le commentaire et la table membres pour ses informations
     // commentaires.ID_auteur = membres.ID

    $reponse -> execute(array($_GET['articleID']));

while ($donnees_2 = $reponse->fetch()) 
{ 
        
?>
    <article class="blog">
        <?php
                   
    $image_profil = 'avatars/'.$donnees_2['ID_membre'].'.png'; // On utilise l'ID du membre
    if (file_exists($image_profil)) 
    {
        echo "<img class=\"imageprofil_commentaire\" src='avatars/",$donnees_2['ID_membre'],".png'>"; // On utilise l'ID du membre
    } 
    else 
    {
        echo "<p class=\"alignR\"> |X| &emsp; </p>";
    } 
        echo "<p>", $donnees_2['date_commentaire'],"</p>";
        echo "<p class=\"gras\">", $donnees_2['pseudo'], "</p>";
        echo "<p>", nl2br($donnees_2['Content']),"</p>";

        // LES MAJUSCULES COMPTENT dans la récupération des données de la BDD

        // DONC, ne JAMAIS mettre de MAJUSCULE dans les NOMS DE CHAMPS! Sinon faut faire comme ici, mettre les majuscules

        ?>
    </article>
    <br/>

    <?php
}
$reponse->closeCursor(); 

?>



</body>
</html>