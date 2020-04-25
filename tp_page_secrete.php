
<?php 
// On démarre la session AVANT d'écrire du code HTML
session_start();

// On s'amuse à créer quelques variables de session dans $_SESSION
$_SESSION['prenom'] = 'Jean';
$_SESSION['nom'] = 'Dupont';

// On peut a présent utiliser dans cette page (et toutes les pages contenant session_start() les variables
// décrites juste en haut. Comme ceci : echo $_SESSION['prenom'];  par exemple


// La différence:  Cookie a une date de péremption ET cookie ne peut être déclaré que avant l'HTML avec setcookie
// Session n'a pas de date d'expiration (sauf quand le visiteur se déconnecte ou part), et on peut les déclarer dans le code, pas uniquement avant l'HTML

// Pour modifier un cookie existant, on refait un setcookie avec le même nom, comme setcookie('pseudo', ... )
// Comme pour POST, GET (et Session), on peut vérifier si un cookie existe avec isset($_COOKIE['mon_nom'])
// Attention, des visiteurs peuvent créer des cookies qui n'existent pas à la base, prudence!


// On crée les cookies AVANT d'écrire du code HTML.

setcookie('pseudo', 'M@teo21', time() + 365*24*3600, null, null, false, true); ?> <!-- null null false true, permet d'empêcher les risques avec la faille XSS -->
                                                                  <!-- true correspond ici à httpOnly -->

<!-- En bref, Cookie et Session sont TOUJOURS AVANT le Doctype HTML ! ! ! -->


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />

    <meta charset="utf-8" />


    <meta name="google-site-verification" content="jnkZGiCBus4HjXKu-MXbX3L5sw4EDbaZyzTMz5uGxgg" />

    <title>Page top confidentielle</title>

    <meta name="description" content="Page officiel du jeu : Les Trente Elus 1" />

    <!-- <link rel="canonical" href="https://voldre.wixsite.com/les-trente-elus" /> -->

    <meta property="og:title" content="Les trente élus 1" />
    <meta property="og:description" content="Page officiel du jeu : Les trente élus Les informations principales et tout sur le jeu ici même." />
    <meta property="og:url" content="https://les-trente-elus/les-trente-elus-1" />
    <!-- Custom url -->

    <meta property="og:site_name" content="les-trente-elus" />
    <meta property="og:type" content="website" />

    <meta name="keywords" content="elu, elus, jeu, site, trente, trentes, &amp;eacute;lu, &amp;eacute;lus" />

    <link rel="stylesheet" href="style.css" />

</head>

<body style="background-image: none"> <!-- Parce que c'est une page de test -->


    <h3 class="souligne" , classe="gras"> Page secrète de la NASA : </h3>

    <h5>Veuillez saisir le mot de passe pour afficher les informations confidentielles de la NASA.</h5>
<p> 
<?php echo "La session a enregistrée que vous vous appeliez ", $_SESSION['prenom'] , " ", $_SESSION['nom'], ", comment allez vous?"; ?>


    <form action="page_secrete.php" method="POST">

<p>Mot de passe : <label> <input type="password" name ="mypassword" /></label></p>
<p><input type="submit" value="Valider" /></p>

</form>



<?php 

if (isset($_POST['mypassword']))
{
    $_POST['mypassword'] = htmlspecialchars($_POST['mypassword']);

    if ($_POST['mypassword'] == "kangourou")
    {
        echo "Félicitation! Vous avez le bon mot de passe! Voici les informations confidentielles que la NASA ne veut pas que vous sachiez!";
        ?>
        <img src="images/gemme_wallpaper.png"/>

        <?php   // Réouverture après l'affichage de l'image par HTML
    }
    else
    {
        echo "Le mot de passe saisie est incorrect, vous ne pouvez pas accéder aux données confidentielles!";
        echo "Vous avez saisie le mot de passe suivant : " , $_POST['mypassword'];
    }
    }
else
{
    "vous n'avez pas saisie de mot de passe";
}

?>



<p>
<?php 
        // Ajout de PHP pour récupérer les données de la page test

    // IL FAUT VERIFEIR LA CREDENCE DES INFORMATIONS... AVANT d'afficher les valeurs

    if (isset($_POST['prenom']))
    {
        
echo "<h2> Voici les résultats du test du formulaire présenté sur la page_test</h2>";

        $_POST['prenom'] = (string) $_POST['prenom']; // TRANSTYPAGE : on force la valeur a devenir une chaine de caractère
        // Avec un integer, on pourrait forcer un mot à devenir un nom (utile pour les boucles for), exemple : grenouille -> 0  et 7 -> 7

    echo "<p> Bonjour " , htmlspecialchars($_POST['prenom']) , htmlspecialchars($_POST['nom']) , " comment ça va? :) </p>" ;
        // Le htmlspecialchars($_POST['prenom'])  permet d'empêcher la personne d'écrire du HTML dans les
        // formulaires, ce qui lui permettrait de pirater le site et d'obtenir des données très dangereuses
        // DONC C'est HYPER IMPORTANT. le specialchars permet de changer les "<" en &lt et ">" en &gt, par exemple


    if (isset($_POST['regime'])) // Si isset( de régime ) existe == Case cochée
        {
        echo "<p> Tu es donc végétarien " , $_POST['regime'] , "</p>" ; 
        }
    else            // Si isset( de régime ) n'existe pas == Case pas cochée
        {
        echo "<p> Tu n'es pas végétarien </p>" ; 
        }
    }

    if (isset($_POST['message']))
    {
        if (strlen($_POST['message']) <= 1)
        {
            echo "<p> Vous n'avez pas saisie de commentaire. </p>" ;
            echo strlen($_POST['message']) ;
        }
        else
        {
            echo "<p> Vous avez ecrit : <br/>" ,  htmlspecialchars($_POST['message']) , "</p>"; // Formulaire à texte, pas oublier le htmlspecialchars
        }
    }
?>

</p>


</body>

</html>