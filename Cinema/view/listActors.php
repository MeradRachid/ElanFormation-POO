
<?php ob_start(); ?>

<p class="badge text-bg-info m-1 fs-5"> There are <?= $requete->rowCount() ?> actors. </p>

<button><a href="index.php?action=addActorForm" class="text-decoration-none text-reset">ADD Actor</a></button>

<table class="table table-striped-columns table-sm table-hover"> 
    <thead>
        <tr>
            <th> # </th>
            <th> FIRSTNAME </th>
            <th> LASTNAME </th>
            <th> GENDER </th>
        </tr>

    </thead>
    <tbody class="table-group-divider">
        <?php
            foreach($requete->fetchAll() as $id => $film)
            { ?>
                <tr>
                    <td> <?= $id+1 ?> </td>
                    <td> <?= $film["firstName"] ?> </td>
                    <td> <?= $film["lastName"] ?> </td>
                    <td> <?= $film["gender"] ?> </td>
                </tr>
      <?php } ?>
    </tbody>
</table>

<?php

$titre = "Liste des Acteurs"; 
$titre_secondaire = "Liste des acteurs";
    $contenu = ob_get_clean();
    require "view/template.php";        
?>