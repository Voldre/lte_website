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

<input type="file" name="monfichier"/>
<input type="submit" value="Envoyer ma classe"/>
</form>

<section class="gauche">
<?php
require_once("index1.php");
?>
</section>
<section class="droite">
<?php
require_once("indexPOO.php");
?>
</section>