<?php
    function chargerClasse($classe)
    {
      require $classe . '.php';
    }

    spl_autoload_register('chargerClasse');

    
    session_start();


    require_once("PDOFactory.php");

   // $db = new PDO('mysql:host=localhost;', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)); 
    // Now, we have the PDOFactory

    $db = PDOFactory::getMysqlConnexion();
    $sql = file_get_contents('bdd_test.sql');

    $qr = $db->exec($sql);

    $manager = new NewsManagerPDO($db); // Notre manager
    
?>

<a href="index.php">Retourner vers l'index...</a>

<form action="" method="post">
<p>Quelle page souhaitez-vous consulter?
        <select name="page">
          <option value="admin">Page d'administration</option>
          <option value="user">Page de visite</option>
        </select>
        <input type="submit" value="Executer" />
</p>
</form>

<?php

if(isset($_POST['page']))
{
    $_SESSION['page'] = $_POST['page'];
}

if (isset($_SESSION['page']))
{
    if($_SESSION['page'] == 'admin')
    {

        if (isset($_GET['modifier']))
        {
          $news = $manager->getNews((int) $_GET['modifier']);
        }
        
        if (isset($_GET['supprimer']))
        {
          $manager->delete((int) $_GET['supprimer']);
          $message = 'La news a bien été supprimée !';
        }
        
        if (isset($_POST['auteur']))
        {
          $news = new News(
            [
              'auteur' => $_POST['auteur'],
              'titre' => $_POST['titre'],
              'contenu' => $_POST['contenu']
            ]
          );
          
          if (isset($_POST['id']))
          {
            $news->setId($_POST['id']);
          }
          
          if ($news->isValid())
          {
            $manager->save($news);
            
            $message = $news->isNew() ? 'La news a bien été ajoutée !' : 'La news a bien été modifiée !';
          }
          else
          {
            $erreurs = $news->erreurs();
          }
        }
        ?>
        <!DOCTYPE html>
        <html>
          <head>
            <title>Administration</title>
            <meta charset="utf-8" />
            
            <style type="text/css">
              table, td {
                border: 1px solid black;
              }
              
              table {
                margin:auto;
                text-align: center;
                border-collapse: collapse;
              }
              
              td {
                padding: 3px;
              }
            </style>
          </head>
          
          <body>
            
            <form action="Page_des_News.php" method="post">
              <p style="text-align: center">
        <?php
        if (isset($message))
        {
          echo $message, '<br />';
        }
        ?>
                <?php if (isset($erreurs) && in_array(News::AUTEUR_INVALIDE, $erreurs)) echo 'L\'auteur est invalide ou trop court.<br />'; ?>
                Auteur : <input type="text" name="auteur" value="<?php if (isset($news)) echo $news->auteur(); ?>" /><br />
                
                <?php if (isset($erreurs) && in_array(News::TITRE_INVALIDE, $erreurs)) echo 'Le titre est invalide ou trop court.<br />'; ?>
                Titre : <input type="text" name="titre" value="<?php if (isset($news)) echo $news->titre(); ?>" /><br />
                
                <?php if (isset($erreurs) && in_array(News::CONTENU_INVALIDE, $erreurs)) echo 'Le contenu est invalide ou trop court.<br />'; ?>
                Contenu :<br /><textarea rows="8" cols="60" name="contenu"><?php if (isset($news)) echo $news->contenu(); ?></textarea><br />
        <?php
        if(isset($news) && !$news->isNew())
        {
        ?>
                <input type="hidden" name="id" value="<?= $news->id() ?>" />
                <input type="submit" value="Modifier" name="modifier" />
        <?php
        }
        else
        {
        ?>
                <input type="submit" value="Ajouter" />
        <?php
        }
        ?>
              </p>
            </form>
            
            <p style="text-align: center">Il y a actuellement <?= $manager->count() ?> news. En voici la liste :</p>
            
            <table>
              <tr><th>Auteur</th><th>Titre</th><th>Date d'ajout</th><th>Dernière modification</th><th>Action</th></tr>
        <?php
        foreach ($manager->getList() as $news)
        {
          echo '<tr><td>', $news->auteur(), '</td><td>', $news->titre(), '</td><td>', $news->dateAjout()->format('d/m/Y à H\hi'), '</td><td>', 
          ($news->dateAjout() == $news->dateModif() ? '-' : $news->dateModif()->format('d/m/Y à H\hi')), '</td><td><a href="?modifier=', $news->id(), '">Modifier</a> | <a href="?supprimer=', $news->id(), '">Supprimer</a></td></tr>', "\n";
        }
        ?>
            </table>
          </body>
        </html>

        <?php
    }




    elseif($_SESSION['page'] == 'user')
    {

?>
        
<!DOCTYPE html>
<html>
  <head>
    <title>Accueil du site</title>
    <meta charset="utf-8" />
  </head>
  
  <body>
<?php
if (isset($_GET['id']))
{
?>
<a href="Page_des_News.php">Retourner à la liste des news...</a>
<?php
  $news = $manager->getNews((int) $_GET['id']);
  
  echo '<p>Par <em>', $news->auteur(), '</em>, le ', $news->dateAjout()->format('d/m/Y à H\hi'), '</p>', "\n",
       '<h2>', $news->titre(), '</h2>', "\n",
       '<p>', nl2br($news->contenu()), '</p>', "\n";
  
  if ($news->dateAjout() != $news->dateModif())
  {
    echo '<p style="text-align: right;"><small><em>Modifiée le ', $news->dateModif()->format('d/m/Y à H\hi'), '</em></small></p>';
  }
}

else
{
  echo '<h2 style="text-align:center">Liste des 5 dernières news</h2>';
  
  foreach ($manager->getList(0, 5) as $news)
  {
    if (strlen($news->contenu()) <= 200)
    {
      $contenu = $news->contenu();
    }
    
    else
    {
      $debut = substr($news->contenu(), 0, 200);
      $debut = substr($debut, 0, strrpos($debut, ' ')) . '...';
      
      $contenu = $debut;
    }
    
    echo '<h4><a href="?id=', $news->id(), '">', $news->titre(), '</a></h4>', "\n",
         '<p>', nl2br($contenu), '</p>';
  }
}
?>
  </body>
</html>
<?php

    }


}

?>