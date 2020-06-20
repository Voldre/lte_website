<!DOCTYPE html>
<html lang="fr">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />

    <meta charset="utf-8" />
    <!-- Using short tags with PHP -->
    <title>Convertisseur PHP - UML</title>

    <link rel="stylesheet" href="style.css" />
</head>


<body style="margin-left:6%;">

<form method="POST" enctype="multipart/form-data">

<?php

for ($i = 0; $i < 6; $i++)
{
?>
    <input type="file" name="monfichier<?php echo $i; ?>"/><br/>
<?php
}          // création des fichiers "monfichier0.php" etc...
?>
    <input type="submit" value="Envoyer ma classe"/>
</form>


<section>
<?php 
//require_once('index1.php");
require_once('indexPOO.php');
?>
</section>

</body>
</html>