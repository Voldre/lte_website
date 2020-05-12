<?php           // English names!

function DB_connect()
{
    $db = new PDO('mysql:host=localhost;dbname=test', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)); 
    return $db; // Don't forget to return the db variable
}

// Home model

function DB_stats()
{                                                                // Not english words
    $db = DB_connect();
    $stats = $db ->query('SELECT ID, ID_article, COUNT(ID_article) AS nombre_commentaires, Content  FROM commentaires GROUP BY ID_article ');
    return $stats;
}

function DB_articles_home()
{    
    $db = DB_connect();
    $answer = $db ->query('SELECT * FROM articles ORDER BY date_creation DESC LIMIT 5');    
    return $answer;
}

// Article model

function DB_show_article($articleID)
{
    $db = DB_connect();    
    $request = $db ->prepare('SELECT * FROM articles INNER JOIN membres ON membres.ID = articles.ID_auteur WHERE articles.ID = ? ORDER BY date_creation DESC LIMIT 5');                                          

      $request->execute(array($articleID));

      return $request;
}

function DB_insert_comment($pseudo,$articleID,$content)
{ 
    $db = DB_connect();   
    $requete_2 = $db ->prepare('INSERT INTO commentaires(Auteur, ID_article, Content, date_commentaire) VALUES (?, ?, ?, NOW() ) ');  
                                                                                        
    $requete_2 -> execute(array($_POST['pseudo'],$articleID, $_POST['content']));         
}

function DB_show_comments($articleID)
{
    $db = DB_connect();
    $answer_comments = $db ->prepare('SELECT * FROM commentaires WHERE ID_article = ? ORDER BY date_commentaire DESC LIMIT 0,10');    

    $answer_comments -> execute(array($articleID));
    return $answer_comments;
}

// Don't close the PHP Tag