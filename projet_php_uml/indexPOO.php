
<?php

require_once("FileTransfer.php");
require_once("FileReader.php");

function DrawIfHeritage($i,$j)
{
  if($i == 0)
  {    $x1 = 55; $y1 = 45;  }
  if($j == 0)
  {    $x2 = 60;   $y2 = 35;  }

  if($i == 1)
  {    $x1 = 145;    $y1 = 40;  }
  if($j == 1)
  {    $x2 = 140;    $y2 = 30;  }

  if($i == 2)  
  {    $x1 = 190;    $y1 = 55;  }
  if($j == 2)
  {    $x2 = 205;    $y2 = 35;  }

  if($i == 3)
  {    $x1 = 60;    $y1 = 100;  }
  if($j == 3)
  {    $x2 = 55;    $y2 = 100;  }

  if($i == 4)
  {    $x1 = 150;    $y1 = 115;  }
  if($j == 4)
  {    $x2 = 135;    $y2 = 115;  }

  
  if($i == 5)
  {    $x1 = 205;    $y1 = 100;  }
  if($j == 5)
  {    $x2 = 205;    $y2 = 100;  }

  echo "<line x1=".$x2." y1=".$y2." x2=".$x1." y2=".$y1." class=\"arrow\" />";
}


/*
if (isset($_FILES['monfichier']) AND $_FILES['monfichier']['error'] == 0)
{
    if ($_FILES['monfichier']['size'] <= 7000000) // 7 000 000 = 7Mo
    {
        $infosfichier = pathinfo($_FILES['monfichier']['name']); 
        $extension_upload = $infosfichier['extension'];        

        $extensions_autorisees = array('php'); // On définie un tableau d'extensions autorisées
        if (in_array($extension_upload, $extensions_autorisees)) 
        {
          move_uploaded_file($_FILES['monfichier']['tmp_name'], 'uploads/' . basename("tempo.php")); // Renommé
                                  
          require_once("uploads/tempo.php");

          $filename = basename($_FILES['monfichier']['name'],'.php'); // On isole le nom du fichier

          $File = new FileReader($filename);
          
          $File->Draw_UML_Format();


        //  var_dump($File);
        }
        else
        {
          echo "Extension non-autorisée";
        }
    }
    else
    {
      echo "Ce fichier est trop lourd, il doit être inférieur à 7Mo, poids : ".$_FILES['monfichier']['size']." octets.";
    }
}
else
{
  echo "Le fichier n'a pas pu être envoyé, réessayez ultérieurement.";
}
*/


$index = 0;       


echo "<div class=\"Myclass\">";

foreach ($_FILES as $file) // Lire TOUS LES FICHIERS ENVOYEES
{
  if (!empty($file['name'])) // Vérifie et compte le nombre de fichier présents
  {
    echo "<section class=Section_".$index.">";


    echo "<strong>C".($index + 1 )."</strong>";

    $Transfile[$index] = new FileTransfer($file);
    $Transfile[$index]->SaveFile(false);
    $Transfile[$index]->OpenFile();


    $File[$index] = new FileReader($Transfile[$index]->name());


    $File[$index]->Draw_UML_Format(false);

    echo "</section>";
    //echo "<svg class=Section_".$index."></svg>";

    $Transfile[$index]->DeleteFile();

    $index++;
  }
  else
  {
    //echo "Un fichier manquant";
  }

}

    // ---------------------- Programmation pour la V2 ! ---------------------- 

/*
$tab = array();

for ($i=0 ; $i < $index; $i++)
{
  if (  isset($File[$i]) && isset($File[$i+1])  ) 
  {
    if ( $File[$i+1]->isChildOf( $File[$i] ) )
    {
      echo $File[$i+1]->class_name()." est bien un enfant de ".$File[$i]->class_name();

      $tab[] = $i;
    }
    else
    {
      echo $File[$i+1]->class_name()." n'est pas un enfant de ".$File[$i]->class_name();
    }
  }
}
*/

if ($index != 0)
{
  echo "<div class=\"table_veritee\">";
  echo "<img class=\"table_veritee\" src=\"working php uml.png\" />"; 

  ob_start();
  ?>
    <svg>
    <defs>
        <marker id="markerArrow" markerWidth="13" markerHeight="13" refX="2" refY="6" orient="auto">
            <path d="M2,2 L2,11 L10,6 L2,2" style="fill: #000000;" />
            <path d="M3,2 L3,10 L8,6 L3,3" style="fill: grey;" />
        </marker>
    </defs>
      <!--<line x1="10" y1="0" x2="110" y2="100" class="arrow" />-->
  <?php
  echo ob_get_clean();
  
  for($i = 0; $i < $index ; $i++)
  {
    for($j = 0; $j < $index ; $j++)
    {

      if ($i != $j) // On ne compare pas 2 fichiers identique
      {
        if($File[$j]->isChildOf( $File[$i] ) )
        {

         DrawIfHeritage($i,$j);
         // echo "<p>moi child ".$j." et moi mother ".$i."</p>";

        }
      }

    }
  }
  
}

/*
  ob_start();
?>

  <svg width="1390">
  <defs>
      <marker id="markerArrow" markerWidth="13" markerHeight="13" refX="2" refY="6" orient="auto">
          <path d="M2,2 L2,11 L10,6 L2,2" style="fill: #000000;" />
      </marker>
  </defs>
<?php
  echo ob_get_clean();

  foreach ($tab as $value)
  {
      if($value == 0 || $value == 1)
      {
        $x1 = 395 + $value*465;
        $x2 = 445 + $value*465;
    
        echo "<line x1=".$x1." y1=\"320\" x2=".$x2." y2=\"320\" class=\"arrow\" />";
        }
      if($value == 3 || $value == 4)
      {
        {
          $x1 = 395 + ($value - 3)*465;
          $x2 = 445 + ($value - 3)*465;
      
          echo "<line x1=".$x1." y1=\"820\" x2=".$x2." y2=\"820\" class=\"arrow\" />";
          }
      }
    }
    */
  ?>

</svg>

</div>

</body>
<!--
<script type="text/javascript">
     var index = <?php //echo json_encode($tab); ?>;
      var div1 = document.getElementById("Section_"+$index[0]).offsetHeight;
      document.querySelector('#value').innerHTML = div1;

      </script>
-->

</html>