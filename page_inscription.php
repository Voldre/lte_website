
<?php

 
include("header_2.php");

include("menu.php");

?>

<body>
    <section class="first">

    <?php


if (isset($_POST['pseudo']) && isset($_POST['password']) && isset($_POST['password_2']) && isset($_POST['email']))
{
    // Anti faille XSS et anti erreur en mettant le pseudo en MAJUSCULE
    $_POST['pseudo'] = strtoupper(htmlspecialchars($_POST['pseudo'])); 

                // Verification des pseudos enregistrés dans la BDD ...

    $requete_pseudo = $bdd ->query('SELECT pseudo, email FROM membres');    
               
    while ($donnees = $requete_pseudo->fetch()) 
{
    if(  strtoupper($donnees['pseudo']) == $_POST['pseudo'] ) // Si pseudo enregistrés = pseudo choisis
    {       //str to upper = mettre en majuscule, cela évite de saisir 2 pseudos identiques comme "Florian" et "florian", ou encore "floRIan"
                // Car l'on compare 2 pseudos étant tous deux en majuscules complètes

        echo "<p class=\"red\">Ce pseudo existe déjà, veuillez en choisir un autre</p>";
        $_POST['pseudo'] = "X"; // Le pseudo étant changé par "X", il devient inférieur à 5 lettres, donc la table ne l'enregistrera pas.
        //  De plus, il ne dira pas que le pseudo est trop court, car le message "trop court" s'affiche uniquement si pseudo < 5 et s'il est différent de "X"
    }
    if( $donnees['email'] == $_POST['email'] ) // Si pseudo enregistrés = pseudo choisis
    {       //str to upper = mettre en majuscule, cela évite de saisir 2 pseudos identiques comme "Florian" et "florian", ou encore "floRIan"
                // Car l'on compare 2 pseudos étant tous deux en majuscules complètes

        echo "<p class=\"red\">Un compte existe déjà avec cet email, souhaitez-vous vous <a href=\"page_connexion.php\">connecter</a>?</p>";
        $_POST['email'] = "X"; // L'email étant changé par "X", il ne respecte plus l'expression régulière et est donc invalide.
        
    }
}

$requete_pseudo->closeCursor(); // Termine le traitement de la requête



    // Si tout est bon, on insère les données dans la Table
    if (strlen($_POST['pseudo']) >= 5 && strlen($_POST['password'])>= 6 && $_POST['password'] == $_POST['password_2'] && preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['email']) )
    {
        //$_POST['email'] = htmlspecialchars$_POST['email']); Pas nécessaire car on a vérifié l'expression régulière
        
        // Hachage du mot de passe
        $password_hache = password_hash($_POST['password'], PASSWORD_DEFAULT);


        $requete = $bdd ->prepare('INSERT INTO membres(pseudo, mdp, email, date_inscription) VALUES (?,?,?, NOW()) ');  
                                                                                       
        $requete -> execute(array($_POST['pseudo'], $password_hache ,$_POST['email'])); 
                        //Pseudo toujours inséré en MAJUSCULE

        echo "<p>Votre inscription a bien été réalisé!</p>";

        echo "<p><a href=\"page_connexion.php\">Cliquez ici pour vous connecter...</a></p>";

    }
    else
    {
        echo "<h5>Bienvenue sur la page d'inscription, saisissez les différents champs et cliquez sur le bouton \"Valider\" une fois terminée.</h5>";

        if(strlen($_POST['pseudo']) < 5 && $_POST['pseudo'] != "X") // X est la valeur mise par défaut quand le pseudo choisit existe déjà
        {
        echo "<p class=\"red\"> Votre pseudo est trop court, saisissez-en un autre (5 caractères minimum)</p>";
        }
        if(strlen($_POST['password']) < 6)
        {
        echo "<p class=\"red\"> Votre mot de passe est trop court, saisissez-en un autre (6 caractères minimum)</p>";
        }
        if(strlen($_POST['password'])>= 6 && $_POST['password'] != $_POST['password_2'])
        {
        echo "<p class=\"red\"> Vous n'avez pas saisie 2 fois le même mot de passe, veuillez recommencer (6 caractères minimums)";
        }

        if(!(preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['email'])))
        {
            echo "<p class=\"red\"> L'adresse mail saisie est invalide";
        }
        ?>

    <form method="post">

    <p>Pseudo            :<input type="texte" name="pseudo" /></p>
    <p>Mot de passe      :<input type="password" name="password" /></p>
    <p>Retapez votre MDP :<input type="password" name="password_2" /></p>
    <p>Adresse Email :<input type="texte" name="email" /></p>

    <p> Votre pseudo doit faire plus de 5 caractères, et votre mot de passe plus de 6 caracteres </p>

    <input type="submit" value="Valider"/>
        <?php
    }
}
else
{
?>
    <h5>Bienvenue sur la page d'inscription, saisissez les différents champs et cliquez sur le bouton "Valider" une fois terminée.</h5>

    <form method="post">

    <p><label>Pseudo :&emsp;&emsp; &emsp; &emsp;&emsp; <input type="texte" name="pseudo" /></label></p>
    <p><label>Mot de passe : &emsp; &emsp; <input type="password" name="password" /></label></p>
    <p><label>Retapez votre MDP : <input type="password" name="password_2" /></label></p>
    <p><label>Adresse Email :&emsp; &emsp; <input type="texte" name="email" /></label></p>

    <p> Votre pseudo doit faire plus de 5 caractères, et votre mot de passe plus de 6 caracteres </p>

    <input type="submit" value="Valider"/>

<?php
}
?>

</section>

</body>
</html>