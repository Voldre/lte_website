<?php
abstract class Personnage
{
  protected $atout,
            $degats,
            $id,
            $nom,
            $timeEndormi,
            $type,
            $coups_envoyees,
            $timeWait,
            $niveaux,
            $experiences;
  
  const CEST_MOI = 1; // Constante renvoyée par la méthode `frapper` si on se frappe soit-même.
  const PERSONNAGE_TUE = 2; // Constante renvoyée par la méthode `frapper` si on a tué le personnage en le frappant.
  const PERSONNAGE_FRAPPE = 3; // Constante renvoyée par la méthode `frapper` si on a bien frappé le personnage.
  const PERSONNAGE_ENSORCELE = 4; // Constante renvoyée par la méthode `lancerUnSort` (voir classe Magicien) si on a bien ensorcelé un personnage.
  const PAS_DE_MAGIE = 5; // Constante renvoyée par la méthode `lancerUnSort` (voir classe Magicien) si on veut jeter un sort alors que la magie du magicien est à 0.
  const PERSO_ENDORMI = 6; // Constante renvoyée par la méthode `frapper` si le personnage qui veut frapper est endormi.
  
  const PEUT_PAS_FRAPPER = 7;
  const LEVEL_UP = 8;
  const PERSONNAGE_SOIGNE = 9;

  public function __construct(array $donnees)
  {
    $this->hydrate($donnees);
    $this->type = strtolower(static::class);
  }

 // Méthodes Magiques ! 
public function __set($name, $value)
{
  echo "<p>On ne peut pas mettre la valeur \"".$value."\" à l'attribut \"".$name."\" ici.</p>";
}

public function __get($name)
{
  return "<p>On ne peut pas récupérer l'attribut \"".$name."\" ici.</p>";
}

public function __isset($name)
{
  // Avec if (isset($objet->attribut)) on peut vérifier s'il existe ou non
}

public function __call($name, $arguments)
{
  echo "<p>La méthode \"".$name."\" a été appelé mais n'existe pas ou n'est pas disponible.<br />
  Elle possédait le(s) argument(s) suivant(s) : \"".implode($arguments)."\"</p>"; 
}
public function __toString()
{
  return $this->donnees;
}


  public function estEndormi()
  {
    return $this->timeEndormi > time();
  }
 
  public function estFatigue()
  {
      // est fatigéu si le temps d'attente pas passé, ET si il a envoyées 3 ou + de coups
    return $this->timeWait > time() && $this->coups_envoyees >= 2 + $this->niveaux;
  }

  public function updateFatigue()
  {
    if ($this->timeWait < time())
    {     // On réinitialise le nombre de coups_envoyees à chaque fois qu'on a assez attendu
              // Exemple : 2 coups puis on revient le lendemain, alors on a le droit à 3 coups et pas 1 seul
    $this->coups_envoyees = 0;    // Car ça serait ridicule de faire "3 puis repos", et pas "3" alors que les 2 coups c'était hier
    }
  }


  public function frapper(Personnage $perso)
  {
    if ($perso->id == $this->id)
    {
      return self::CEST_MOI;
    }
    
    
    // Si le personnage a trop combattu
    
    if ($this->estFatigue())
    {
      return self::PEUT_PAS_FRAPPER;
    }
    else
    { 

      $this->updateFatigue();

        // Alors on attend 6 heures avant de pouvoir recombattre
      $this->timeWait = time() + 6; // une minute //* 3600;
      $this->coups_envoyees += 1;

      $this->experiences += 10;
      $this->isLevelUp();
    }


    if ($this->estEndormi())
    {
      return self::PERSO_ENDORMI;
    }


    // Si c'est un rôdeur, on l'empoisonne !
    if ($this->type == "rodeur")
    {
      $this->empoisonner($perso);
    }


    // On indique au personnage qu'il doit recevoir des dégâts.
    // Puis on retourne la valeur renvoyée par la méthode : self::PERSONNAGE_TUE ou self::PERSONNAGE_FRAPPE.
    return $perso->recevoirDegats();
  }
  
