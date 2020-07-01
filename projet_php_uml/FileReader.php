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
    if (class_exists($tmp_class_name) || interface_exists($tmp_class_name)) // Si c'est une classe ou une interface...
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
        throw new Exception("Il n'y a pas de classe ni d'interface s'appellant <strong>".$tmp_class_name."</strong> !");
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
        if ($this->isChild())
        {
            $parent = $this->reflection->getParentClass()->getName();
            if(!class_exists($parent))
            {
                throw new Exception("La classe <strong>".$this->class_name."</strong> possède une 
                classe parent <strong>".$parent."</strong> qui n'a pas été déclaré avant celle-ci.<br/>
                Veuillez déclarer <strong>".$parent."</strong> avant!");
            }
        }
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

        if($this->isInterface())
        {
            $this->DrawSquareName("&#60;&#60;interface&#62;&#62;<br/>".$this->class_name,  $isAbstractClass);
        }
        else    // Pas d'attribut pour une interface ! Sinon juste pas affiché
        {
            $this->DrawSquareName($this->class_name, $isAbstractClass);

                ob_start();
                $this->UML_Format("attributs");

                foreach($this->constants as $element => $value)
                {
                    echo "+".$element.": const = ". $value."<br/>";
                }
                $contentTable = ob_get_clean();
            $this->DrawSquare($contentTable);
        }
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
                true                            );
            return preg_match('/[>] ([A-z]+) /', $export, $matches)
                ? $matches[1] : null;
        }

        // A voir... ---------------------------------------------------------------------------------------------------------------------------------------
        /*
        public function getPropertyType(ReflectionProperty $property)
        {
            $export = ReflectionProperty::export($property->getDeclaringClass()->name,
                    $property->getName(), true );
            return preg_match('/[>] ([A-z]+) /', $export, $matches)
                ? $matches[1] : null;
        }*/



    public function UML_Format($type)
    {

        if ($type == "attributs")
        {
            $list = $this->attributs;
        }
        else if ($type == "methodes")
        {
            $list = $this->methods;
        }
        else
        {
            throw new Exception("Ce type de format n'existe pas \"".$type."\", choisissez le type \"methodes\" ou \"attributs\".");
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

            // SEARCH HOW WORKING IF INSTANCE NEEDS PARAMETERS
            
            if ($type == "attributs" /*&& !$this->isAbstractClass()*/)
            {
                // A voir... ---------------------------------------------------------------------------------------------------------------------------------------
                echo ":";//. $this->getPropertyType($element);
                echo "<br/>";
            }
            else if ($type == "methodes")
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
            echo "):";//.$param->getReturnType()
            echo "<br/>";
            }
            $element->setAccessible(false); // désactiver l'accès aux attributs (privé et protégé)
        }      
    }

    public function isChild($allow = false)
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
            return false;
        }
        else
        {
          return true; // Write name class in Italic
        }
    }

    public function getRepository()
    {
        return $this->reflection->getFileName();
                                //getShortName();
    }
    

    public function isInterface()
    {
        return $this->reflection->isInterface();
    }
    
    public function implementsInterface(FileReader $interface)
    {
        if(!class_exists($interface->class_name())) // Si l'interface envoyé est une classe, on ne fait rien, sinon ...
        { 
            return $this->reflection->implementsInterface( $interface->class_name() ) ;
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

