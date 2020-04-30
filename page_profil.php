<?php

 
include("header_2.php");

include("menu.php");

?>


<body>

<section class="first">


<aside> <!--------------- Partie sur le côté, dédié à la photo de profil (avatar) --------------------->


<?php
$image_profil = 0;

if(isset($_SESSION['id']) && isset($_SESSION['pseudo']))
{
    $image_profil = 'avatars/'.$_SESSION['id'].'.png';
    if (file_exists($image_profil)) 
    {
        echo "<img class=\"imageprofil\" src='avatars/",$_SESSION['id'],".png'>";
    } 
    else 
    {
        echo "<p>Vous n'avez pas d'image de profil.</p>";
    }

    if(isset($_POST['modifier_avatar']))
    {
        ?>
        <form method="post" enctype="multipart/form-data"> <!-- enctype permet de dire au navigateur "on va envoyer un fichier" -->
        <p>
                Envoyer une image (png, jpg, jpeg, gif):<input type="file" name="monfichier" /><br />
                <input type="submit" value="Envoyer le fichier" />
        </p>
        </form>
    <?php
    }
    else //Donc si on a pas cliqué sur le bouton, on l'affiche
    {
    ?>
    <form method="post">
    <h5><input type="submit" name="modifier_avatar" value="Modifier mon avatar" /></h5>
    </form>
<?php
    }
}


    // Réception du fichier
if (isset($_FILES['monfichier']))
{
    if ($_FILES['monfichier']['size'] <= 7000000 || $_FILES['monfichier']['error'] == 0) // 7 000 000 = 7Mo
    {
            $infosfichier = pathinfo($_FILES['monfichier']['name']); // pathinfo renvoie un array contenant l'extension du fichier
            $extension_upload = $infosfichier['extension'];          // dans cette variable $infosfichier['extension']
            $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png'); // On définie un tableau d'extensions autorisées
            if (in_array($extension_upload, $extensions_autorisees))
            {  
                    // On peut valider le fichier et le stocker définitivement

                    //move_uploaded_file($_FILES['monfichier']['tmp_name'], 'avatars/' . basename($_FILES['monfichier']['name'])); 

                    //move_uploaded_file(fichier , destination/ . nom) = déplacer le fichier dans le répertoire 'uploads/fichier.extension'
                    // De ce fait, cela se résume en 1 ligne de code, qui identifie le nom du fichier stocké par défaut "$_FILES['monfichier']['tmp_name']"
                    // et décide ensuite après une virgule, de l'emplacement où sauvegarder ce fichier de façon définitive : 'emplacement/ici/' . basename() = le nom + l'extension 

                    $_FILES['monfichier']['name'] = $_SESSION['id'].".png";   //nom de fichier customiser correspondant à l'ID de l'utilisateur
                    move_uploaded_file($_FILES['monfichier']['tmp_name'], 'avatars/' . basename($_FILES['monfichier']['name'])); 

                    echo "<p>L'envoi a bien été effectué !</p>";

            }
            else
            {
                echo "<p>Pas la bonne extension de fichier, mettez des images uniquements!</p>";
                // avec un zavell working.pfi , on a bien une erreur d'extension
            }
    }
    else
    {
        echo "<p>Le fichier contient des erreurs ou il est trop volumineux :" , $_FILES['monfichier']['size'] , "</p>";
    }
}

?>

</aside>





       <!--------------- Partie dédié à l'affichage du numéro, nom et description du Profl --------------------->
