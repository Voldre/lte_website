<?php
class Personnage
{               // virgule = tous des privates
  private $_degats,
          $_id,
          $_nom,
          $_exp,
          $_niv;
  
  const CEST_MOI = 1; // Constante renvoyée par la méthode `frapper` si on se frappe soi-même.
  const PERSONNAGE_TUE = 2; // Constante renvoyée par la méthode `frapper` si on a tué le personnage en le frappant.
  const PERSONNAGE_FRAPPE = 3; // Constante renvoyée par la méthode `frapper` si on a bien frappé le personnage.
  
  
  public function __construct(array $donnees)
  {
    $this->hydrate($donnees);
  }
  
  public function frapper(Personnage $perso)
  {
    $this->_exp += 10; // Tu reçois de l'exp en frappant
    $this->isLevelUp(); // Vérifie si on a up ou pas

    if ($perso->id() == $this->_id)
    {
      return self::CEST_MOI;
    }
    
    // On indique au personnage qu'il doit recevoir des dégâts.
    // Puis on retourne la valeur renvoyée par la méthode : self::PERSONNAGE_TUE ou self::PERSONNAGE_FRAPPE
    return $perso->recevoirDegats();
  }
  
  public function hydrate(array $donnees)
  {
    foreach ($donnees as $key => $value)
    {
      $method = 'set'.ucfirst($key);
      
      if (method_exists($this, $method))
      {
        $this->$method($value);
      }
    }
  }
  
  public function recevoirDegats()
  {
      
    $this->_exp += 3; // Tu reçois de l'exp en étant frappés
    $this->isLevelUp(); // Vérifie si on a up ou pas

    $this->_degats += 5;
    // Si on a 100 de dégâts ou plus, on dit que le personnage a été tué.
    if ($this->_degats >= 100)
    {
      return self::PERSONNAGE_TUE;
    }
    
    // Sinon, on se contente de dire que le personnage a bien été frappé.
    return self::PERSONNAGE_FRAPPE;
  }

  
  
  
  // GETTERS //
  

  public function degats()
  {
    return $this->_degats;
  }
  
  public function id()
  {
    return $this->_id;
  }
  
  public function nom()
  {
    return $this->_nom;
  }
  
  public function exp()
  {
      return $this->_exp;
  }

  public function niv()
  {
      return $this->_niv;
  }

  public function setDegats($degats)
  {
    $degats = (int) $degats;
    
    if ($degats >= 0 && $degats <= 100)
    {
      $this->_degats = $degats;
    }
  }
  
  public function setId($id)
  {
    $id = (int) $id;
    
    if ($id > 0)
    {
      $this->_id = $id;
    }
  }
  
  public function setNom($nom)
  {
    if (is_string($nom))
    {
      $this->_nom = $nom;
    }
  }

  public function nomValide()
  {
    return !empty($this->_nom);
    // empty = false
    // !empty = true
    // "Valide? true si pas vide, false si vide"
  }

  public function setExp($exp)
  { 
    $exp = (int) $exp;
    if ($exp < 0 || $exp >= 100)
    {
        $exp = 0;
    }
    $this->_exp = $exp;
  }

  public function setNiv($niv)
  { 
    $niv = (int) $niv;
    if ($niv < 0 || $niv >= 100)
    {
        $niv = 0;
    }
    $this->_niv = $niv;
  }

  public function isLevelUp()
  {
      if($this->_exp >= 100)
      {
          $this->_niv += 1;
          $this->_exp = $this->_exp % 100; // on fait modulo 100 pour conserver la partie "en trop", ex : 109 --> levelup + 9 exp
          $message = "Vous avez gagné un niveau! Vous êtes au niveau : ".$this->_niv." vous avez ".$this->_exp."xp";
      }
  }
}