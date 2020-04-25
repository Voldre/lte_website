<?php // Permet d'importer la BDD présente dans le fichier create_db.sql

$bdd = new PDO('mysql:host=localhost;', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)); 
 
$sql = file_get_contents('bdd_test.sql');

$qr = $bdd->exec($sql);

//header('Location: page_accueil.php');

?>
