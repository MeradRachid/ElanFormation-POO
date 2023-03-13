
<?php ob_start(); ?>

<p class="badge text-bg-info m-1 fs-5"> There are <?= $requete->rowCount() ?> movie genres. </p>

<button><a href="index.php?action=addGenreForm" class="text-decoration-none text-reset">ADD Genre</a></button>

<table class="table table-striped-columns table-sm table-hover"> 
    <thead>
        <tr>
            <th> # </th>
            <th> MOVIE GENRE </th>
        </tr>

    </thead>
    <tbody class="table-group-divider">
        <?php
            foreach($requete->fetchAll() as $id => $film)
            { ?>
                <tr>
                    <td> <?= $id+1 ?> </td>
                    <td> <?= $film["genre_name"] ?> </td>
                </tr>
      <?php } ?>
    </tbody>
</table>

<?php

$titre = "Liste des Genres"; 
$titre_secondaire = "Liste des genres";
    $contenu = ob_get_clean();
    require "view/template.php";        
?>