
<?php ob_start(); ?>
<h1> ADD Director </h1>
<form action="index.php?action=addDirector" method="post">
<input type="text" name="firstName" placeholder="Firstname">
    <input type="text" name="lastName" placeholder="Lastname">
    <button type="submit" name="submit">Validate</button>
</form>      
<?php

$titre = "Ajout Réalisateur"; 
$titre_secondaire = "ajouter realisateur";
    $contenu = ob_get_clean();
    require "view/template.php";        
?>