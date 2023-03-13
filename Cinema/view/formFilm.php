
<?php ob_start(); ?>
<div class="container-fluid d-flex flex-column align-items-center">
    <h1> ADD Movie </h1>
    <form action="index.php?action=addFilm" method="POST">
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
            <label for="rating">Rating Score :</label>
            <input type="number" class="form-control" id="rating" name="rating" min='0' max='5' step="0.1" required>
        </div>
        
        <button type="submit" name="submit" class="d-flex flex-column align-items-center btn btn-primary mb-3">Validate</button>
    </form>
</div>
<?php

$titre = "Ajout Film"; 
$titre_secondaire = "ajouter film";
    $contenu = ob_get_clean();
    require "view/template.php";        
?>

        <!-- <div class="form-group mb-1">
            <label for="director">Director :</label>
            <input type="text" class="form-control" id="director" name="director">
        </div>

        <div class="form-group mb-3">
            <label for="synopsis">Synopsis :</label>
            <textarea class="form-control" id="synopsis" name="synopsis">Type a short synopsis here...</textarea>
        </div> -->