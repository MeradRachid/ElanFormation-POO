
<?php ob_start(); ?>
<div class="container-fluid d-flex flex-column align-items-center">
    <h1> ADD Actor </h1>
    <form action="index.php?action=addActor" method="post" class="d-flex flex-column align-items-center">
        <input type="text" name="firstName" placeholder="Firstname">
        <input type="text" name="lastName" placeholder="Lastname">
        <input type="date" name="birthDate" placeholder="Birthdate">
        <input type="text" name="gender" placeholder="Gender">
        <button type="submit" name="submit">Validate</button>
    </form>      
</div>
<?php

$titre = "Ajout Acteur"; 
$titre_secondaire = "ajouter acteur";
    $contenu = ob_get_clean();
    require "view/template.php";        
?>