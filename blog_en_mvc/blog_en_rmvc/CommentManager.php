<?php

namespace Voldre\Blog\Model ;

class CommentManager extends Manager
{
    public function DB_insert_comment($pseudo,$articleID,$content)
    { 
        $db = $this->DB_connect();  
         // $this-> CAR on appelle la fonction de CETTE classe, c'est une fonction membre (donc préciser sa classe). CETTE = $this, c'est "la classe actuelle ou parent"
        $requete_2 = $db ->prepare('INSERT INTO commentaires(Auteur, ID_article, Content, date_commentaire) VALUES (?, ?, ?, NOW() ) ');  
                                                                                            
        $requete_2 -> execute(array($pseudo,$articleID,$content));         
    }

    public function DB_show_comments($articleID)
    {
        $db = $this->DB_connect();
        $answer_comments = $db ->prepare('SELECT * FROM commentaires WHERE ID_article = ? ORDER BY date_commentaire DESC LIMIT 0,10');    
    
        $answer_comments -> execute(array($articleID));
        return $answer_comments;
    }

    public function DB_show_comment($commentID)
    {
        $db = $this->DB_connect();
        $comment = $db ->prepare('SELECT * FROM commentaires WHERE ID = ?');    
    
        $comment -> execute(array($commentID));
        return $comment;
    }

    public function DB_edit_comment($Auteur,$Content,$commentID)
    {
        $db = $this->DB_connect();
        $update_comment = $db ->prepare('UPDATE commentaires SET Auteur = ? , Content = ?, date_commentaire = NOW() WHERE ID = ? ');    
    
        $update_comment -> execute(array($Auteur,$Content,$commentID));
    }


    /*  HERITAGE : No need to define it
    private function DB_connect()
    {
        $db = new PDO('mysql:host=localhost;dbname=test', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)); 
        return $db; // Don't forget to return the db variable
    }
    */
}