<?php   
if (!(isset($_SESSION['id']) && isset($_SESSION['pseudo'])))
{

    echo "<p>Pour consulter votre profil, vous devez vous <a href=\"page_connexion.php\">connecter</a>.</p>";
    echo "<p>Si vous n'êtes pas encore inscrit, vous pouvez le faire via <a href=\"page_inscription.php\">cette page</a>.</p>";

}
else
{
    ?>


    <h3> Voici votre profil :</h3>

    <?php    

        $req = $bdd->prepare('SELECT * FROM membres WHERE pseudo = ?');
        $req->execute(array($_SESSION['pseudo']));

        $resultat = $req->fetch();

    echo "<p>N° d'identification : ", $resultat['ID'] ,"</p>"; // Majuscules importantes
    echo "<p>" , $resultat['pseudo'] , "</p>";
    echo "<p>" , $resultat['email'] , "</p> <br/> <br/>";

    echo "<p>Description de votre profil :</p>";

    if(isset($resultat['description']))
    {
        echo "<p>" ,  nl2br($resultat['description']) , "</p>"; // Rappel : n12br() permet de conserver les sauts de lignes
    }
    else
    {
        echo "<p>Vous n'avez pas encore saisie de description.</p>";
    }
    ?>
    <?php
    if(isset($_POST['modifier_description']))
    {
    ?>
        <form method="post">
        <textarea name="ma_description" rows="5" cols="45">
        Ma description
        </textarea>
        <input type="submit" value="Enregistrer ma description" />
        </form>
        <form>
        <input type="submit" value="Annuler" />
        </form>
    <?php
    }
    else //Donc si on a pas cliqué sur le bouton, on l'affiche
    {
    ?>
    <form method="post">
    <input type="submit" name="modifier_description" value="Modifier ma description" />
    </form>
    <?php
    }
    
    if(isset($_POST['ma_description']))
    {
        $_POST['ma_description'] = htmlspecialchars($_POST['ma_description']);
        
        $requete_description = $bdd ->prepare('UPDATE membres SET description = ? WHERE ID = ?  ');  
                                                                                            
        $requete_description -> execute(array($_POST['ma_description'],$resultat['ID'])); // Majuscules importantes
        echo "<p>Votre description a bien été modifiée, <a href=\"page_profil.php\">rafraîchissez la page</a> pour voir la modification.</p>";       
    }

}
?>




<p>Vous pouvez modifier vos données personnelles :</p>





       <!--------------- Partie dédié au changement de Pseudo --------------------->
       <?php   
if (isset($_SESSION['id']) && isset($_SESSION['pseudo']))
{
 


    if(isset($_POST['modifier_pseudo']))
    {
    ?>
        <form method="post">
        <p>Tapez votre nouveau pseudo :<input type="text" name="new_pseudo" /></p>
        <p>Confirmez votre nouveau pseudo :<input type="text" name="new_pseudo_2" /></p>
        <input type="submit" value="Enregistrer mon nouveau pseudo" />
        </form>
        <form>
        <input type="submit" value="Annuler" />
        </form>
    <?php
    }
    else //Donc si on a pas cliqué sur le bouton, on l'affiche
    {
    ?>
    <form method="post">
    <input type="submit" name="modifier_pseudo" value="Modifier mon pseudo" />
    </form>
    <?php
    }
    
    
    if(isset($_POST['new_pseudo']) && isset($_POST['new_pseudo_2']) ) // New Pseudo saisie
    {
        
        $_POST['new_pseudo'] = strtoupper(htmlspecialchars($_POST['new_pseudo'])); // Anti faille XSS ++ le Pseudo est toujours écrit en MAJUSCULE
        // Ce qui évite des problèmes de logins, exemple : Florian != floRIAN != FLORIAN, là, tout est identique grace au strtoupper
        $_POST['new_pseudo_2'] = strtoupper(htmlspecialchars($_POST['new_pseudo_2']));

        if ($_POST['new_pseudo'] != $_POST['new_pseudo_2'] ) // Incorrect car mal saisie
        {
            echo "<p class=\"red\">Votre nouveau pseudo saisie est différent entre les 2 champs, réessayez de nouveau.</p>";
        }
        else if(strlen($_POST['new_pseudo']) < 5) // Trop petit
        {
            echo "<p>Votre pseudo est trop petit, il doit comprendre minimum 5 caractères.</p>";
        }
        else if ($_POST['new_pseudo'] == $resultat['pseudo']) // Déja pris (on a bien vérifié 2 pseudos tous les 2 en majuscules, celui de la BDD l'est de base).
        {
            echo "<p>Ce pseudo appartient déjà à quelqu'un, saisissez-en un autre.</p>";
        }
        else // Pas pris, >= 5 carac, bien écris, présents
        {

            // LIER LES "MESSAGES ENVOYER" A UN UTILISATEUR (ID) et pas pseudo car il peut modifier son pseudo ! ! !
            // Mettre à jour le pseudo VIA l'ID de l'utilisateur


        $requete_pseudo = $bdd ->prepare('UPDATE membres SET pseudo = ? WHERE ID = ?  ');  
                                              
        $requete_pseudo -> execute(array($_POST['new_pseudo'],$resultat['ID']));   
        echo "<p id=\"IDtest\">Votre nouveau pseudo a bien été enregistré!";

        // Mettre aussi à jour son nom d'auteur dans la table des articles

        // Plus nécessaire car seul l'ID est enregisté, et grace à l'ID on retrouvera son pseudo (aka son nom d'auteur)
        
        $_SESSION['id'] = $resultat['ID'];
        $_SESSION['pseudo'] = $_POST['new_pseudo'];

        }   
    }

}
?>








       <!--------------- Partie dédié au changement de Mot De Passe --------------------->
       <?php   
