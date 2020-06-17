<?php

require_once("Draw.php");

class FileReader extends ReflectionClass // implements Draw
{
    protected   $content,
                $class_name,
                $reflection,
                $attributs,
                $constants,
                $methods,
                $instance;

    const PAS_UNE_CLASSE = 1;
    
    
    public function __construct($tmp_class_name)
    {
      $this->hydrate($tmp_class_name);

    }

    public function hydrate($tmp_class_name)
  {
    if (class_exists($tmp_class_name))
    {
    $this->setContent();
    $this->setClass_name($tmp_class_name);
    $this->setReflection();
    $this->setAttributs();
    $this->setConstants();
    $this->setMethods();
    }
    else
    {
        //return self::PAS_UNE_CLASSE;
        echo "Il n'y a pas de classe ".$tmp_class_name."!";
    }
    
  }

    // GETTER

    public function content() { return $this->content ;}
    public function class_name() { return $this->class_name ;}
    public function reflection() { return $this->reflection ;}
    public function attributs() { return $this->attributs ;}
    public function constants() { return $this->constants ;}
    public function methods() { return $this->methods ;}

    // SETTER

    public function setContent()
    {
        ob_start();
        require_once("uploads/tempo.php");
        $this->content = ob_get_clean();
    }

    public function setClass_name($value)
    {
        $this->class_name = $value;
    }

    public function setReflection()
    {
        $this->reflection = new ReflectionClass($this->class_name);
    }

    
    public function setAttributs()
    {
        $this->attributs = $this->reflection->getProperties();
    }

    public function setConstants()
    {
        $this->constants = $this->reflection->getConstants();
    }

    public function setMethods()
    {
        $this->methods = $this->reflection->getMethods();
    }
    // Fonctionnalité

    public function Draw_UML_Format()
    {
        $this->isChild();

        $isAbstractClass = $this->isAbstractClass();
        $this->DrawSquareName($this->class_name, $isAbstractClass);

            ob_start();
            $this->UML_Format("attributs");

            foreach($this->constants as $element => $value)
            {
                echo "+".$element.": const = ". $value."<br/>";
            }
            $contentTable2 = ob_get_clean();
        $this->DrawSquare($contentTable2);

        ob_start();
        $this->UML_Format("methodes");
        $contentTable3 = ob_get_clean();
        $this->DrawSquare($contentTable3);
        
    }




    public function UML_Format($type)
    {
        if ($type == "attributs")
        {
            $list = $this->attributs;
        }
        if ($type == "methodes")
        {
            $list = $this->methods;
        }

        foreach ($list as $element)
        {
            $element->setAccessible(true);
            
            if ($element->isPublic())
            {
                echo '+';
            }
            elseif ($element->isProtected())
            {
                echo '#';
            }
            else
            {
                echo '-';
            }
            
            
            if ($element->isStatic())
            {
                echo "<span class=\"underline\">";
            }
            if($type == "methodes")
            { 
                if ($element->isAbstract()){ echo "<span class=\"italic\">";} 
            }
            echo $element->getName();
            if($type == "methodes")
            {
                echo "(";
            }
            else
            {
                echo ": ";
            }
            
            if (!$this->isAbstractClass() && $type == "attributs")
            {
                $var = gettype($element->getValue($this->instance));
                echo $var."<br/>";
            }
            
            if ($type == "methodes")
            {
                if( $element->isFinal() ) { echo "<<leaf>> "; }

                $params = $element->getParameters();
                foreach ($params as $param) 
                {
                    //$param is an instance of ReflectionParameter
                    //echo $param->getName();
                    //echo $param->isOptional();
                    echo $param->getName().": "."type "; //$param->getType();
                }
            echo "):<br/>";
            }
            $element->setAccessible(false); // désactiver l'accès aux attributs (privé et protégé)

        }

       
    }

    public function isChild()
    {   
        if($parent = $this->reflection->getParentClass())
        {
            echo "<br/>La classe parente de".$this->class_name." est :  <strong>", $parent->getName(),"</strong><br/> ";
        }
        else
        {
            echo "La classe ".$this->class_name." n'a pas de parent.";
        }
    }
    
    public function isAbstractClass()
    {

        if (!$this->reflection->isAbstract())
        {
            $class_name = $this->class_name;
            $objet = new $class_name();
            $isAbstractClass = false;

            $this->instance = $objet;

            $isAbstractClass = false; // Permet d'afficher les types des attributs!
            // Si on fait un return sans créer $isAbstractClass, alors on les voient pas!
        }
        else
        {
          $isAbstractClass = true; // Write name class in Italic
        }

        return $isAbstractClass;
    }
    
    // IMPLETEMENTATION
    
    public function DrawSquare($content)
    {
        echo "<div class=\"square\">".$content."</div>";   
    }

    public function DrawSquareName($content, $isAbstract)
    {
        if ($isAbstract)
        {
            $this->DrawSquare("<h5 class=\"italic\">".$content."</h5>");
        }
        else
        {
            $this->DrawSquare("<h5>".$content."</h5>");
        }
    }
}

