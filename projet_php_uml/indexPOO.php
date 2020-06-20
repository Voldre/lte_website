
<?php

require_once("FileTransfer.php");
require_once("FileReader.php");
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

foreach ($_FILES as $file) // Lire TOUS LES FICHIERS ENVOYEES
{
  if (!empty($file['name'])) // Vérifie et compte le nombre de fichier présents
  {

    
  echo "<section class=Section_".$index.">";

  $Transfile[$index] = new FileTransfer($file);
  $Transfile[$index]->SaveFile();
  $Transfile[$index]->OpenFile();


  $File[$index] = new FileReader($Transfile[$index]->name());
  $File[$index]->Draw_UML_Format();

  echo "</section>";

  $Transfile[$index]->DeleteFile();

  $index++;
  }
  else
  {
    //echo "Un fichier manquant";
  }

}

//echo $Transfile[1]->name();

  /*
if ( isset($_FILES['monfichier']) )
{
  $Transfile_1 = new FileTransfer($_FILES['monfichier']);
  $Transfile_1->SaveFile();
  $Transfile_1->OpenFile();

  $File_1 = new FileReader($Transfile_1->name());
  $File_1->Draw_UML_Format();

  $Transfile_1->DeleteFile();
}
  */


?>

</body>
</html>