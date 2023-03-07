
<?php ob_start(); ?>

<div class="container">
    <!-- <h5>Add a movie</h5> -->
    <form action="#" method="POST">
        <div class="form-group mb-1">
            <label for="movie_title">Movie Title :</label>
            <input type="text" class="form-control" id="movie_title" name="movie_title" required>
        </div>
        <div class="form-group mb-1">
            <label for="release_date">Release Date :</label>
            <input type="date" class="form-control" id="release_date" name="release_date" required>
        </div>
        <div class="form-group mb-1">
            <label for="duration">Duration :</label>
            <input type="time" class="form-control" id="duration" name="duration" required>
        </div>
        <div class="form-group mb-1">
            <label for="director">Director :</label>
            <input type="text" class="form-control" id="director" name="director" required>
        </div>
        <div class="form-group mb-3">
            <label for="synopsis">Synopsis :</label>
            <textarea class="form-control" id="synopsis" name="synopsis" required>Type a short synopsis here...</textarea>
        </div>
        <button type="submit" name="submit" class="btn btn-primary mb-3">Add a movie</button>
    </form>
</div>
<p class="badge text-bg-info m-1 fs-5"> There are <?= $requete->rowCount() ?> films. </p>
<table class="table table-striped-columns table-sm table-hover"> 
    <thead>
        <tr>
            <th> # </th>
            <th> MOVIE TITLE </th>
            <th> RELEASED ON </th>
            <th> DURATION </th>
        </tr>
    </thead>

    <tbody class="table-group-divider">
       <?php
            foreach($requete->fetchAll() as $id => $film)
             { ?>
                <tr>
                    <td><a href="index.php?action=detailFilm&id=<?= $id+1 ?>"> <?= $id+1 ?> </a></td>
                    <td> <?= $film["movie_title"] ?> </td>
                    <td> <?= $film["release_date"] ?> </td>
                    <td> <?= $film["duration"] ?> </td>
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