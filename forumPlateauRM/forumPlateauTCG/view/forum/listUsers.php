<?php

    $users = $result["data"]['users'];
    
?>

<h1 class="text-center">~ Bienvenue ~</h1>
<h2 class="text-center"> Listes des Membres </h2>

<div class="d-flex ">

    <?php
        foreach($users as $user)
        {
    ?>
            <div class="m-1">
                    <a href="index.php?ctrl=forum&action=detailUser&id=<?=$user->getId()?>" class="text-decoration-none text-reset"> 
                    <div class="card">
                    <img src="public/img/mjsoul.png" class="card-img-top" alt="Users List">
                    <div class="card-body text-center">
                        <h5 class="card-title"><?=$user->getUserName()?></h5>
                        <p><small> Joined us in : <br> <?=$user->getRegisterDate()?></small></p>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    </div>
                </div>
            </div>
        
    <?php
        }
    ?>

</div>
