
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />

    <meta charset="utf-8" />

    <!--[if lt IE 9]>
    <script
    src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- permet d'être compatible avec d'anciennes version d'Internet Explorer-->


    <title>Mini Chat</title>

    <!-- <link rel="canonical" href="https://voldre.wixsite.com/les-trente-elus" /> -->

    <meta property="og:title" content="Mini chat" />
    <meta property="og:url" content="https://les-trente-elus" />
    <!-- Custom url -->

    <meta property="og:site_name" content="les-trente-elus" />
    <meta property="og:type" content="website" />


    <link rel="stylesheet" href="style.css" />
    <!-- Methode 1 : Ajouter le code CSS3 via un fichier à part. La méthode 2 c'est de l'écrire dans l'html avec une balise <style> -->
    <!-- L'avantage de cette méthode, c'est que si on dispose de plusieurs fichiers HTML, on n'a pas à copier le code CSS dans chacun, car on a juste à faire appel à ce même fichier! -->

</head>


<body style="background-image: none">

<form action="mini_chat_post.php" method="post">

<p>Pseudo:<label><input type="text" name="pseudonyme" /></label></p>
<p>Message:
<textarea name="message" rows="8" cols="50">
...
</textarea>
</p>

<p> <label>  Afficher <input type="number" name="nb_message" /> messages.  


<input type="submit" value="envoyer" />              

<?php echo "Messages affichés : ";

if(isset($_POST['nb_message']))
{
    if($_POST['nb_message']=="")
    {
        echo "10";
    }
    else
    {
        echo $_POST['nb_message'];
    }
}
?>  

</label> </p>

</form>



<?php  

            //L'extension PDO : c'est un outil complet qui permet d'accéder à n'importe quel type de BDD
            try {
                $bdd = new PDO('mysql:host=localhost;dbname=test', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)); // ACCESS DENIED = LOGIN/MDP faux  OU host=sql.hebergeur.blabla 
                // Un objet (variable...) contenant la BDD, type mysql se trouvant chez moi, son nom est 'test', le login : 'root', mot de passe : ''
                                                                            //array(PDO::... => ...) est Un outil pour AFFICHER mieux les erreurs
                }
                catch (Exception $e)
                {
                        die('Erreur : ' . $e->getMessage());
                }
                
                


if (isset($_POST['pseudonyme']) && isset($_POST['message'])) 
{
    $_POST['pseudonyme'] = htmlspecialchars($_POST['pseudonyme']);
    $_POST['message'] = htmlspecialchars($_POST['message']);
    

    if ($_POST['pseudonyme']=="" || $_POST['message']=="")
    {
    echo "<p class=\"red\">Vous n'avez pas remplie le formulaire.</p>";
    }
    else
    {
    $requete = $bdd ->prepare('INSERT INTO mon_chat(pseudo,mon_message) VALUES (?,?) ');  
                                                                               
    $requete -> execute(array($_POST['pseudonyme'], $_POST['message'])); 
    
    echo "<p class=\"red\">Le message a bien été rajouté!</p>";
    
$requete->closeCursor(); // Termine le traitement de la requête
    }
}
else 
{ // On présente un petit forumulaire pour insérer le jeu
    ?>
    <p>Aucun message n'a été enregistrée (ou vous n'avez pas saisie tous les champs), vous pouvez en saisir un grace à ce formulaire</p>
    

<!--
    <form action="page_bdd_test.php" method="post">

    <p><label>Nom du jeu :<input type="text" name="nom_de_mon_jeu" /></label></p>
    <p><label>Nom du possesseur : <input type="text" name="nom_du_possesseur" /></label></p>
    <p><label>Prix du jeu : <input type="text" name="prix_de_mon_jeu" /></label></p>

    <input type="submit" value="Enregistrer mon jeu" />
    </form>
-->
    <?php // bien fermer la parenthèse
}






// REQUETE PREPAREE :  Permet de laisser le choix à l'utilisateur de définir certains paramètres
// Car souvent on ne connaitra pas les choix de l'utilistaeur

if(isset($_POST['nb_message']))
{
    if ($_POST['nb_message'] != "")
    {
        $_POST['nb_message'] = (int) $_POST['nb_message']; 
        // CETTE LIGNE EST OBLIGATOIRE pour que bindValue comprenne bien que $_POST['nb_message] est un INTEGER, donc qu'il le traite correctement.

        if ($_POST['nb_message'] < 1)
        {
            $_POST['nb_message'] = 1;
            echo "<p> Il est interdit d'entrer des valeurs négatives ou nulle</p>";
        }

        $reponse_2 = $bdd ->prepare('SELECT pseudo , mon_message FROM mon_chat ORDER BY ID DESC LIMIT 0, :nb_mess');  // :nb_mess = "?" avec bindValue 
                
        $reponse_2->bindValue(':nb_mess', $_POST['nb_message'], PDO::PARAM_INT); // execute() renvoie des quotes autour de la valeur, ici : LIMIT 0, '10' par exemple
        // OR, contrairement à WHERE ou autre, LIMIT n'accepte pas les quotes, donc ERROR
        // L'autre méthode que execute() c'est bindValue() qui s'écrit comme tel                              

        // Syntaxe : $var -> bindValue(':nomvariable' , $valeurvariable, PDO::PARAM_TYPE) avec :nomvariable équivalent au "?" de execute() et TYPE = type de la variable

        $reponse_2->execute();
        // Il faut finir la requete avec execute()

        while ($donnees = $reponse_2->fetch()) 
        { 
    ?>

        <p> <span id="IDtest"> <?php echo $donnees['pseudo'], ": "; ?>
        </span> <?php echo $donnees['mon_message']; ?> </p>

    <?php
        }

    $reponse_2->closeCursor(); // Termine le traitement de la requête
    }
}

if ($_POST['nb_message']=="")
{
$reponse = $bdd ->query('SELECT pseudo , mon_message FROM mon_chat ORDER BY ID DESC LIMIT 0,10');  // DESC car du plus récent au plus vieux  
        
    while ($donnees = $reponse->fetch())
    { 
    ?>

    <p> <span id="IDtest"> <?php echo $donnees['pseudo']; ?>
    </span> <?php echo " : ", $donnees['mon_message']; ?> </p>

    <?php
    }
    
$reponse->closeCursor(); // Termine le traitement de la requête
}
?>

</body>
</html>