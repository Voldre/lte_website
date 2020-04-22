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

$requete->closeCursor(); // Termine le traitement de la requête

}
?>

<p> ------------ INSERER des données dans lesquelles on laisse l'utilisateur choisir -------- </p>

<?php
    //Je viens d'ajouter une colonne date_ajout, et ajouter un jeu met automatiquement la date actuelle, on voit bien date_ajout ...VALUES(?,?,?,NOW()) en Ligne 83
if (isset($_POST['nom_de_mon_jeu']) && isset($_POST['nom_du_possesseur']) && isset($_POST['prix_de_mon_jeu']))  
{
    $requete_2 = $bdd ->prepare('INSERT INTO jeux_video(nom, possesseur, prix, date_ajout) VALUES (?,?,?, NOW()) ');  
                                                                               
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
          <!-- Je viens d'ajouter une colonne date_ajout, et mettre à jour un jeu met automatiquement la date actuelle, on voit bien date_ajout=NOW() en Ligne 112-->
<?php
if (isset($_POST['nouveau_possesseur']) && isset($_POST['numero_du_jeu']))   
{
    $requete_3 = $bdd ->prepare('UPDATE jeux_video SET possesseur = ? , date_ajout=NOW() WHERE ID = ? ');  
                                                                               
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


// FONCTIONS SQL


// ('SELECT UPPER(nom) AS nom_majuscule , console, prix FROM jeux_video WHERE ... )

// echo "<p>" , $VariableDuWhile['nom_majuscule'], </p> ;

//          LOWER           minuscule
//          LENGHT          longueur (en chiffres) de la chaîne


// ***********************************
    // L'intérêt c'est que le AS attribue un nom à cette donnée transformée par une fonction
    // Ce qui rend son utilisation BEAUCOUP plus clair, comme le nom de l'alias ci-dessous
// **********************************
 /*   
    $requete_5 = $bdd ->query('SELECT AVG(prix) AS prix_moyen_jeu_pc FROM jeux_video WHERE console="PC"');

    while ($donnees = $requete_5->fetch()) 
    { 
        echo "<p>Le prix moyen des jeux sur PC vaut : ", $donnees['prix_moyen_jeu_pc'] , "€";
    } */

$requete_5 = $bdd ->query('SELECT ROUND(AVG(prix),3) AS prix_moyen_jeu_pc FROM jeux_video WHERE console="PC"');
                            // On peut coller 2 fonctions comme ceci
                            // Ici on arrondis au millième la valeur de la moyenne, car on a mis ROUND(x,3), 3 après la virgule

while ($donnees = $requete_5->fetch()) 
{ 
    echo "<p>Le prix moyen des jeux sur PC vaut : ", $donnees['prix_moyen_jeu_pc'] , "€";
}



$requete_5_bis = $bdd ->query('SELECT SUM(prix) AS prix_total FROM jeux_video');

while ($donnees = $requete_5_bis->fetch()) 
{ 
    echo "<p>Le prix total des jeux est de : ", $donnees['prix_total'] , "€";
}





$requete_6 = $bdd ->query('SELECT SUM(prix) AS prix_total_jeu_xbox FROM jeux_video WHERE console="XBOX"');

while ($donnees = $requete_6->fetch()) 
{ 
    echo "<p>Le prix total des jeux sur XBOX est de : ", $donnees['prix_total_jeu_xbox'] , "€. Requête n°6 : utilisation du WHERE, et pas de group by console.";
}

// SELECT MAX(prix) AS jeu_le_plus_cher

// SELECT MIN(prix) ... 

// SELECT COUNT(*) FROM jeux_video  // <=> "combien y a t'il de jeu dans la liste?
// SELECT COUNT(*) FROM jeux_video WHERE console="PC" OR console="PS2" // <=> combien y a t'il de jeu de PC et/ou PS2?

// On pourrait aussi dire "combien y a t'il de jeu gratuit", ou "combien y a t'il de jeu >10€", etc...


        // Le GROUP BY = Regrouper les données par paquet

    // SELECT AVG(prix) AS prix_moyen, console FROM jeux_video GROUP BY console ORDER BY prix_moyen
    // On affiche le prix moyen des jeux sur chaque console, donc prix moyen ps4, xbox ...

        // HAVING <=> WHERE mais quand il y a GROUP BY. le WHERE n'agit pas avec des regroupements. HAVING agit SUR le regroupement

    // SELECT AVG(prix) AS prix_moyen, console FROM jeux_video GROUP BY console HAVING prix_moyen <= 10  ORDER BY prix_moyen
        // <=> afficher le prix moyen des jeux selon leur console, SACHANT qu'on affiche que si c'est <= à 10€

    $requete_7 = $bdd ->query('SELECT SUM(prix) AS prix_total_par_console , console FROM jeux_video GROUP BY console ORDER BY prix_total_par_console DESC');
// Il est important de "traduire" pour voir si on a compris, ici :   Affichera la somme des prix des jeux par console, en triant du + cher au - cher

while ($donnees = $requete_7->fetch()) 
{ 
    echo "<p>Le prix total des jeux sur: ", $donnees['console'], "  vaut  ", $donnees['prix_total_par_console'] , "€";
}


/* Pour les dates, on a aussi SELECT DAY(date_ajout) AS numero_jour FROM ... WHERE ...
        Qui donnera le numéro du jour pour chaque jeu

        DATE_SUB(date_ajout , INTERVAL 15 DAY)
        /DATE_ADD(date_naissance, INTERVAL 1 YEAR)
        Permet de modifier une date d'une donnée, une sorte de UPDATE. Puis avec WHERE, on peut choisir quelles dates modifier


    L'utilité c'est de créer des dates d'expiration par exemple, "si date dépassé, alors tel truc"
        if ($donnees['date_expiration'] > NOW()) { ... }
*/

?>

<p> -------- Les Jointures ------------- </p>

<?php
                                                                    //OUTER, LEFT, RIGHT, ...
// Pour les jointures : SELECT table1.truc , table2.truc2 FROM table1 INNER JOIN table2   ON table1.ID_table2 = table2.ID
                                    // on peut écrire t1.truc si on a "table1 AS t1"       On joint en reliant les ID en commun des 2 tabkes

    // Exemple : 
$requete_8 = $bdd ->query('SELECT c.ID , c.Auteur, c.Content, c.date_commentaire,   a.title , a.content , a.date_creation 
FROM commentaires AS c 
INNER JOIN articles AS a 
ON c.ID_article = a.ID  
LIMIT 0,10              ');
// A la place d'INNER on peut mettre FULL OUTER, LEFT, RIGHT, ... voir l'image regroupant tous les cas

while ($donnees = $requete_8->fetch()) 
{ 
  //  echo "<p>Dans cet exemple (INNER JOIN) on peut afficher différentes données à la fois ", $donnees['commentaire_content'], " ou ", $donnees['date_commentaire'] , "d'un commentaire";
    echo "<p> La majuscule compte, et suffit pour différencier les 2 : Article_content : ", nl2br($donnees['content']), " et Commentaire_Content : ", nl2br($donnees['Content']), "</p>" ;
  //  echo "<p>mais aussi côté article : ", $donnees['title'], " ou ", $donnees['article_content'];
}




// Liste des fonctions courantes : https://sql.sh/fonctions

// Il est possible de personnaliser des requêtes de fonctions en laissant l'utilisateur choisir les paramètres (ex : nb messages to show).


/*  Majuscules importantes dans SELECT

echo "<p>", $donnees['Content'],"</p>";

 LES MAJUSCULES COMPTENT dans la récupération des données de la BDD

 DONC, ne JAMAIS mettre de MAJUSCULE dans les NOMS DE CHAMPS! Sous peine de faire des erreurs


// Ordre de Syntaxe important :  WHERE    PUIIS    ORDER BY,  PAS L'INVERSE ! ! ! ! ! Sinon ça plante


 // Déclaration dans SELECT

Si on utilise une variable dans une fonction comme : SELECT COUNT(mavariable) FROM
Il ne sera pas possible d'utiliser $donnees['mavariable']

Car elle est dans une fonction, du coup on écrira :   SELECT mavariable, COUNT(mavariable) FROM

Ainsi, il est possible d'écrire : SELECT * , AVG(var), SUM(var2) FROM
*/

?>






</body>

</html>