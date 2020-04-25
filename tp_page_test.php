<!DOCTYPE html>
<html lang="fr">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />

    <meta charset="utf-8" />


    <meta name="google-site-verification" content="jnkZGiCBus4HjXKu-MXbX3L5sw4EDbaZyzTMz5uGxgg" />

    <title>Les trente élus 1</title>

    <meta name="description" content="Page officiel du jeu : Les Trente Elus 1" />

    <!-- <link rel="canonical" href="https://voldre.wixsite.com/les-trente-elus" /> -->

    <meta property="og:title" content="Ceci est une page test" />
    <meta property="og:description" content="Page officiel du jeu : Les trente élus Les informations principales et tout sur le jeu ici même." />
    <meta property="og:url" content="https://les-trente-elus/les-trente-elus-1" />
    <!-- Custom url -->

    <meta property="og:site_name" content="les-trente-elus" />
    <meta property="og:type" content="website" />

    <meta name="keywords" content="elu, elus, jeu, site, trente, trentes, &amp;eacute;lu, &amp;eacute;lus" />

    <link rel="stylesheet" href="style.css" />

</head>

<body style="background-image: none"> <!-- Parce que c'est une page de test -->

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
    echo "Bonjour quel est ton \"nom\" ? " ;
    // Ou simplement avec les apostrophes :
    echo 'Bonjour quel est ton "nom" ?';

    // Une balise HTML peut être appliqué sur les fonctions en PHP, comme là avec echo
    echo "<p>Bonjour $prenom $nom tu as $age ans!</p>";

    if ($age >= 18)
    {
    echo "<p>Tu es majeur.</p>";
    }
    else 
    {
    echo "<p>Tu n'es pas majeur!</p>"; 
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
    echo "Voici la valeur à l'index 'âge' de mon tableau : ", $montableau['âge']; // par exemple

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

        $MaPhrase = 'voici une phrase lambda, une lettre n\'existe pas, laquelle?.' ;
        $nombrecaracteres = strlen($MaPhrase);
        $melangeurcaracteres = str_shuffle($MaPhrase);
        $MaPhrafe = str_replace('s','f', $MaPhrase); // Remplace les 's' par des 'f'

        // Creation de fonction

        function mafonction($mavariable) // Il est possible de donner plusieurs paramètres, mafonction($var1,$var2,$var3)
        {
            echo "voici une fonction à laquelle on a mis $mavariable en entrée.";
        }

        //Affichage

        echo "<p>il y a $nombrecaracteres caractères dans ma phrase enregistrée, voici la phrase dans le désordre : <br/> $melangeurcaracteres</p>";
        mafonction("voici_ma_variable_1");
        echo "<p>Ma phrase modifié : " , $MaPhrafe, "</p>";

?>



<!-- forme pour formulaire, et action = la page destination -->


<h3> Bienvenue sur la page officielle de la NASA, pour accéder aux documents secrets, veuillez saisir le mot de passe :</h3>
<pre>
<?php /*
print_r($_GET);
echo "<br/>";
echo "<br/>";
print_r($_COOKIE);
echo "<br/>";
echo "<br/>";
print_r($_SERVER);
echo "<br/>";
echo "<br/>";
print_r($_SESSION); */
?>
</pre>

<form action="page_secrete.php" method="POST">

<p><label> <input type="password" name ="mypassword" /></label></p>
<p><input type="submit" value="Valider" /></p>

</form>


<h3> Voici un formulaire auquel vous pouvez répondre :</h3>

<form action="page_secrete.php" method="POST">  <!-- GET fait transiter dans l'URL  : truc.php?variable=x -->
                                  <!-- POST transfère + de donner et sans passer par l'URL ! Ce qui est préférable ici. -->


<p> <label>Ton prénom: <input type="text" name="prenom" /></label> </p>
        <!-- Label permet de rendre le texte cliquable pour agir sur la zone du formulaire -->
        
<p> <label>Ton nom: <input type="text" name="nom" /></label> </p>
        <!-- Label permet de rendre le texte cliquable pour agir sur la zone du formulaire -->

<p> <label>Es-tu végétarien? <input type="checkbox" name="regime" /></label> </p>
        <!-- Label permet de cocher la case en cliquant sur le texte, par exemple -->

<p> Ecrivez-moi votre avis sur ce site </p>

<textarea name="message" rows="8" cols="50">
Ne perdez pas votre temps à essayer la faille XSS.
</textarea>

<input type="checkbox" name="case" id="case" /> <label for="case">Ma case à cocher</label> <!-- Case à cocher classique -->
<input type="checkbox" name="case" checked="checked" /> <!-- checked="checked" permet de rendre une case cochée par défaut -->

<p> Aimez-vous les frites ?
<input type="radio" name="frites" value="oui" id="oui" checked="checked" /> <label for="oui">Oui</label>
<input type="radio" name="frites" value="non" id="non" /> <label for="non">Non</label> </p>

        <!-- case à cocher "l'un ou l'autre", on doit choisir-->

<p> <input type="submit" value ="Envoyer" /></p>
</form>







<!-- PARTIE PLUS COMPLEXE : L'UTILISATEUR NOUS ENVOIE UN FICHIER: #Candidature, envoie CV/LM/Photo -->


<h3> Envoyez une image sur la base de donnée (inférieure à 7 Mo) :</h3>


        <form action="page_test.php" method="post" enctype="multipart/form-data"> <!-- enctype permet de dire au navigateur "on va envoyer un fichier" -->
        <p>
                Formulaire d'envoi de fichier :<br />
                <input type="file" name="monfichier" /><br />
              <!--  <input type="file" name="monfichier_2" /><br /> -->
                <input type="submit" value="Envoyer le fichier" />
        </p>        <!-- PS : il est possible d'envoyer plusieurs fichiers en même temps aussi -->
        </form>
        <?php
// Réception du fichier

// Testons si le fichier a bien été envoyé et s'il n'y a pas d'erreur
if (isset($_FILES['monfichier']) AND $_FILES['monfichier']['error'] == 0)
{
        // Testons si le fichier n'est pas trop gros
        if ($_FILES['monfichier']['size'] <= 7000000) // 7 000 000 = 7Mo
        {
                // Testons si l'extension est autorisée
                $infosfichier = pathinfo($_FILES['monfichier']['name']); // pathinfo renvoie un array contenant l'extension du fichier
                $extension_upload = $infosfichier['extension'];          // dans cette variable $infosfichier['extension']
                $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png'); // On définie un tableau d'extensions autorisées
                if (in_array($extension_upload, $extensions_autorisees)) // et on regarder si l'extension upload se retrouve dans les extensions autorisées
                {   // Le code est très parlant! "Dans ces index... est-il dedans?
                    
                        // On peut valider le fichier et le stocker définitivement
                        move_uploaded_file($_FILES['monfichier']['tmp_name'], 'uploads/' . basename($_FILES['monfichier']['name'])); 
                        //move_uploaded_file(fichier , destination/ . nom) = déplacer le fichier dans le répertoire 'uploads/fichier.extension'
                        // De ce fait, cela se résume en 1 ligne de code, qui identifie le nom du fichier stocké par défaut "$_FILES['monfichier']['tmp_name']"
                        // et décide ensuite après une virgule, de l'emplacement où sauvegarder ce fichier de façon définitive : 'emplacement/ici/' . basename() = le nom + l'extension 
                        echo "<p>L'envoi a bien été effectué !</p>";                                                                         // exemple : add-5.png

                }
                else
                {
                    echo "<p>Pas la bonne extension de fichier, mettez des images uniquements!</p>";
                    // avec un zavell working.pfi , on a bien une erreur d'extension
                }
        }
        else
        {
            echo "<p>Le fichier est trop volumineux :" , $_FILES['monfichier']['size'] , "</p>";
        }
}
else
{
    echo "<p>Aucun fichier n'a été envoyé, ou le fichier comprend des erreurs.</p>";
    // LG3 = Pas la bonne extension
    // LG1 = Fichier comporte des erreurs : ?!
    // Caractéristiques : LG3 = 2 Mo, et LG1 = 3,74 Mo, extensions m4a pour les deux
    // LG2 = 0,95 Mo et il fonctionne.
    // Donc si fichier trop gros en vidéo, on a des erreurs? Et pas le message "trop volumineux", bizarre
}
?>

</body>

</html>