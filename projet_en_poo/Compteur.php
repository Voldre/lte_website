<?php
class Compteur
{

    /*    private $_compteur = 0;
    public function __construct()
    {
        $this->_compteur = $this->_compteur + 1;
        echo "<p>",$this->_compteur," instanciement.</p>";

    // Ne fonctionne pas, affiche 1, 1, 1, 1, ...
    } */


    // En passant par un attribut statique

    private static $_compteur = 0;
    // Ce code va fonctionner, car il n'existe qu'un seul attribut $_compteur, car il est STATIC

    public function __construct()
    {
        self::$_compteur += 1; // L'incrémentation se fait bien à chaque fois dessus, y a du coup aucun souci!
        echo "<p>",self::$_compteur,"</p>";
    }

        // Peut être static (car ne dépend pas d'un objet)
    public function getCount()
    {
        return self::$_compteur ;
    }
}
