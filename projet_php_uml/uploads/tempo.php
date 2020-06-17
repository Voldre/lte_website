<?php
/**
 * Classe représentant une news, créée à l'occasion d'un TP du tutoriel « La programmation orientée objet en PHP » disponible sur http://www.openclassrooms.com/
 * @author Valentin D.
 * @version 1.0
 */
class News
{
    protected  $erreurs = [],
               $id,
               $auteur,
               $titre,
               $contenu,
               $dateAjout,
               $dateModif;

    const AUTEUR_INVALIDE = 1;
    const TITRE_INVALIDE = 2;
    const CONTENU_INVALIDE = 3;
// Constructeur
 public function __construct($donnees = [])
  {
    // LE PROBLEME "Missing argument 1 for News::__construct()" EXISTE PARCE QUE
    // JE NAI PAS PRECISE QUE $donnees ETAIT EGALE A UN TABLEAU!
    // si je retire "= []" je vais avoir le problème du missing argument!
    // Mettre array $donnees NE MARCHE PAS

    if (!empty($donnees))
    {
        $this->hydrate($donnees);
    }
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
    // Méthodes Magiques ! 
    public function __set($name, $value)
    {
    echo "<p>On ne peut pas mettre la valeur \"".$value."\" à l'attribut \"".$name."\" ici.</p>";
    }

    public function __get($name)
    {
    return "<p>On ne peut pas récupérer l'attribut \"".$name."\" ici.</p>";
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


    // Accesseurs

    public function erreurs() { return $this->erreurs; }
    public function id() { return $this->id; }
    public function auteur() { return $this->auteur; }
    public function titre() { return $this->titre; }
    public function contenu() { return $this->contenu; }
    public function dateAjout() { return $this->dateAjout; }
    public function dateModif() { return $this->dateModif; }

    // Mutateurs
    
    public function setId($id)
    {
        $id = (int) $id;
        
        if ($id > 0)
        {
        $this->id = $id;
        }
    }
    public function setAuteur($nom)
    {
        if (is_string($nom) && strlen($nom) >= 5 )
        {
        $nom = htmlspecialchars($nom);
        $this->auteur = $nom;
        }
        else
        {
            $this->erreurs[] = self::AUTEUR_INVALIDE;
        }
    }    
    public function setTitre($nom)
    {
        if (is_string($nom) && strlen($nom) >= 5 )
        {
        $nom = htmlspecialchars($nom);
        $this->titre = $nom;
        }
        else
        {
            $this->erreurs[] = self::TITRE_INVALIDE;
        }
    }
    public function setContenu($content)
    {
        if (is_string($content) && strlen($content) >= 25 )
        {
        $content = htmlspecialchars($content);
        $this->contenu = $content;
        }
        else
        {
            $this->erreurs[] = self::CONTENU_INVALIDE;
        }
    }
    public function setDateAjout(DateTime $time)
    {
    $this->dateAjout = $time;
    }
    public function setDateModif(DateTime $time)
    {
    $this->dateModif = $time;
    }


  /**
   * Méthode permettant de savoir si la news est nouvelle.
   * @return bool
   */
  public function isNew()
  {
    return empty($this->id);
  }
  
  /**
   * Méthode permettant de savoir si la news est valide.
   * @return bool
   */
  public function isValid()
  {
    return !(empty($this->auteur) || empty($this->titre) || empty($this->contenu));
  }

}