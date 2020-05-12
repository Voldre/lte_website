
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

    <p><a href="blog_home_controller.php">Retourner à l'accueil</a></p>

    <?= $content ?>
    
</body>
</html>