  public function hydrate(array $donnees)
  {
    foreach ($donnees as $key => $value)
    {
      $method = 'set'.ucfirst($key);
      
      if (method_exists($this, $method))  // Fait tout d'un coup
      {
        $this->$method($value);
      }
    }
  }
  
  public function nomValide()
  {
    return !empty($this->nom);
  }
  
  public function recevoirDegats()
  {
    $this->degats += 5;

    $this->experiences += 4;
    $this->isLevelUp();

    // Si on a 100 de dégâts ou plus, on supprime le personnage de la BDD.
    if ($this->degats >= 100)
    {
      return self::PERSONNAGE_TUE;

    }
    
    // Sinon, on se contente de mettre à jour les dégâts du personnage.
    return self::PERSONNAGE_FRAPPE;
  }
  
  public function reveil()
  {
    $secondes = $this->timeEndormi;
    $secondes -= time();
    
    $heures = floor($secondes / 3600);
    $secondes -= $heures * 3600;
    $minutes = floor($secondes / 60);
    $secondes -= $minutes * 60;
    
    $heures .= $heures <= 1 ? ' heure' : ' heures';
    $minutes .= $minutes <= 1 ? ' minute' : ' minutes';
    $secondes .= $secondes <= 1 ? ' seconde' : ' secondes';
    
    return $heures . ', ' . $minutes . ' et ' . $secondes;
  }

  public function repos()
  {
    $secondes = $this->timeWait;
    $secondes -= time();
    
    $heures = floor($secondes / 3600);
    $secondes -= $heures * 3600;
    $minutes = floor($secondes / 60);
    $secondes -= $minutes * 60;
    
    $heures .= $heures <= 1 ? ' heure' : ' heures';
    $minutes .= $minutes <= 1 ? ' minute' : ' minutes';
    $secondes .= $secondes <= 1 ? ' seconde' : ' secondes';
    
    return $heures . ', ' . $minutes . ' et ' . $secondes;
  }
  
  public function atout()
  {
    return $this->atout;
  }
  
  public function degats()
  {
    return $this->degats;
  }
  
  public function id()
  {
    return $this->id;
  }
  
  public function nom()
  {
    return $this->nom;
  }
  
  public function timeEndormi()
  {
    return $this->timeEndormi;
  }
  
  public function timeWait()
  {
    return $this->timeWait;
  }

  public function coups_envoyees()
  {
    return $this->coups_envoyees;
  }

  public function type()
  {
    return $this->type;
  }

  public function niveaux()
  {
    return $this->niveaux;
  }
  
  public function experiences()
  {
    return $this->experiences;
  }

  public function setAtout(int $atout)
  {    
    if ($atout >= 0 && $atout <= 100)
    {
      $this->atout = $atout;
    }
  }
  
  public function setDegats(int $degats)
  {    
    if ($degats >= 0 && $degats <= 100)
    {
      $this->degats = $degats;
    }
  }
  
  public function setId(int $id)
  {    
    if ($id > 0)
    {
      $this->id = $id;
    }
  }
  
  public function setNom(string $nom)
  {
    if (strlen($nom) > 2)
    {
      $this->nom = $nom;
    }
  }
  
  public function setTimeEndormi(int $time)
  {
    $this->timeEndormi = (int) $time;
  }

  public function setTimeWait(int $time)
  {
    $this->timeWait = (int) $time;
  }

  public function setCoups_envoyees(int $value)
  {
    $this->coups_envoyees = (int) $value;
  }

  public function setNiveaux(int $value)
  {
    $this->niveaux = (int) $value;
    if ($this->niveaux <= 0) // interdit d'être <= à 0
    {
      $this->niveaux = 1;
    }
  }
  
  public function setExperiences(int $value)
  {
    $this->experiences = (int) $value;
  }

  public function isLevelUp()
  {
    if ($this->experiences >= 100)
    {
      $this->experiences = $this->experiences % 100; // Modulo
      $this->niveaux += 1;
    }

  }

}