
<?php ob_start(); ?>

    <div class="d-flex flex-row justify-content-evenly">
        <div class="card text-bg-info m-3" style="max-width: 35rem;">
            <div class="card-header"></div>
            <div class="card-body d-flex flex-column align-items-center justify-content-start">
                <h4 class="card-title">Movie informations</h4>
                <p class="card-text">
                    <?php
                        foreach($requete->fetchAll() as $id => $film)
                        { ?>                 
                                <p> Title : <?= $film["movie_title"] ?> </p>
                                <p> Released on : <?= $film["release_date"] ?> </p>
                                <p> Duration : <?= $film["duration"] ?> minutes </p> 
                                <p> Directed by : <?= $film["identity"] ?> </p> 
                                <p> <?= $film["poster"] ?> </p>
                  <?php } ?>
                </p>
            </div>
        </div>

        <div class="card flex-fill text-bg-info m-3" style="max-width: 35rem;">
            <div class="card-header"> </div>
            <div class="card-body">
                <h4 class="card-title text-center">Starring : </h4>
                <div class="d-flex flex-wrap">
                    <p class="card-text">
                        <?php
                            foreach($requete3->fetchAll() as $id => $film)
                            { ?>
                                <p class="justify-content-center text-center" style="width: 200px"> 
                                    #<?= $id+1 ?> <?= $film["firstName"] ?>, <?= $film["lastName"] ?> <br> <?= $film["poster"] ?>
                                </p>
                      <?php } ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
        
<?php

$titre = "Detail du Film"; 
$titre_secondaire = "Detail du film";
    $contenu = ob_get_clean();
    require "view/template.php";        
?>