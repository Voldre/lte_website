<?php
class Personnage
{
  private $_degats = 0; // Les dégâts du personnage.
  private $_experience = 0; // L'expérience du personnage.
  private $_force = 10; // La force du personnage (plus elle est grande, plus l'attaque est puissante).
  private $_nom;
 
    // Déclarations des constantes en rapport avec la force.

    const FORCE_PETITE = 20;
    const FORCE_MOYENNE = 50;
    const FORCE_GRANDE = 80;
  
    // Par CONVENTION les noms des constances sont en MAJUSCULES



public function init($nom)
{
    $this->_nom = $nom;
}
                    // FORCE à ce qu'on mette un objet personnage en paramètre!
                        // équivalent à déclarer un type! ex: "int ma_variable"
  public function frapper(Personnage $persoAFrapper)
  { //La variable affectée est celle des dégâts du personnage frappé, 
    // DONC pas de celui qui execute la méthode (càd pas $this), mais les dégâts sont égaux à la force de $this
    $persoAFrapper->_degats += $this->_force;
    echo "<p>",$this->_nom," a prit en tout :", $persoAFrapper->_degats," dégâts.</p>";
  }
  // La fonction est obligé de contenir l'autre objet (que son propre objet), afin d'avoir 2 identités: $this et l'autre
        
  public function gagnerExperience()
  {
    // On ajoute 1 à notre attribut $_experience.
    $this->_experience = $this->_experience + 1;
    echo "<p>Experience de ",$this->_nom," : ",$this->_experience,"</p>";
  }

  public function setForce($force)
  {
    // On vérifie qu'on nous donne bien soit une « FORCE_PETITE », soit une « FORCE_MOYENNE », soit une « FORCE_GRANDE ».
            // si valeur dans le tableau, valeur de $force,   self <=> "cette classe", <=> Personnage::FORCE_PETITE, ...
    if (in_array($force, [self::FORCE_PETITE, self::FORCE_MOYENNE, self::FORCE_GRANDE]))
    {
      $this->_force = $force;
    }
  }





  // Méthodes statiques
  public static function parler()
  {
    echo 'Je vais tous vous tuer !';
  }

}