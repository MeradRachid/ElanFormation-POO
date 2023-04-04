<?php

    $categories = $result["data"]['categories'];
    
?>

<h1 class="text-center">~ Bienvenue ~</h1>
<h2 class="text-center"> Catégories du Forum</h2>

<form action="index.php?ctrl=forum&action=categoryForm" method="post" enctype="multipart">
    <button type="submit" class="rounded p-1 border-success" style="max-width: 18rem;">Create a New Category</button>
</form>

<div class="d-flex justify-content-center">

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

</div>
