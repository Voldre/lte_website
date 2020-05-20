<?php

$title = "POO";

ob_start();

/* Afin d'éviter de manuellement inclure les fichiers contenant les classes
on décide d'utiliser une fonction qui va elle-même réaliser les require()
avec le spl_autoload_register(), elle saura qui a été inclus et qui ne
l'a pas été, ainsi, elle ne les ajoutera que si elles n'y sont pas encore */

    function loadClass($class)
    {
    require $class . '.php'; // On inclut la classe correspondante au paramètre envoyé.
    }

    spl_autoload_register('loadClass'); // On enregistre la fonction en autoload pour qu'elle soit appelée dès qu'on instanciera une classe non déclarée.


    // Plus besoin car on a un autoloader
//require_once("Personnage.php");

                //Opérateur de résolution de portée "::" , permet d'accéder aux contenus de la classe qui ne sont ni des attributs ni des méthodes dynamiques
    $perso1 = new Personnage(Personnage::FORCE_MOYENNE);; // Un premier personnage
    $perso2 = new Personnage; // Un second personnage


        // Il est donc possible d'utiliser l'opé de réso portée sur des méthodes STATIQUES
        // En voilà une
    Personnage::parler();
        // On ne déclare pas d'objet, car justement c'est une méthode statique, "public static function ..."
        // Cependant, on peut la déclarer via un objet (car c'est public), mais ça ne change RIEN
    $perso1->parler();  // The same, but you can


    $perso1->init("Jean");
    $perso2->init("Seb");

    $perso1->frapper($perso2); // $perso1 frappe $perso2
    $perso1->gagnerExperience(); // $perso1 gagne de l'expérience

    $perso2->frapper($perso1); // $perso2 frappe $perso1
    $perso2->gagnerExperience(); // $perso2 gagne de l'expérience


$content = ob_get_clean();

require("template.php");