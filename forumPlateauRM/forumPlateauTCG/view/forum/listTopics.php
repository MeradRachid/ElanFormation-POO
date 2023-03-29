<?php

    $topics = $result["data"]['topics'];
    
?>

<h1>~ Bienvenue ~</h1>
<h2 class="text-center"> Listes des Topics </h2>

<div class="d-flex justify-content-center">

    <?php
        foreach($topics as $topic)
        {
    ?>
        <div class="card border-success m-3 text-center" style="max-width: 18rem;">
            <div class="card-header bg-transparent border-success"><?=$topic->getCreationDate()?></div>
            <div class="card-body text-success">
                <h5 class="card-title"><a href="index.php?ctrl=forum&action=detailTopic&id=<?=$topic->getId()?>" class="text-reset text-decoration-none"><?=$topic->getTopicTitle()?></a></h5>
                <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
            </div>
            <div class="card-footer bg-transparent border-success"><a href="index.php?ctrl=forum&action=detailUser&id=1" class="text-decoration-none">By : Mac Intosh</a></div>
        </div>
        <?php ($topic->getUser()->getId() == App\Session::getUser()->getId() || App\Session::getUser()->hasRole("ROLE_ADMIN"))
            ? '<a href="#">
                <img src="public/img/unlock-solid.svg" width="75%" height="75%" alt="penToSquare">
               </a>

               <a href="#">
                <img src="public/img/lock-solid.svg" width="75%" height="75%" alt="trash">
               </a>'
            : "" 
        ?> 

    <?php
        }    
    ?>
</div>
