<?php

$title = 'Page d\'erreur'; 

ob_start();

echo "<p class=\"red\"> Erreur : " . $e->getMessage() . "</p>";

$content = ob_get_clean();

require('template.php'); ?>