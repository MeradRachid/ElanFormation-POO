<?php

    $users = $result["data"]['users'];
    
?>

<h1 class="text-center">~ Bienvenue sur Users List ~</h1>

<ul class="d-flex justify-content-center align-items-center">

    <?php
        foreach($users as $user)
        {
    ?>
            <div class=" m-1" style="width: 30%">
                    <a href="index.php?ctrl=forum&action=detailUser&id=<?=$user->getId()?>" class="text-decoration-none text-reset"> 
                    <div class="card">
                    <img src="public/img/mjsoul.png" class="card-img-top" alt="Users List">
                    <div class="card-body text-center">
                        <h5 class="card-title"><?=$user->getUserName()?></h5>
                        <p><small> Joined us in : <?=$user->getRegisterDate()?></small></p>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    </div>
                </div>
            </div>

            <!-- <div class="card text-bg-dark m-3" style="width: 18rem;">
            <a href="index.php?ctrl=forum&action=detailCategory&id=<?php ?>" class="text-decoration-none text-reset">
                <img src="public/img/image.png" class="card-img" style="width: 18rem;" alt="detail category">
                <div class="card-img-overlay">
                    <h5 class="card-title"><?php ?></h5>
                    <p class="card-text"><small> Created in : <?php ?></small></p>
                </div>
            </a>
        </div> -->
        
    <?php
        }
    ?>

</ul>
