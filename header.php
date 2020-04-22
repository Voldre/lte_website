<header>

        <?php 

        // 1 : on ouvre le fichier
$monfichier = fopen('compteur.txt', 'r+');


// 2 : on fera ici nos opérations sur le fichier...

    //fgetc =  lire caractère par caractère ; fgets = lire ligne par ligne
    // avec fgets, la fonction arrête la lecture au premier saut de ligne

$pages_vues = fgets($monfichier); 
// lit que la 1ere ligne. Pour lire les lignes d'après : boucle for 1 to X, et dans le for on met a chaque fois un $ligne
// Si on veut lire BEAUCOUP d'informations, on utiliseras une base de donnée (BDD)

$pages_vues += 1; // On augmente de 1 ce nombre de pages vues
fseek($monfichier, 0); // On remet le curseur au début du fichier, 0 pour le premier caractère
// Comme le curseur est placé au caractère 0, le caractère $_pages_vues prendra l'emplacement 0, (et 1 si le nombre est entre 10 et 99)
// Ainsi, si l'ancienne valeur était "9", alors le 9 sera remplacé par "1" suivie d'un "0", en bref, la valeur est écrasé, voilà le principe
// Si on a pas de fseek(), on aurait :  123456, au lieu de "1", puis "2", etc... Les caractères ne s'effaceraient pas

fputs($monfichier, $pages_vues); // On écrit le nouveau nombre de pages vues


// 3 : quand on a fini de l'utiliser, on ferme le fichier
fclose($monfichier);
        
        $annee = date("Y");
        $mois = date("m");
        $jour = date("d");

        echo "<h5>Site réalisé par Voldre (01/04/2020) <br/> Nous sommes le $jour/$mois/$annee </h5>";
        ?>
        
        <h2 class="compteur">

        <?php 
        
        echo sprintf("%05d", $pages_vues); // sprintf("$0Xd",$var) permet d'afficher un nombre minimum de chiffres
        // Les chiffres pas existant seront donc précédés de "0", exemple : avec %05d pour "36" on aura "00036" d'afficher

        ?>
        
        </h2>


    </header>