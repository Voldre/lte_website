<?php
class Rodeur extends Personnage
{   // Ses dégâts augmentent plus il est en galère
  public function empoisonner(Personnage $perso)
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
    
    $perso->degats += $this->atout;
    
  }
}