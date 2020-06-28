
<?php

  echo "<h2> Convertisseur de classe PHP en UML :</h2>";


// PROCHAINE ETAPE : Inclure un/des fichiers, et être capable de les lires pour utiliser l'api de reflexivité
// en gros, on laisse l'utilisateur importer ses classes

    require_once("Personnage.php");
    require_once("Magicien.php");

$classePerso = new ReflectionClass('Personnage');
$classeMagicien = new ReflectionClass('Magicien');
$objet = new Magicien(['nom' => 'vyk12', 'type' => 'magicien']);


if($parent = $classeMagicien->getParentClass())
{
    echo "<br/>La classe parente de magicien est :  <strong>", $parent->getName(),"</strong><br/> ";
}
else
{
    echo "La classe magicien n'a pas de parent.";
}


echo "<div class=\"square\"><h5>".$classeMagicien->getName()."</h5></div>";

echo "<div class=\"square\">";

foreach ($classeMagicien->getProperties() as $attribut)
{
    $attribut->setAccessible(true);

  if ($attribut->isPublic())
  {
    echo '+';
  }
  elseif ($attribut->isProtected())
  {
    echo '#';
  }
  else
  {
    echo '-';
  }
  

  if ($attribut->isStatic())
  {
      echo "<span class=\"underline\">";
  }
  echo $attribut->getName().": ";

  $var = gettype($attribut->getValue($objet));

  echo $var."<br/>";

  $attribut->setAccessible(false); // désactiver l'accès aux attributs (privé et protégé)
}


foreach ($classeMagicien->getConstants() as $CONSTANT => $value)
{   
  echo "+".$CONSTANT.": const = ". $value."<br/>";
}



echo "</div> <div class=\"square\">";

foreach ($classeMagicien->getMethods() as $method)
{

    $method->setAccessible(true);

  if ($method->isPublic())
  {
    echo '+';
  }
  elseif ($method->isProtected())
  {
    echo '#';
  }
  else
  {
    echo '-';
  }
  
  if ($method->isStatic())
  {
      echo "<span class=\"underline\">";
  }
  if ($method->isAbstract())
  {
      echo "<span class=\"italic\">";
  }
  if ($method->isFinal())
  {
      echo "<<leaf>> ";
  }
  echo $method->getName()."(";

$params = $method->getParameters();
foreach ($params as $param) {
    //$param is an instance of ReflectionParameter

    //echo $param->getName();
    //echo $param->isOptional();
    echo $param->getName().":"."type"; //$param->getType();
}

  echo "):";


  //echo $method->getReturnType();
  echo "<br/>";

  if ($method->isConstructor())
  {
      echo "    ---- Je suis le constructeur !<br/>";
  }
}


?>

