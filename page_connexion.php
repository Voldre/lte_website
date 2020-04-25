
<?php

 
include("header_2.php");

include("menu.php");

?>


<body>

<section class="first">
<?php
   if (isset($_SESSION['id']) && isset($_SESSION['pseudo']))
        {
            echo "<h5>Vous êtes connecté en tant que : " , strtolower($_SESSION['pseudo']) , " .</h5>";

            echo"<p><a href=\"page_profil.php\">Cliquez ici pour consulter votre profil</a>";

            echo"<p><a href=\"page_deconnexion.php\" class=\"red\">Cliquez ici pour vous déconnecter</a>";
        }
 else
{
    ?>
<h5>Bienvenue sur la page de connexion, saisissez les différents champs pour vous connecter.</h5>

<form action="page_connexion.php" method="post">

<p><label>Identifiant :<input type="texte" name="pseudo" /></label></p>
<p><label>Mot de passe :<input type="password" name="password" /></label></p>

<input type="submit" value="Se connecter"/>

<?php

if(isset($_POST['pseudo']) && isset($_POST['password']))
    {
        //  Récupération de l'utilisateur et de son mot de passe hashé
    
    
        $_POST['pseudo'] = strtoupper($_POST['pseudo']); // Comme la table a enregistrés les pseudos en MAJUSCULE, ceci empeche les erreurs de saisies (avec les majuscules)
    
        $req = $bdd->prepare('SELECT id, mdp FROM membres WHERE pseudo = ?');
        $req->execute(array($_POST['pseudo']));
    
        $resultat = $req->fetch();
    
        // Comparaison du mot de passe envoyé via le formulaire avec la base
        $isPasswordCorrect = password_verify($_POST['password'], $resultat['mdp']);
    
        if (!$resultat) // Mauvais identifiant, car fetch() ne retourne aucune valeur, donc pas de mot de passe renvoyé par la table
        {
            echo "<p class=\"red\">Mauvais identifiant ou mot de passe !</p>";
        }
        else
        {
            if ($isPasswordCorrect) { // TRUE, car il est égale au password haché, voir plus haut
                $_SESSION['id'] = $resultat['id'];
                $_SESSION['pseudo'] = $_POST['pseudo'];
                
            header('Location: page_connexion.php');

            }
            else {
                echo "<p class=\"red\">Mauvais identifiant ou mot de passe (ici, mdp) !</p>"; // Mauvais MDP, mais on reste vague pour pas donner d'indices aux usurpateurs
            }
        }
    }
}

?>
</section>

</body>
</html>