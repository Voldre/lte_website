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

<h3 class="souligne">Convertisseur PHP à UML</h3>

<p> Insérez vos différents fichiers PHP contenant chacun une classe, et transformez-les en un diagramme UML en quelques clics!</p>

Guide d'utilisation :<br/>
- Chaque fichier doit contenir impérativement <span class="red">une seule classe</span>, rien d'autre, cette classe doit avoir <span class="red">le même nom que le fichier PHP</span>.<br/>
- Pour les implémentations et l'héritage, vous devez <span class="red">ajouter en premier les classes mères</span>.<br/>
     - - - - > Exemple : La classe "Magicien" hérite de la classe "Personnage", je vais donc ajouter le fichier "Personnage.php" puis "Magicien.php".
<br/><br/>

<?php

for ($i = 0; $i < 6; $i++)
{
?>
    <input type="file" name="monfichier<?php echo $i; ?>"/><br/>
<?php
}          // création des fichiers "monfichier0.php" etc...
?>
    <input class="test" type="submit" value="Envoyer mes classes"/>
</form>


<section>
<?php 
//require_once('index1.php");
require_once('indexPOO.php');
?>
</section>

</body>
</html>