
<?php ob_start(); ?>

<p class="badge text-bg-info m-1 fs-5"> There are <?= $requete->rowCount() ?> movies. </p> 

<button><a href="index.php?action=addFilmForm" class="text-decoration-none text-reset">ADD Movie</a></button>

<table class="table table-striped-columns table-sm table-hover"> 
    <thead>
        <tr>
            <th> # </th>
            <th> MOVIE TITLE </th>
            <th> RELEASED ON </th>
            <th> DURATION </th>
            <th> RATING </th>
        </tr>
    </thead>

    <tbody class="table-group-divider">
       <?php
            foreach($requete->fetchAll() as $id => $film)
             { ?>
                <tr>
                    <td><a href="index.php?action=detailFilm&id=<?= $id+1 ?>"> <?= $id+1 ?> </a></td>
                    <td><a class="text-decoration-none text-reset" href="index.php?action=detailFilm&id=<?= $id+1 ?>"> <?= $film["movie_title"] ?> </a></td>
                    <td><a class="text-decoration-none text-reset" href="index.php?action=detailFilm&id=<?= $id+1 ?>"> <?= $film["release_date"] ?> </a></td>
                    <td><a class="text-decoration-none text-reset" href="index.php?action=detailFilm&id=<?= $id+1 ?>"> <?= $film["duration"] ?> minutes </a></td>
                    <td><a class="text-decoration-none text-reset" href="index.php?action=detailFilm&id=<?= $id+1 ?>"> <?= $film["rating"] ?> /5 </a></td>
                </tr>
       <?php } ?>
    </tbody>
</table>

<?php

    $titre = "Liste des Films"; 
    $titre_secondaire = "Liste des films";
    $contenu = ob_get_clean();
    require "view/template.php";        

?>