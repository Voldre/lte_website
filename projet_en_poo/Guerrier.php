<?php
class Guerrier extends Personnage
{   // Sa défense augmente plus il est en galère
  public function recevoirDegats()
  {
    if ($this->degats >= 0 && $this->degats <= 25)
    {
      $this->atout = 0;
    }
    elseif ($this->degats > 25 && $this->degats <= 50)
    {
      $this->atout = 1;
    }
    elseif ($this->degats > 50 && $this->degats <= 75)
    {
      $this->atout = 2;
    }
    elseif ($this->degats > 75 && $this->degats <= 90)
    {
      $this->atout = 3;
    }
    else
    {
      $this->atout = 4;
    }
    
    $this->degats += 5 - $this->atout;
    
    // Si on a 100 de dégâts ou plus, on supprime le personnage de la BDD.
    if ($this->degats >= 100)
    {
      return self::PERSONNAGE_TUE;
    }
    
    // Sinon, on se contente de mettre à jour les dégâts du personnage.
    return self::PERSONNAGE_FRAPPE;
  }
}