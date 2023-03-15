<?php ob_start(); ?>

    <div class="card d-flex flex-row justify-content-center">
        <div class="card d-flex text-bg-info m-3">
            <div class="card-header mb-3"></div>
            <h4 class="card-title text-center">Popular Movies</h4>
            <div class="card-body d-flex">
                <p class="card-text">

                    <div class="card flex-fill text-bg-info m-3" style="max-width: 35rem;">
                        <div class="card-header"> </div>
                        <div class="card-body">
                            <h4 class="card-title text-center"> Movie 1 Preview </h4>
                            <p class="card-text">
                                <a href="index.php?action=detailFilm&id=1" data-bs-toggle='Movie Preview' data-bs-title="Movie 1 Preview"><img src="public/img/films/LoR01_FoR.jpg"></a>
                            </p>
                        </div>
                    </div>

                    <div class="card flex-fill text-bg-info m-3" style="max-width: 35rem;">
                        <div class="card-header"> </div>
                        <div class="card-body">
                            <h4 class="card-title">Movie 2 Preview</h4>
                            <p class="card-text">
                            </p>
                        </div>
                    </div>

                    <div class="card flex-fill text-bg-info m-3" style="max-width: 35rem;">
                        <div class="card-header"> </div>
                        <div class="card-body">
                            <h4 class="card-title">Movie 3 Preview</h4>
                            <p class="card-text">
                            </p>
                        </div>
                    </div>

                    <div class="card flex-fill text-bg-info m-3" style="max-width: 35rem;">
                        <div class="card-header"> </div>
                        <div class="card-body">
                            <h4 class="card-title">Movie 4 Preview</h4>
                            <p class="card-text">
                            </p>
                        </div>
                    </div>
                    
                    <div class="card flex-fill text-bg-info m-3" style="max-width: 35rem;">
                        <div class="card-header"> </div>
                        <div class="card-body">
                            <h4 class="card-title">Movie 5 Preview</h4>
                            <p class="card-text">
                            </p>
                        </div>
                    </div>

                </p>
            </div>
        </div>
    </div>

<?php

$titre = "Page d'accueuil"; 
$titre_secondaire = "Homepage";
    $contenu = ob_get_clean();
    require "view/template.php";        
?>