<!--
< ?php
if (isset($_FILES['monfichier']) AND $_FILES['monfichier']['error'] == 0)
{
        if ($_FILES['monfichier']['size'] <= 7000000) // 7 000 000 = 7Mo
        {
                $infosfichier = pathinfo($_FILES['monfichier']['name']); // pathinfo renvoie un array contenant l'extension du fichier
                $extension_upload = $infosfichier['extension'];          // dans cette variable $infosfichier['extension']

                $extensions_autorisees = array('php'); // On définie un tableau d'extensions autorisées
                if (in_array($extension_upload, $extensions_autorisees)) 
                {
                /*$extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
                if (in_array($extension_upload, $extensions_autorisees)) // et on regarder si l'extension upload se retrouve dans les extensions autorisées
                { */
                                      
                  // On peut valider le fichier et le stocker définitivement
                  move_uploaded_file($_FILES['monfichier']['tmp_name'], 'uploads/' . basename("tempo.php")); 
                                          
                  require_once("uploads/tempo.php");

                  $filename = basename($_FILES['monfichier']['name'],'.php');
                  
                  //echo $filename."<br/>"; // Contient le nom du fichier, et donc, normalement le nom de la classe

                  // echo class_exists($filename);
                  if (!class_exists($filename))
                  {
                    echo "Ce fichier ne contient pas de classe se nommant ".$filename;
                    return 0;
                  }
                  // else
                  $class = new ReflectionClass($filename);


                  if(!$class->isAbstract())
                  {
                  $objet = new $filename();
                  $isAbstractClass = false;

                  }
                  else
                  {
                    $isAbstractClass = true; // Write name class in Italic
                  }

                  if($parent = $class->getParentClass())
                  {
                      echo "<br/>La classe parente de".$filename." est :  <strong>", $parent->getName(),"</strong><br/> ";
                  }
                  else
                  {
                      echo "La classe ".$filename." n'a pas de parent.";
                  }
                  
                  if ($isAbstractClass)
                  {
                    echo "<div class=\"square\"><h5 class=\"italic\">".$class->getName()."</h5></div>";
                  }
                  else
                  {
                  echo "<div class=\"square\"><h5>".$class->getName()."</h5></div>";
                  }
                  echo "<div class=\"square\">";


                  foreach ($class->getProperties() as $attribut)
                  {
                      $attribut->setAccessible(true);
                  
                    if ($attribut->isPublic())
                    {
                      echo '+';
                    }
                    elseif ($attribut->isProtected())
                    {
                      echo '#';
                    }
                    else
                    {
                      echo '-';
                    }
                    
                  
                    if ($attribut->isStatic())
                    {
                        echo "<span class=\"underline\">";
                    }
                    echo $attribut->getName().": ";
                  
                    if (!$class->isAbstract())
                    {
                      $var = gettype($attribut->getValue($objet));
                      echo $var."<br/>";
                    }
                    else
                    {
                      echo "<br/>";
                    }
                    $attribut->setAccessible(false); // désactiver l'accès aux attributs (privé et protégé)
                  }
                  
                  
                  foreach ($class->getConstants() as $CONSTANT => $value)
                  {   
                    echo "+".$CONSTANT.": const = ". $value."<br/>";
                  }
                  
                  
                  
                  echo "</div> <div class=\"square\">";
                  
                  foreach ($class->getMethods() as $method)
                  {
                  
                      $method->setAccessible(true);
                  
                    if ($method->isPublic())
                    {
                      echo '+';
                    }
                    elseif ($method->isProtected())
                    {
                      echo '#';
                    }
                    else
                    {
                      echo '-';
                    }
                    
                    if ($method->isStatic())
                    {
                        echo "<span class=\"underline\">";
                    }
                    if ($method->isAbstract())
                    {
                        echo "<span class=\"italic\">";
                    }
                    if ($method->isFinal())
                    {
                        echo "<<leaf>> ";
                    }
                    echo $method->getName()."(";
                  
                    $params = $method->getParameters();
                    foreach ($params as $param) {
                        //$param is an instance of ReflectionParameter
                    
                        //echo $param->getName();
                        //echo $param->isOptional();
                        echo $param->getName().":"."type  "; //$param->getType();
                    }
                  
                    echo "):";
                  
                  
                    //echo $method->getReturnType();
                    echo "<br/>";
                  
                    if ($method->isConstructor())
                    {
                        echo "    ---- Je suis le constructeur !<br/>";
                    }
                  }

                  // $content = fopen("uploads/tempo.php", 'rb');
                  // $content = fopen("uploads/".$_FILES['monfichier']['name'], 'rb');
                  /*
                  $write = fread($content, $_FILES['monfichier']['size'] );
                  echo nl2br($write)."<br/>";
                  echo strpos($write, "class")."</br>";*/

                  /*
                  while(!feof($content))
                  {
                    $line = fgets($content);
                    echo nl2br($line)."||||";

                    $val1 = "class";
                    $val2 = "protected";
                    $val3 = "public";

                    if (strpos($line, $val1) !== false)
                    {
                      echo $line;
                    }
                  }
                  */
                  echo "</div><br/><p>Opérations réussies !</p>";  
                }
                
                else
                {
                    echo "<p>Pas la bonne extension de fichier, mettez des fichiers PHP uniquement!</p>";
                    // avec un zavell working.pfi , on a bien une erreur d'extension
                }
                                                                     
               /* }
                else
                {
                    echo "<p>Pas la bonne extension de fichier, mettez des images uniquements!</p>";
                    // avec un zavell working.pfi , on a bien une erreur d'extension
                }*/
        }
        else
        {
            echo "<p>Le fichier est trop volumineux :" , $_FILES['monfichier']['size'] , "</p>";
        }
}
else
{
    echo "<p>Aucun fichier n'a été envoyé, ou le fichier comprend des erreurs.</p>";
    // LG3 = Pas la bonne extension
    // LG1 = Fichier comporte des erreurs : ?!
    // Caractéristiques : LG3 = 2 Mo, et LG1 = 3,74 Mo, extensions m4a pour les deux
    // LG2 = 0,95 Mo et il fonctionne.
    // Donc si fichier trop gros en vidéo, on a des erreurs? Et pas le message "trop volumineux", bizarre
}

*/
?>

-->


</body>
</html>