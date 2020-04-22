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

    <title>blog_formulaire_creation</title>

    <link rel="stylesheet" href="style.css" />
</head>

<body>

<h3> Bienvenue sur la page de création d'article!</h3>

<form action="blog_formulaire_creation.php" method="post">

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
    
        $requete = $bdd ->prepare('INSERT INTO articles(title, content, date_creation) VALUES (?, ?, NOW() ) ');  
                                                                                        
        $requete -> execute(array($_POST['title'], $_POST['content'])); 
                

        echo "<p> L'article \"", $_POST['title'] , "\" a bien été publié!</p>";
        ?>
        <p>Si vous souhaitez écrire un autre article, cliquez sur <a href="blog_formulaire_creation.php">ce lien</a>. </p>
        <?php
        
    $requete->closeCursor(); // Termine le traitement de la requête
    }

}
?>

<p><em>Remplissez les 2 sections pour créer un article, puis cliquez sur "Créer l'article".</em></p>


<a href="blog_accueil.php">Retournez à la page d'accueil</a>

</body>
</html>