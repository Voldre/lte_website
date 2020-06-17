
<?php

require_once("FileReader.php");

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
    }
}



?>

</body>
</html>