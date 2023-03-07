
<?php ob_start(); ?>

<!-- <p class="badge text-bg-info m-1 fs-5"> There are <?php // $requete->rowCount() ?> films. </p> -->

    <div class="card d-flex flex-row justify-content-evenly">
        <div class="card text-bg-info m-3" style="max-width: 30em;">
            <div class="card-header"></div>
            <div class="card-body">
                <h4 class="card-title">Movie informations</h4>
                <p class="card-text">
                    <?php
                        foreach($requete->fetchAll() as $id => $film)
                            { ?>
                            <p> Movie ID : N°<?= $id ?> </p>
                            <p> Title : <?= $film["movie_title"] ?> </p>
                            <p> Released on : <?= $film["release_date"] ?> </p>
                            <p> Duration : <?= $film["duration"] ?> </p>
                    <?php } ?>
                </p>
            </div>
        </div>
        <div class="card flex-fill text-bg-info m-3" style="max-width: 35rem;">
            <div class="card-header"> </div>
            <div class="card-body">
                <h4 class="card-title">Cast informations</h4>
                <p class="card-text">
                    <?php
                        foreach($requete2->fetchAll() as $id => $film)
                         { ?>
                            <p> 
                                Actor ID : N°<?= $id ?> Firstname : <?= $film["firstName"] ?> Lastname : <?= $film["lastName"] ?> Gender : <?= $film["gender"] ?> 
                            </p>
                    <?php } ?>
                </p>
            </div>
        </div>
    </div>
<?php

$titre = "Detail du Film"; 
$titre_secondaire = "Detail du film";
    $contenu = ob_get_clean();
    require "view/template.php";        
?>