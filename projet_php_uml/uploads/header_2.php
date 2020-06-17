<?php
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=test', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)); // ACCESS DENIED = LOGIN/MDP faux  OU host=sql.hebergeur.blabla 
        // Un objet (variable...) contenant la BDD, type mysql se trouvant chez moi, son nom est 'test', le login : 'root', mot de passe : ''
                                                                    //array(PDO::... => ...) est Un outil pour AFFICHER mieux les erreurs
        }
        catch (Exception $e)
        {
        //die('Erreur : ' . $e->getMessage());
            
        header('Location: page_accueil.php'); // On retourne à l'écran d'accueil si la BDD n'est pas créé
        
        }  



    session_start();    // Toujours en premier

$monfichier = fopen('compteur.txt', 'r+');


$pages_vues = fgets($monfichier); 
$pages_vues += 1; 

fseek($monfichier, 0); 

fputs($monfichier, $pages_vues);

fclose($monfichier);
   

?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />

    <meta charset="utf-8" />

    <title>Site de Les Trente Elus</title>

    <link rel="stylesheet" href="style.css" />
</head>

<body>
<header>
<p><a href="page_accueil.php">Retourner à la page d'accueil</a></p>
</header>