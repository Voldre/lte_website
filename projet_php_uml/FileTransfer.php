<?php

require_once("Draw.php");

class FileTransfer
{
    protected   $file,
                $name,
                $extension,
                $tmp_name;

    const EXTENSIONS_ALLOW = 'php';
    
    
    public function __construct($tmp_file)
    {
      $this->hydrate($tmp_file);

    }

    public function hydrate($tmp_file)
  {
    if ($tmp_file['error'] == 0)
    {
    $this->setFile($tmp_file);
    $this->setExtension();
    $this->setName($tmp_file);
    $this->setTmp_name($tmp_file);
    }
    else
    {
        echo "Le fichier n'a pas pu être envoyé, réessayez ultérieurement.";
    }
    
  }

    // GETTER

    public function file() { return $this->file ;}
    public function extension() { return $this->extension;}
    public function name() { return $this->name ;}
    public function tpm_name() { return $this->tmp_name ;}

    // SETTER

    public function setFile($tmp_file)
    {
        $this->file = pathinfo($tmp_file['name']); 
    }

    public function setExtension()
    {
        $this->extension = $this->file['extension'];


    }

    public function setName($tmp_file)
    {
        $this->name = basename($tmp_file['name'],'.php');
    }

    public function setTmp_name($tmp_file)
    {
        $this->tmp_name = $tmp_file['tmp_name'];
    }


    
    // Fonctionnalité

    public function SaveFile()
    {
        if (in_array ($this->extension, array(self::EXTENSIONS_ALLOW) ) ) 
        {
            echo "Le fichier a bien été sauvegardé sous le nom : <strong>tempo_".$this->name.".php</strong> !";
            move_uploaded_file($this->tmp_name, 'uploads/' . basename("tempo_".$this->name.".php")); // Renommé
        }
        else
        {
            echo "Extension non-autorisée";
        }
    } 
    /*
    public function SaveFile($index)
    {

        if (preg_match("#^[a-z0-9]+\.[a-z]+$#",$index))
        {
            echo "Le fichier a bien été sauvegardé sous le nom : <strong>tempo_".$index.".php</strong> !";
        move_uploaded_file($this->file, 'uploads/' . basename("tempo_".$index.".php")); // Renommé
        }
        else
        {
            echo "Ce nom de fichier est invalide : <strong>tempo_".$index.".php</strong> !";
        }
        
    }
    */



    public function OpenFile()
    {
        if (file_exists("uploads/tempo_".$this->name.".php") )
        {
            require_once("uploads/tempo_".$this->name.".php");
        }
        else
        {
            echo "Le fichier n'existe pas, sauvegardez le avant avec SaveFile()";
        } 
    }
/*
    public function OpenFile($index)
    {
        if (file_exists("tempo_".$index.".php")
        {
            require_once("tempo_".$index.".php");
        }
        else
        {
            echo "Le fichier n'existe pas, sauvegardez le avant avec SaveFile(nom)";
        }
    }*/

    public function DeleteFile()
    {
        if (file_exists("uploads/tempo_".$this->name.".php") )
        {
            unlink("uploads/tempo_".$this->name.".php");
        }
    }
    
}

