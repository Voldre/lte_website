
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />

    <meta charset="utf-8" />
    <!-- Using short tags with PHP -->
    <title><?= $title?></title>

    <link rel="stylesheet" href="MVC_style.css" />
</head>


<body style="margin-left:6%;">
    <?php   // if we are in home_page, don't show the message to go on
    if(!isset($_GET['action']) OR $_GET['action'] != "listPosts")
    {
    ?>
    <p><a href="index.php?action=listPosts">Retourner à l'accueil</a></p>
    <?php
    }

    echo $content;
    ?>
    
</body>
</html>