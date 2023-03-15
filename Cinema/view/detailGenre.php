<?php ob_start(); ?>

    <div class="d-flex flex-row justify-content-evenly">
        <div class="card text-bg-info m-3" style="max-width: 35rem;">
            <div class="card-header"></div>
            <div class="card-body d-flex flex-column align-items-center justify-content-start">
                <h4 class="card-title">Movie Genre informations</h4>
                <p class="card-text">
                    <?php
                        foreach($requete->fetchAll() as $id => $film)
                        { 
                    ?>
                        <p>
                            <a href="index.php?action=detailFilm&id=<?= $id+2 ?>"> <?= $id+1 ?> </a> : <a class="text-decoration-none text-reset" href="index.php?action=detailFilm&id=<?= $id+2 ?>"> <?= $film["movie_title"] ?> </a>
                        </p>
                    <?php 
                        } 
                    ?>
                </p>
            </div>
        </div>
    </div>
<?php

$titre = "Détail des Genres"; 
$titre_secondaire = "details genres";
    $contenu = ob_get_clean();
    require "view/template.php";        
?>