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

<p><a href="blog_accueil.php">Retourner à l'accueil</a></p>
<?php

if (isset($_GET['articleID']))  // Si on est arrivé ici en cliquant sur un article...
{
    $_GET['articleID'] = (int) htmlspecialchars($_GET['articleID']); // Anti faille XSS, + on vérifie que c'est un nombre (un entier), sinon on le met en nombre (=0)

    echo "<p>Vous êtes sur la page de l'article  " , $_GET['articleID'], "  pour changez d'article, changer le numéro dans l'URL</p>";

        $requete = $bdd ->prepare(' SELECT * FROM articles WHERE ID = ?');  //On prend toute la ligne de cette article
                                                                               
        //$requete->bindValue(':id', $_GET['articleID'], PDO::PARAM_INT); 

      $requete->execute(array($_GET['articleID']));

      if ($requete->fetch() == 0) // Verifie si une ligne existe (donc si l'article existe)
      {     
          echo "<p class=\"red\"> Cet article n'existe pas!</p>"; // S'il n'y a pas d'article, un message d'erreur apparaît
          exit();   // et la fonction exit() arrête totalement sa lecture du programme, du coup, on coupe tout à la ligne 47 !
      }
    while ($donnees = $requete->fetch()) 
    { 
?>

<article class="blog">  
        <?php   // On affiche l'article comme sur la page d'accueil
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

<?php   
    }
    $requete->closeCursor();
}
else
{
    echo "<p>Vous n'avez pas sélectionné d'article, souhaitez vous retourner sur la <a href=\"blog_accueil.php\">page principale</a>?</p>";
    exit();   // La référence de l'URL ne pointe pas d'article (mauvais label) : donc FIN DE L'EXECUTION DU PROGRAMME
}

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
if (isset($_POST['content']) && isset($_POST['pseudo']))
{
    if (strlen($_POST['content']) <= 5 || strlen($_POST['pseudo']) <= 3)
    { 
        echo "<p>Votre pseudo ou votre commentaire n'est pas valide.</p>";
            
    }
    else
    {
        // Insertion du commentaire dans la base de données.
    
        $_POST['pseudo'] = htmlspecialchars($_POST['pseudo']);
        $_POST['content'] = htmlspecialchars($_POST['content']);
    
        $requete_2 = $bdd ->prepare('INSERT INTO commentaires(Auteur, ID_article, Content, date_commentaire) VALUES (?, ?, ?, NOW() ) ');  
                                                                                        
        $requete_2 -> execute(array($_POST['pseudo'],$_GET['articleID'], $_POST['content'])); // Pas oublier de récupérer l'ID de l'article où se trouve ce commentaire
                

        echo "<p> Votre commentaire a bien été publié!</p>";
        
    $requete_2->closeCursor();
    }
}

// ***************** Affichage des commentaires actuels **********************

    $reponse = $bdd ->prepare('SELECT * FROM commentaires WHERE ID_article = ? ORDER BY date_commentaire DESC LIMIT 0,10');    
                                                            // WHERE PUIIIIIS ORDER BY, PAS L'INVERSE ! ! ! ! !

    // dans le SELECT on peut mettre : DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM billets ORDER BY date_creation
    // Genre : SELECT id, titre, contenu, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM ....
        // Ainsi on récupère une variable date_creation_fr qui permet d'avoir un format de date personnalisée 

    $reponse -> execute(array($_GET['articleID']));

while ($donnees = $reponse->fetch()) 
{ 
    
?>
    <article class="blog">
        <?php
                
        echo "<p>", $donnees['date_commentaire'],"</p>";
        echo "<p class=\"gras\">", $donnees['Auteur'], "</p>";
        echo "<p>", nl2br($donnees['Content']),"</p>";

        // LES MAJUSCULES COMPTENT dans la récupération des données de la BDD

        // DONC, ne JAMAIS mettre de MAJUSCULE dans les NOMS DE CHAMPS!

        ?>
    </article>
    <br/>

    <?php
}
$reponse->closeCursor(); 

?>



</body>
</html>