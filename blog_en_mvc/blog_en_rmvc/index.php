<?php 
    // ROUTEUR

    //require('controller.php');

    // With POO
    require("controller_POO.php");

try // Manage errors
{   

    if (isset($_GET['action']))
    {
        if ($_GET['action'] == 'listPosts') {
            listPosts();
        }


        elseif ($_GET['action'] == 'post') {
            if (isset($_GET['articleID']) && $_GET['articleID'] > 0) {
                post();
            }
            else {
                throw new Exception("Vous n'avez pas sélectionné d'article.");
                //exit();   No need to exit(), because we have a try/catch block
            }
        }


        elseif ($_GET['action'] == 'addComment')
        {
            
            if (isset($_POST['content']) && isset($_POST['pseudo']))
            {
                if (strlen($_POST['content']) <= 10 || strlen($_POST['pseudo']) <= 3)
                { 
                    throw new Exception("Votre pseudo ou votre commentaire ne sont pas valides.<br/>
                    Votre pseudo doit faire au moins 4 caractères et votre commentaire plus de 10 caractères.");
                        
                }
                else
                {
                    $pseudo = htmlspecialchars($_POST['pseudo']);
                    $content = htmlspecialchars($_POST['content']);

                    if (isset($_GET['commentID'])) // If it's true, so we want to modify a comment
                    {
                        editComment();
                        echo "<p> Votre commentaire a bien été modifié!</p>";   
                    }
                    else // Else, we just add a NEW comment
                    {
                        addComment();
                        echo "<p> Votre commentaire a bien été publié!</p>";  
                    } 
                    
                    header('Location: index.php?action=post&articleID=' . $_GET['articleID']);
                }
            }
        }


        elseif ($_GET['action'] == 'modifComment')
        {
            
            if (isset($_GET['articleID']) && isset($_GET['commentID']))
            {
                modifComment();
            }
            else
            {
                throw new Exception("Vous n'avez pas sélectionné un commentaire ou une page qui existe.");
            }
        }


        else // if action = "nothing that exist"
        {
            throw new Exception("Vous n'avez pas sélectionnée une page qui existe.");
        }
    }
    else 
    {
        listPosts();
    }


}
catch (Exception $e)
{
    error($e);
    //echo "<p class=\"red\"> Erreur : " . $e->getMessage() . "</p>";
    //echo "<p>souhaitez vous retourner sur la <a href=\"index.php?action=listPosts\">page d'accueil du Forum</a>?</p>";
} 