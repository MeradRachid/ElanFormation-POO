
<?php ob_start(); ?>
<div class="container-fluid d-flex flex-column align-items-center">
    <h1> ADD Genre </h1>
    <form action="index.php?action=addGenre" method="post" class="d-flex flex-column align-items-center">
        <input type="text" name="genre" placeholder="Add a new genre here">
        <button type="submit" name="submit">Validate</button>
    </form>      
</div>
<?php

$titre = "Ajout Genre"; 
$titre_secondaire = "ajouter genre";
    $contenu = ob_get_clean();
    require "view/template.php";        
?>