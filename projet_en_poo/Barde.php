<?php
class Barde extends Personnage
{
  public function lancerUnSort(Personnage $perso)
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
    
    if ($perso->id == $this->id)
    {
      // C'est autorisé ! 
      //return self::CEST_MOI;
    }
    
    
  if ($this->estEndormi())
  {
    return self::PERSO_ENDORMI;
  }

    


    // Si le personnage a trop combattu
    
    if ($this->estFatigue())
    {
      return self::PAS_DE_MAGIE;
    }
    else
    { 
    
      $this->updateFatigue();
    
       // Alors on attend 6 heures avant de pouvoir recombattre
      $this->timeWait = time() + 6; // une minute //* 3600;
      $this->coups_envoyees += 1/2;
    
      $this->experiences += 3;
      $this->isLevelUp();
      // Soin de 5 + l'atout
      $perso->degats -= 5 + $this->atout;
      
      return self::PERSONNAGE_SOIGNE;
    }
    

  }
}