<?php           // English names!

function DB_stats()
{                                                                // Not english words
    $db = DB_connect();
    $stats = $db ->query('SELECT ID, ID_article, COUNT(ID_article) AS nombre_commentaires, Content  FROM commentaires GROUP BY ID_article ');
    return $stats;
}

function DB_comments()
{    
    $db = DB_connect();
    $answer = $db ->query('SELECT * FROM articles ORDER BY date_creation DESC LIMIT 5');    
    return $answer;
}


function DB_connect()
{
    try {   

        $db = new PDO('mysql:host=localhost;dbname=test', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)); 
        return $db; // Don't forget to return the db variable

        }
        catch (Exception $e)
        {
                die('Erreur : ' . $e->getMessage());
        }  

}

// Don't close the PHP Tag