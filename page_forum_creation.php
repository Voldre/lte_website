<?php

 
include("header_2.php");

include("menu.php");

?>


<body style="background-image:none;background-color:black;">

<section class="first">

<?php   
if (!(isset($_SESSION['id']) && isset($_SESSION['pseudo'])))
{

    echo "<p>Pour créer un article, vous devez vous <a href=\"page_connexion.php\">connecter</a>.</p>";
    echo "<p>Si vous n'êtes pas encore inscrit, vous pouvez le faire via <a href=\"page_inscription.php\">cette page</a>.</p>";

}
else
{
    ?>
    <h3> Bienvenue sur la page de création d'article!</h3>

    <form action="page_forum_creation.php" method="post">

    <p><label>Insérer un titre : <input type="text" name="title" /> </label></p>

    <textarea name="content" rows="9" cols="50">
    Mon article...
    </textarea>

    <input type="submit" value="Créer l'article" />

    </form>

    <?php
    if (isset($_POST['content']) && isset($_POST['title']))
    {
        if (strlen($_POST['content']) <= 50 || strlen($_POST['title']) <= 5)
        { 
            echo "<p>Votre article doit contenir au moins 5 caractères dans le titre et 50 caractères dans son contenu.</p>";
                
        }
        else
        {
            // Insertion de l'article dans la base de données.
        
            $_POST['title'] = htmlspecialchars($_POST['title']);
            $_POST['content'] = htmlspecialchars($_POST['content']);
        
            $requete = $bdd ->prepare('INSERT INTO articles(title, content, date_creation, auteur) VALUES (?, ?, NOW(), ? ) ');  
                                                                                            
            $requete -> execute(array($_POST['title'], $_POST['content'], $_SESSION['pseudo'])); 
                    

            echo "<p> L'article \"", $_POST['title'] , "\" a bien été publié!</p>";
            ?>
            <p>Si vous souhaitez écrire un autre article, cliquez sur <a href="page_forum_creation.php">ce lien</a>. </p>
            <?php
            
        $requete->closeCursor(); // Termine le traitement de la requête
        }

    }
}
?>

<p><em>Remplissez les 2 sections pour créer un article, puis cliquez sur "Créer l'article".</em></p>


<a href="page_forum_index.php">Retournez à la page d'accueil du Forum</a>

</body>
</html>