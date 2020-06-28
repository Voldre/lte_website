<?php

class FileReader 
{               //$content //(contient le contenu du fichier)
    protected   $class_name,
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
    //$this->setContent(); // Useless 

    // Voir comment automatiser ce processus

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

    public function class_name() { return $this->class_name ;}
    public function reflection() { return $this->reflection ;}
    public function attributs() { return $this->attributs ;}
    public function constants() { return $this->constants ;}
    public function methods() { return $this->methods ;}

    // SETTER

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

    public function Draw_UML_Format($allow = false)
    {
        $this->isChild($allow);

        $isAbstractClass = $this->isAbstractClass();
        $this->DrawSquareName($this->class_name, $isAbstractClass);

            ob_start();
            $this->UML_Format("attributs");

            foreach($this->constants as $element => $value)
            {
                echo "+".$element.": const = ". $value."<br/>";
            }
            $contentTable = ob_get_clean();
        $this->DrawSquare($contentTable);

        ob_start();
        $this->UML_Format("methodes");
        $contentTable_2 = ob_get_clean();
        $this->DrawSquare($contentTable_2);
        
    }


        // TEST POUR V2 avec tous les aspects techniques !
        // Come from :
        // https://stackoverflow.com/questions/36267390/how-to-get-parameter-type-in-reflected-class-method-php-5-x/36267781#36267781?newreg=810270cf45bc4bfaa86df3f482d0ce1f
        // And https://www.php.net/manual/fr/reflectionparameter.gettype.php
        public function getParameterType(ReflectionParameter $parameter)
        {
            $export = ReflectionParameter::export(
                array(
                    $parameter->getDeclaringClass()->name,
                    $parameter->getDeclaringFunction()->name
                ),
                $parameter->name,
                true
            );
            return preg_match('/[>] ([A-z]+) /', $export, $matches)
                ? $matches[1] : null;
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

            /* SEARCH HOW WORKING IF INSTANCE NEEDS PARAMETERS
            if (!$this->isAbstractClass() && $type == "attributs")
            {
                $var = gettype($element->getValue($this->instance));
                echo $var."<br/>";
            }
            */
            if ($type == "methodes")
            {
                echo "(";

                if( $element->isFinal() ) { echo "<<leaf>> "; }

                $params = $element->getParameters();
                foreach ($params as $param) 
                {
                    //$param is an instance of ReflectionParameter
                    //$param->getType();
                    //echo $param->getName();
                    //echo $param->isOptional();
                    //$object = $param->getClass();

                                        // Because we are above PHP 7
                    echo $param->getName().": ".$this->getParameterType($param); 
                }
            echo "):<br/>";
            }
            else if ($type == "attributs")
            {
                echo ":"."<br/>";
            }
            $element->setAccessible(false); // désactiver l'accès aux attributs (privé et protégé)
        }      
    }

    public function isChild($allow)
    {   
        if($parent = $this->reflection->getParentClass())
        {
            if($allow)
            { echo "<br/>La classe parente de ".$this->class_name." est :  <strong>", $parent->getName(),"</strong><br/> "; }
            return true; // usable in a condition
        }
        else
        {
            if($allow)
            { echo "<br/>La classe ".$this->class_name." n'a pas de parent."; }
            return false; // usable in a condition
        }
    }


            // AJOUT POUR LA FONCTION V2

    public function isChildOf(FileReader $parent) // On envoie forcément un objet FileReader
    {   
        if ($realParent = $this->reflection->getParentClass()) // Si un parent existe vraiment
        {
           //class_name() utilisable car $parent est un objet de FileReader
            if($parent->class_name() == $realParent->getName() ) // On compare son nom a celui envoyé
            {
                return true;
            }
            else    // Si faux, alors pas le bon
            {
                return false;
            }
        }   // Sinon, faux car pas de parent
        else { return false; }
    }


    
    public function isAbstractClass()
    {

        if (!$this->reflection->isAbstract())
        {
            /* SEARCH HOW WORKING IF INSTANCE NEEDS PARAMETERS
            $objet = new $this->$class_name();
            $this->instance = $objet;
            */

            return false; // Permet d'afficher les types des attributs!
            // Si on fait un return sans créer $isAbstractClass, alors on les voient pas!
        }
        else
        {
          return true; // Write name class in Italic
        }

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

