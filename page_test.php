<!DOCTYPE html>
<html lang="fr">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />

    <meta charset="utf-8" />


    <meta name="google-site-verification" content="jnkZGiCBus4HjXKu-MXbX3L5sw4EDbaZyzTMz5uGxgg" />

    <title>Les trente élus 1</title>

    <meta name="description" content="Page officiel du jeu : Les Trente Elus 1" />

    <!-- <link rel="canonical" href="https://voldre.wixsite.com/les-trente-elus" /> -->

    <meta property="og:title" content="Les trente élus 1" />
    <meta property="og:description" content="Page officiel du jeu : Les trente élus Les informations principales et tout sur le jeu ici même." />
    <meta property="og:url" content="https://les-trente-elus/les-trente-elus-1" />
    <!-- Custom url -->

    <meta property="og:site_name" content="les-trente-elus" />
    <meta property="og:type" content="website" />

    <meta name="keywords" content="elu, elus, jeu, site, trente, trentes, &amp;eacute;lu, &amp;eacute;lus" />

    <link rel="stylesheet" href="style.css" />

</head>

<body>
    <h3 class="souligne" , classe="gras"> Les Trente Elus 1 : </h3>

    <h5>Page dédiée au 1er Jeu. "Les Trente Elus"</h5>



    ​<?php // code php 
    
    $age = 20;
    $nom = "Dubuc";
    $prenom = "Valentin";
    $student = true;

    $test = 5 ;
    $test2 = $age * $test ;

    echo "Bonjour " , $prenom ," ", $nom , ", tu as " , $age , " ans!" ;
    
    // Ceci fera la même chose
    echo "Bonjour $prenom $nom tu as $age ans!";

    // Là, avec les apostrophes, les variables ne sont pas traités!
    echo 'Bonjour $prenom $nom tu as $age ans! ';

    // Afficher des " et des ' --> Il faut plaser un antislash devant le caractère à "afficher"
    echo "Bonjour quel est ton \"nom\" ?" ;
    // Ou simplement avec les apostrophes :
    echo 'Bonjour quel est ton "nom" ?';

    // Une balise HTML peut être appliqué sur les fonctions en PHP, comme là avec echo
    echo "<p>Bonjour $prenom $nom tu as $age ans!</p>";

    if ($age >= 18)
    {
    echo "<p> $test2</p>";
    }
    else 
    {
    echo "<p>tu n'es pas majeur!</p>"; 
    }

    if ($student) // $student == true
     {}        
                //AND
    if ($student && $age >= 18) {
     ?>   
        <p> test du if avec &&, et test de la fermeture/ouverture de la balise PHP</p> 
    <?php
    } // Pas oublier de refermer le if



        // Tableau et ForEach

    // Tableau numéroté
    $tableauValeur = array('première', 'deuxième', 'troisième');
    // équivalent à $tableauValeur[0] = 'premier; etc...

    // Tableau associatif
    $montableau = array("nom" => $nom, "prenom" => $prenom, "âge" => $age);
    // ATTENTION! il ne faut pas déclarer de tableau avec des [] en mode $tableau[] !!

    // Pour extraire une des données on peut faire :
    echo $montableau['âge']; // par exemple

    foreach ($montableau as $label => $attribut) // foreach permet de scroller TOUTES les valeurs du tableau, même s'il augmente au cours du temps (pas besoin de tableau.lenght)
    {
        echo "<p> Voici mon label $label qui vaut $attribut";
    }

    foreach($tableauValeur as $mavariablelocal)
    {
        echo "<p>voici ma variable $mavariablelocal </p>";
    }

    // Equivalent à for ($i = 0; $i < 3; $i++) { echo $tableauValeur[$i]... ;}  // Avec i étant ma variable local


        // Liste de fonctions existentes

        $MaPhrase = 'voici une phrase lambda.' ;
        $nombrecaracteres = strlen($MaPhrase);
        $melangeurcaracteres = str_shuffle($MaPhrase);
        $MaPhrafe = str_replace('s','f', $MaPhrase); // Remplace les 's' par des 'f'

        $fichier = fopen("images/image_olko.png", "r"); // Permet d'ouvrir un fichier

        // Creation de fonction

        function mafonction($mavariable) // Il est possible de donner plusieurs paramètres, mafonction($var1,$var2,$var3)
        {
            echo "voici une fonction à laquelle on a mis $mavariable en entrée.";
        }

        //Affichage

        echo "<p>il y a $nombrecaracteres caractères dans ma phrase enregistrée, voici la phrase dans le désordre : <br/> $melangeurcaracteres</p>";
        mafonction("voici_ma_variable");
        echo $MaPhrafe;

        if ($age > 18) { $fichier ; }


    ?>



    <p><img src="images/pas_ta_puce_th.png" class="flottantG" alt="Image de présentation" />Synopsis : Dans ce monde, s'exerce depuis peu une tyrannie par les Dieux, ils détruisent sans raison connu le monde des hommes, de village en village, et de ville
        en ville. Les Dieux Déchus, leurs ennemis, ayant donc changé de camp, ont désignés trente élus pour combattre les Dieux.
        <br/>Dans cette histoire, vous incarnez l'un des six groupes existants. Un groupe de cinq personnes...
        <br/>Vous avancerez dans l'histoire en ignorant presque tout sur votre raison d'être et même chose pour l'univers dans lequel vous êtes.</p>
    ​
    <p>Vous aurez au long de l'aventure, plusieurs alternatives, des choix que vous ferez. Il s'agit des choix que les premiers joueurs on fait lors du Jeu de Rôle. Ce qui veut dire qu'il n'existe pas qu'une fin, et donc de nombreux évènements différent
        selon vos choix...</p>

    <p class="alignR"> <a href="myindex.html" class="alignR">Revenir à la page principale</a> </p>
</body>

</html>