if (isset($_SESSION['id']) && isset($_SESSION['pseudo']))
{
 


    if(isset($_POST['modifier_mdp']))
    {
    ?>
        <form method="post">
        <p>Tapez votre mot de passe actuel : <input type="password" name="actual_password" /></p>
        <p>Tapez votre nouveau mot de passe :<input type="password" name="new_password" /></p>
        <p>Confirmez votre nouveau MDP :<input type="password" name="new_password_2" /></p>
        <input type="submit" value="Enregistrer mon nouveau mot de passe" />
        </form>
        <form>
        <input type="submit" value="Annuler" />
        </form>
    <?php
    }
    else //Donc si on a pas cliqué sur le bouton, on l'affiche
    {
    ?>
    <form method="post">
    <input type="submit" name="modifier_mdp" value="Modifier mon mot de passe" />
    </form>
    <?php
    }
    
    if(isset($_POST['actual_password']) && isset($_POST['new_password']) && isset($_POST['new_password_2']) )
    {
        $isPasswordCorrect = password_verify($_POST['actual_password'], $resultat['mdp']); // Il faut DE-HACHER (vérifier) le mot de passe pour pouvoir comparer correctement!
                    // Renvoie TRUE or FALSE.  Si on le passe pas à la moulinette, on pourra pas vérifier s'ils sont identiques!
        
        if (!$isPasswordCorrect) // $_POST['actual_password'] != $resultat['mdp'] <=> Si $isPasswordCorrect renvoie FALSE! donc (!) 
        {
            echo "<p class=\"red\">Vous n'avez pas tapez le bon mot de passe actuel, accès refusé.</p>";
        }
        else if ($_POST['new_password'] != $_POST['new_password_2'] )
        {
            echo "<p class=\"red\">Votre nouveau mot de passe saisie est différent entre les 2 champs, réessayez de nouveau.</p>";
        }
        else if (strlen($_POST['new_password']) < 6)
        {
            echo "<p class=\"red\"> Votre mot de passe est trop court, saisissez-en un autre (6 caractères minimum)</p>";
        }
        else
        {
        $requete_mdp = $bdd ->prepare('UPDATE membres SET mdp = ? WHERE ID = ?  ');  
                                              
        
        $password_hache = password_hash($_POST['new_password'], PASSWORD_DEFAULT);


        $requete_mdp -> execute(array($password_hache,$resultat['ID']));   
        echo "<p id=\"IDtest\">Votre nouveau mot de passe a bien été enregistré!";
        }   
    }

}
?>




</section>

</body>
</html>