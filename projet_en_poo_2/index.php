<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
</head>
<?php


require_once("MonException.php");
require_once("MaClasse.php");
require_once("Personnage.php");
require_once("Magicien.php");

?>

<h2>Que souhaitez-vous tester?</h2>

<form action="" method="post">
      <p> Tester la page... :
        <select name="execute">
          <option value="exception">Les exceptions</option>
          <option value="API">l'API de réflexivité</option>
          <option value="ArrayIterator">Objet -> Tableau (ArrayIterator)</option>
          <option value="DesignPatterns">Design Patterns (Factory / Observer)</option>
          <option value="TP_News">TP : Système de News en POO</option>
          <option value="generateur">Les Générateurs</option>
          <option value="instanceof">L'opérateur instanceof</option>
        </select>
        <input type="submit" value="Executer" />
      </p>
    </form>

<?php

if(isset($_POST['execute']))
{

  $_POST['execute'] = htmlspecialchars($_POST['execute']);

  if($_POST['execute'] == "API") // Page de l'API de réflexivité
  {
    echo "<h4> Page test sur l'API de réflexivité :</h4>";

    $classePerso = new ReflectionClass('Personnage');
    $classeMagicien = new ReflectionClass('Magicien');
    $Mago = new Magicien(['nom' => 'vyk12', 'type' => 'magicien']);
    
    
    if($parent = $classeMagicien->getParentClass())
    {
        echo "<br/>La classe parente de magicien est :  <strong>", $parent->getName(),"</strong>";
    }
    else
    {
        echo "La classe magicien n'a pas de parent.";
    }
    
    foreach ($classeMagicien->getProperties() as $attribut)
    {
        $attribut->setAccessible(true);
    
        if($attribut->getValue($Mago) != NULL)
        {
            echo "<br/>".$attribut->getName(), ' => ', $attribut->getValue($Mago);
        }
        else
        {
            echo "<br/>".$attribut->getName(), ' => NULL';
        }
      if ($attribut->isPublic())
      {
        echo ' -- visibilite : public';
      }
      elseif ($attribut->isProtected())
      {
        echo ' -- visibilite : protege';
      }
      else
      {
        echo ' -- visibilite : prive';
      }
    
      $attribut->setAccessible(false); // désactiver l'accès aux attributs (privé et protégé)
    }
    
    
    // And
    ?> <br/> <br/> <br/> <br/> 
    <?php
    foreach ($classeMagicien->getMethods() as $method)
    {
        //$method->setAccessible(true); // Useless because their are all public
            echo "<br/>".$method->getName();
    
      if ($method->isPublic())
      {
        echo ' -- visibilite : public';
      }
      elseif ($method->isProtected())
      {
        echo ' -- visibilite : protege';
      }
      else
      {
        echo ' -- visibilite : prive';
      }
    
      if ($method->isConstructor())
      {
          echo "    ---- Je suis le constructeur !";
      }
    }

  }






  elseif($_POST['execute'] == "exception") // Page des exceptions
  {
    echo "<h4> Page test sur les exceptions :</h4>";
        
    try // Nous allons essayer d'effectuer les instructions situées dans ce bloc.
    {
      echo additionner(12, 3), '<br />';

    $a = rand(0,1);

    echo $a;

    if ($a == 1)
      {
        echo additionner(15, 54, 45), '<br />';
      }
      else
      {
        echo additionner('azerty', 54), '<br />';
      }
      echo additionner(4, 8);
    }

    catch (MyLittleException $e) // Nous allons attraper les exceptions "MonException" s'il y en a une qui est levée.
    {
      echo '[MyLittleException] : ', $e; // On affiche le message d'erreur grâce à la méthode __toString que l'on a écrite.
    }

    catch (Exception $e) // Si l'exception n'est toujours pas attrapée, alors nous allons essayer d'attraper l'exception "Exception".
    {
      echo '[Exception] : ', $e->getMessage(); // La méthode __toString() nous affiche trop d'informations, nous voulons juste le message d'erreur.
    }

    echo '<br />Fin du script'; // Ce message s'affiche, cela prouve bien que le script est exécuté jusqu'au bout.

  }





  elseif($_POST['execute'] == "ArrayIterator") // Page des exceptions
  {

    $a = rand(0,1);

    if ($a == 0)  // Soit on ne déclare AUCUNE classe, car ArrayIterator possède déjà les 4 interfaces
    {             // Dans ce cas là on crée juste un objet qui va se remplir des valeurs d'un tableau
      
    echo "<h4> Page test sur la classe ArrayIterator (utiliser un objet comme un tableau) :</h4>";
      $objet = new ArrayIterator;
      $tableau = ['Premier élém', 'Deuxième élém', 'Troisième élém', 'Quatrième élém', 'Cinquième élém'];
    
      foreach ($tableau as $key => $value)  // Pour chaque clé et valeur, on implémente la clé et la valeur à l'objet
      {
        $objet->offsetSet($key,$value);   // Tadaam! On a créé un attribut $tableau qui possède tout
      }           
      
      echo 'Parcours de l\'objet  "objet_ArrayIterator"...<br />';
    }
    else  // Si on utilise notre classe, on peut directement lire le contenu de notre tableau attribut
    {
      
    echo "<h4> Page test sur la classe MaClasse implémentants les interfaces SeekableIterator, ArrayAccess, Countable<br/>
    afin d'utiliser un objet comme un tableau :</h4>";
      $objet = new MaClasse;
      echo 'Parcours de l\'objet  "objet"...<br />';
    }
    
    
    foreach ($objet as $key => $value)
    {
      echo $key, ' => ', $value, '<br />';
    }
    
    echo '<br />Remise du curseur en troisième position...<br />';
    $objet->seek(2);
    echo 'Élément courant : ', $objet->current(), '<br />';
    
    echo '<br />Affichage du troisième élément : ', $objet[2], '<br />';
    echo 'Modification du troisième élément... ';
    $objet[2] = 'Hello world !';
    echo 'Nouvelle valeur : ', $objet[2], '<br /><br />';
    
    echo 'Actuellement, mon tableau comporte ', count($objet), ' entrées<br /><br />';
    
    echo 'Destruction du quatrième élément...<br />';
    unset($objet[3]);
    
    if (isset($objet[3]))
    {
      echo '$objet[3] existe toujours... Bizarre...';
    }
    else
    {
      echo 'Tout se passe bien, $objet[3] n\'existe plus !';
    }
    
    echo '<br /><br />Maintenant, il n\'en comporte plus que ', count($objet), ' !';
    
    /* Affichera :
    
    Parcours de l'objet...
    0 => Premier élément
    1 => Deuxième élément
    2 => Troisième élément
    3 => Quatrième élément
    4 => Cinquième élément
    
    Remise du curseur en troisième position...
    Élément courant : Troisième élément
    
    Affichage du troisième élément : Troisième élément
    Modification du troisième élément... Nouvelle valeur : Hello world !
    
    Actuellement, mon tableau comporte 5 entrées
    
    Destruction du quatrième élément...
    Tout se passe bien, $objet[3] n'existe plus !
    
    Maintenant, il n'en comporte plus que 4 !
    
    */
  }



  elseif($_POST['execute'] == 'DesignPatterns')
  {
    require_once("ErrorHandler.php");
    require_once("PDOFactory.php");

        class MailSender implements SplObserver
        {
          protected $mail;
          
          public function __construct($mail)
          {
            if (preg_match('`^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$`', $mail))
            {
              $this->mail = $mail;
            }
          }
          
          public function update(SplSubject $obj)
          {
            mail($this->mail, 'Erreur détectée !', 'Une erreur a été détectée sur le site. Voici les informations de celle-ci : ' . "\n" . $obj->getFormatedError());
          }
        }
        class BDDWriter implements SplObserver
        {
          protected $db;
          
          public function __construct(PDO $db)
          {
            $this->db = $db;
          }
          
          public function update(SplSubject $obj)
          {
            $q = $this->db->prepare('INSERT INTO erreurs SET erreur = :erreur');
            $q->bindValue(':erreur', $obj->getFormatedError());
            $q->execute();
          }
        }

    $o = new ErrorHandler; // Nous créons un nouveau gestionnaire d'erreur.
    $db = PDOFactory::getMysqlConnexion();

    $o->attach(new MailSender('v.dre@laposte.net'))
      ->attach(new BDDWriter($db));

   // $o->setNom('Voldre');

    set_error_handler([$o, 'error']); // Ce sera par la méthode error() de la classe ErrorHandler que les erreurs doivent être traitées.

    5 / 0; // Générons une erreur
  }





  elseif($_POST['execute'] == "TP_News")
  {
    header('Location: Page_des_News.php');
  }



  elseif($_POST['execute'] == "generateur")
  {

    function generator()
    {
      echo (yield 'Hello world !');
      echo yield;
    }

    $gen = generator();

    // On envoie « Message 1 »
    // PHP va donc l'afficher grâce au premier echo du générateur
    $gen->send('Message 1');

    // On envoie « Message 2 »
    // PHP reprend l'exécution du générateur et affiche le message grâce au 2ème echo
    $gen->send('Message 2');

    // On envoie « Message 3 »
    // La fonction générateur s’était déjà terminée, donc rien ne se passe
    $gen->send('Message 3');
echo "<br/><br/>TASK RUNNER !<br/>";  

        // TASK RUNNER

      class TaskRunner
      {
        protected $tasks;

        public function __construct()
        {
          // On initialise la liste des tâches
          $this->tasks = new SplQueue;
        }

        public function addTask(Generator $task)
        {
          // On ajoute la tâche à la fin de la liste
          $this->tasks->enqueue($task);
        }

        public function run()
        {
          // Tant qu’il y a toujours au moins une tâche à exécuter
          while (!$this->tasks->isEmpty())
          {
            // On enlève la première tâche et on la récupère au passage
            $task = $this->tasks->dequeue();

            // On exécute la prochaine étape de la tâche
            $task->send('Hello world !');

            // Si la tâche n’est pas finie, on la replace en fin de liste
            if ($task->valid())
            {
              $this->addTask($task);
            }
          }
        }
      }


      // UTILISATION DU TASK RUNNER
$taskRunner = new TaskRunner;

function task1()
{
  for ($i = 1; $i <= 2; $i++)
  {
    $data = yield;
    echo 'Tâche 1, itération ', $i, ', valeur envoyée : ', $data, '<br />';
  }
}

function task2()
{
  for ($i = 1; $i <= 6; $i++)
  {
    $data = yield;
    echo 'Tâche 2, itération ', $i, ', valeur envoyée : ', $data, '<br />';
  }
}

function task3()
{
  for ($i = 1; $i <= 4; $i++)
  {
    $data = yield;
    echo 'Tâche 3, itération ', $i, ', valeur envoyée : ', $data, '<br />';
  }
}

$taskRunner->addTask(task1());
$taskRunner->addTask(task2());
$taskRunner->addTask(task3());

$taskRunner->run();

echo "<br/> '123', '123', '23', '23', '3', '3', voilà comment ça fonctionne!<br/>
1 : 2 itérations, 2 : 6 itérations, 3 : 4 itérations.<br/>
Les tâches s'alternent et même si l'une finie, les autres continues!";

    }


    elseif($_POST['execute'] == 'instanceof')
    {
                        // Closure
      echo "<p>Closure</p>";
      $maFonction = function()
      {
        echo 'Hello world !';
      };
      //var_dump permet d'afficher les informations d'une variable : type, valeur, tableau (et son contenu)
      var_dump($maFonction); // On découvre ici qu'il s'agit bien d'un objet de type Closure.
      echo "<p>Fin de la Closure, passons à instanceof : <br/></p>";
                      // instanceof
      interface iParent { }
      interface iFille extends iParent { }
      class A implements iFille { }

      $a = new A;

      ?>
      <p>
            interface iParent { }<br/>
      interface iFille extends iParent { }<br/>
      class A implements iFille { }<br/>

      $a = new A;<br/><br/>
      
      if ($a instanceof iParent)<br/>
      {<br/>
  
      <?php
      if ($a instanceof iParent)
      {
        echo 'Si iParent est une classe, alors $a est une instance de iParent ou $a instancie une classe qui est une fille de iParent.<br/>
        Sinon, <strong>$a instancie une classe qui implémente</strong> iParent ou <strong>une fille de iParent</strong>.<br/>}';
      }
      else
      {
        echo 'Si iParent est une classe, alors $a n\'est pas une instance de iParent et $a n\'instancie aucune classe qui est une fille de iParent.<br/>
        Sinon, $a instancie une classe qui n\'implémente ni iParent, ni une de ses filles.<br/>}';
      }
    }

}

?>
</html>