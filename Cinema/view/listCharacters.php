<?php ob_start(); ?>

<p class="badge text-bg-info m-1 fs-5"> There are <?= $requete->rowCount() ?> characters. </p>

<table class="table table-striped-columns table-sm table-hover"> 
    <thead>
        <tr>
        <th> # </th>
            <th> CHARACTERS </th>
        </tr>

    </thead>
    <tbody class="table-group-divider">
        <?php
            foreach($requete->fetchAll() as $id => $film)
            { ?>
                <tr>
                    <td> <?= $id ?> </td>
                    <td> <?= $film["character_name"] ?> </td>
                </tr>
      <?php } ?>
    </tbody>
</table>

<?php

$titre = "Liste des Rôles"; 
$titre_secondaire = "Liste des rôles";
    $contenu = ob_get_clean();
    require "view/template.php";        
?>