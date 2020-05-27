<?php

class MonException extends ErrorException
{
  public function __toString()
  {
    switch ($this->severity)
    {
      case E_USER_ERROR : // Si l'utilisateur émet une erreur fatale.
        $type = 'Erreur fatale';
        break;
      
      case E_WARNING : // Si PHP émet une alerte.
      case E_USER_WARNING : // Si l'utilisateur émet une alerte.
        $type = 'Attention';
        break;
      
      case E_NOTICE : // Si PHP émet une notice.
      case E_USER_NOTICE : // Si l'utilisateur émet une notice.
        $type = 'Note';
        break;
      
      default : // Erreur inconnue.
        $type = 'Erreur inconnue';
        break;
    }
    
    return '<strong>' . $type . '</strong> : [' . $this->code . '] ' . $this->message . '<br /><strong>' . $this->file . '</strong> à la ligne <strong>' . $this->line . '</strong>';
  }
}

function error2exception($code, $message, $fichier, $ligne)
{
  // Le code fait office de sévérité.
  // Reportez-vous aux constantes prédéfinies pour en savoir plus.
  // http://fr2.php.net/manual/fr/errorfunc.constants.php
  throw new MonException($message, 0, $code, $fichier, $ligne);
}

function customException($e)
{
  echo 'Ligne ', $e->getLine(), ' dans ', $e->getFile(), '<br /><strong>Exception lancée</strong> : ', $e->getMessage();
}

set_error_handler('error2exception');
set_exception_handler('customException');


// Cette classe et ces 2 fonctions permettent d'empêcher les vieilles erreurs moches de s'afficher, en mode WARNING X : ...
// En effet, on affiche proprement les erreurs et les exceptions




class MyLittleException extends Exception
{
  public function __construct($message, $code = 0)
  {
    parent::__construct($message, $code);
  }
  
  public function __toString()
  {
    return $this->message;
  }
}

function additionner($a, $b)
{
  if (!is_numeric($a) || !is_numeric($b))
  {
    throw new MyLittleException('Les deux paramètres doivent être des nombres'); // On lance une exception "MonException".
  }
  
  if (func_num_args() > 2)
  {
    throw new Exception('Pas plus de deux arguments ne doivent être passés à la fonction'); // Cette fois-ci, on lance une exception "Exception".
  }
  
  return $a + $b;
}
?>