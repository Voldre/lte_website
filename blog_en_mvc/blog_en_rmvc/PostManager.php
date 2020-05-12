<?php

namespace Voldre\Blog\Model ;

class PostManager extends Manager
{
    public function DB_articles_home()
    {
        $db = $this->DB_connect();  
         // $this-> CAR on appelle la fonction de CETTE classe, c'est une fonction membre (donc préciser sa classe). CETTE = $this, c'est "la classe actuelle ou parent"
        $answer = $db ->query('SELECT * FROM articles ORDER BY date_creation DESC LIMIT 5');    
        return $answer;
    }

    public function DB_show_article($articleID)
    {
        $db = $this->DB_connect();    
        $request = $db ->prepare('SELECT * FROM articles INNER JOIN membres ON membres.ID = articles.ID_auteur WHERE articles.ID = ? ORDER BY date_creation DESC LIMIT 5');                                          
    
          $request->execute(array($articleID));
    
          return $request;
    }

    public function DB_stats()
    {                                                                // Not english words
        $db = $this->DB_connect();
        $stats = $db ->query('SELECT ID, ID_article, COUNT(ID_article) AS nombre_commentaires, Content  FROM commentaires GROUP BY ID_article ');
        return $stats;
    }
}