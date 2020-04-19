<!DOCTYPE html>
<html lang="fr">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />

    <meta charset="utf-8" />

</head>

<body>

<?php
            //L'extension PDO : c'est un outil complet qui permet d'accéder à n'importe quel type de BDD
try {
$bdd = new PDO('mysql:host=localhost;dbname=test', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)); // ACCESS DENIED = LOGIN/MDP faux  OU host=sql.hebergeur.blabla 
// Un objet (variable...) contenant la BDD, type mysql se trouvant chez moi, son nom est 'test', le login : 'root', mot de passe : ''
                                                            //array(PDO::... => ...) est Un outil pour AFFICHER mieux les erreurs
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}



             //query en français = requête
$reponse = $bdd ->query('SELECT console, nom , prix FROM jeux_video WHERE console="PC" OR console="NES" OR console="" ORDER BY prix LIMIT 5');    
                                // Si array(PDO::...) déclaré, alors on aura une erreur : "table doesn't exist" si on l'a mal écrite ici "FROM jeux_video"
// réponse = l'ensemble de la table (dans la BDD) s'appellant jeux_video, pour tels champs : console,nom,prix

                                                            // WHERE = Filtrer, genre "Si ... ou ... alors ..."
                                                                                                // ORDER BY = Trier par nom (a->z)  ou prix (0->1000)
                                                                                                // DESC = Descendant, donc Z à A ou 1000€ à 0€
                                                                                                                // LIMIT 5,10 = affiche de la 6e à la 15e entrées
                                                                                                                // a partir de 6, 10 affichages en tout
                                                                                                                // LIMIT 10,2 = affiche la 11e et la 12e
                                                                                                                // limit x = jusqu'à x valeurs maximum d'affichées
                                                                  // UTILISEZ CES MOTS CLES DANS L'ORDRE CI-DESSUS
                    // fetch en français = va chercher
while ($donnees = $reponse->fetch()) // Pour chaque ligne (donc fetch) se trouvant dans la table ($reponse), avec des données présentent (donc dans la table)
{ // alors on fait tel truc
    echo "<p>Voici le jeu ", $donnees['nom'] , " se trouvant sur la console suivante : ", $donnees['console'], ", voici son prix :" , $donnees['prix'], "</p>";
}

$reponse->closeCursor(); // Termine le traitement de la requête

?>

<p> --------- SELECT (Afficher) des données avec une requête que l'on choisit  --------- </p>

<?php
// REQUETE PREPAREE :  Permet de laisser le choix à l'utilisateur de définir certains paramètres
// Car souvent on ne connaitra pas les choix de l'utilistaeur

if (isset($_GET['nom_console']))    // Si le parametre nom_console est pas transmis dans l'URL, on effectue pas d'action (car sinon bug)
{
    $requete = $bdd ->prepare('SELECT console, nom , prix FROM jeux_video WHERE console= ? ORDER BY ? LIMIT 5');  // Nous modifierons ces "?" #marqueur grace à execute()  
                                                                                // Marqueur 1  et ici le 2
    $requete -> execute(array($_GET['nom_console'], $_GET['ordonner_par'])); // Si plusieurs marqueurs : les afficher dans l'ordre comme ici dans array()

// Utiliser les requetes avec prepare() et execute(), plutôt que concaténer dans query() la valeur $_GET['truc'] permet d'éviter une faille!
// Cette faille s'appelle "injection SQL", qui consiste à ce qu'un utilisateur écrivent une fonction SQL à la place de notre paramètre
// Ainsi, pour empêcher que l'utilisateur réalise des fonctions SQL qu'on ne désirent pas, on peut passer par les requêtes, ce qui sécurise le tout!


    while ($donnees = $requete->fetch()) // Pour chaque ligne (donc fetch) se trouvant dans la table ($reponse), avec des donnees présente(donc dans la table)
    { // alors on fait tel truc
        echo "<p>Voici le jeu ", $donnees['nom'] , " se trouvant sur la console suivante : ", $donnees['console'], ", voici son prix :" , $donnees['prix'], "</p>";
    }

$reponse->closeCursor(); // Termine le traitement de la requête

}
?>

<p> ------------ INSERER des données dans lesquelles on laisse l'utilisateur choisir -------- </p>

<?php

if (isset($_POST['nom_de_mon_jeu']) && isset($_POST['nom_du_possesseur']) && isset($_POST['prix_de_mon_jeu']))  
{
    $requete_2 = $bdd ->prepare('INSERT INTO jeux_video(nom, possesseur, prix) VALUES (?,?,?) ');  
                                                                               
    $requete_2 -> execute(array($_POST['nom_de_mon_jeu'], $_POST['nom_du_possesseur'],$_POST['prix_de_mon_jeu'])); 
    
    echo "<p>Le jeu a bien été enregistrée!</p>";
}
else 
{ // On présente un petit forumulaire pour insérer le jeu
    ?>
    <p>Aucun jeu n'a été enregistrée (ou vous n'avez pas saisie tous les champs), vous pouvez en saisir un grace à ce formulaire</p>

    <form action="page_bdd_test.php" method="post">

    <p><label>Nom du jeu :<input type="text" name="nom_de_mon_jeu" /></label></p>
    <p><label>Nom du possesseur : <input type="text" name="nom_du_possesseur" /></label></p>
    <p><label>Prix du jeu : <input type="text" name="prix_de_mon_jeu" /></label></p>

    <input type="submit" value="Enregistrer mon jeu" />
    </form>

    <?php // bien fermer la parenthèse
}
?>

<p> ------------UPDATE (mettre à jour) des données dans la table -------- </p>

<?php
if (isset($_POST['nouveau_possesseur']) && isset($_POST['numero_du_jeu']))   
{
    $requete_3 = $bdd ->prepare('UPDATE jeux_video SET possesseur = ? WHERE ID = ? ');  
                                                                               
    $requete_3 -> execute(array($_POST['nouveau_possesseur'], $_POST['numero_du_jeu'])); 
    
    echo "<p>Le nom du possesseur a bien été modifié!</p>";
}
else 
{ // On présente un petit forumulaire pour modifier un jeu
    ?>
    <p>Aucun jeu n'a été modifié (ou vous n'avez pas saisie tous les champs), vous pouvez saisir les nouveaux paramètres grace à ce formulaire</p>

    <form action="page_bdd_test.php" method="post">

    <p><label>Nom du nouveau propriétaire :<input type="text" name="nouveau_possesseur" /></label></p>
    <p><label> Pour quel numéro de jeu (ID) ? : <input type="number" name="numero_du_jeu" /></label></p>

    <input type="submit" value="Mettre à jour le Jeu" />
    </form>

    <?php // bien fermer la parenthèse
}
?>

<p> ------------DELETE des données dans la table -------- </p>

<?php
if (isset($_POST['nom_du_jeu']))   
{
    $requete_4 = $bdd ->prepare('DELETE FROM jeux_video WHERE nom = ? ');  
                                                                               
    $requete_4 -> execute(array($_POST['nom_du_jeu'])); 
    
    echo "<p>Le jeu suivant a été supprimé : ", $_POST['nom_du_jeu'], " !</p>";
}
else 
{ // On présente un petit forumulaire pour supprimer un jeu
    ?>
    <p>Aucun jeu n'a été suprimé, vous pouvez en supprimer un grace à ce formulaire</p>

    <form action="page_bdd_test.php" method="post">

    <p><label>Saisissez le nom du jeu à supprimer : <input type="texte" name="nom_du_jeu" /></label></p>

    <input type="submit" value="Supprimer le Jeu" />
    </form>

    <?php // bien fermer la parenthèse
}
?>

</body>

</html>