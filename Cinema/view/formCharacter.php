
<?php ob_start(); ?>
<div class="container-fluid d-flex flex-column align-items-center">
    <h1> ADD Character </h1>
    <form action="index.php?action=addCharacter" method="post" class="d-flex flex-column align-items-center">
        <input type="text" name="characterName" placeholder="New character name">
        <button type="submit" name="submit">Validate</button>
    </form>      
</div>
<?php
    $titre = "Ajout Personnage"; 
    $titre_secondaire = "ajouter personnage";
    $contenu = ob_get_clean();
    require "view/template.php";        
?>