<?php

    $categories = $result["data"]['categories'];
    
?>

<h1 class="text-center">~ Bienvenue sur Categories List ~</h1>

<ul class="d-flex justify-content-center">

    <?php
        foreach($categories as $category)
        {
    ?>

        <div class="card text-bg-dark m-3" style="width: 18rem;">
            <a href="index.php?ctrl=forum&action=detailCategory&id=<?=$category->getId()?>" class="text-decoration-none text-reset">
                <img src="public/img/image.png" class="card-img" style="width: 18rem;" alt="detail category">
                <div class="card-img-overlay">
                    <h5 class="card-title"><?=$category->getCategoryName()?></h5>
                    <p class="card-text"><small> Created in : <?=$category->getCreationDate()?></small></p>
                </div>
            </a>
        </div>

    <?php
        }
    ?>

</ul>
