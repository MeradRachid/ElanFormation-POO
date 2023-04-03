<?php

    $topics = $result["data"]['topics'];
    
?>

<h1>~ Bienvenue ~</h1>
<h2 class="text-center"> Listes des Topics </h2>

<button type="submit" class="rounded p-1 border-success" style="max-width: 18rem;">Create a New Topic</button>

<div class="d-flex justify-content-center">
    
    <?php
        foreach($topics as $topic)
        {
    ?>
        <div class="card border-success m-3 text-center" style="max-width: 18rem;">
            <div class="card-header bg-transparent border-success"><?=$topic->getCreationDate()?></div>
            <div class="card-body text-success">
                <h5 class="card-title"><a href="index.php?ctrl=forum&action=detailTopic&id=<?=$topic->getId()?>" class="text-reset text-decoration-none"><?=$topic->getTopicTitle()?></a></h5>
                <form action="index.php?ctrl=forum&action=like&id=<?=$topic->getId()?>" method="post">
                    <button type="submit" class="rounded p-1 border-info" disabled>Liked <?= $topic->getLikes() ? "(" .$topic->getLikes(). ")" : ""  ?> </button>
                </form>
            </div>
            <div class="card-footer bg-transparent border-success"><a href="index.php?ctrl=forum&action=detailUser&id=<?=$topic->getUser()->getId()?>" class="text-decoration-none">By : <?= $topic->getUser()->getUserName() ?> </a></div>
        </div>

        <?php  
            ($topic->getUser()->getId() == App\Session::getUser()->getId() || App\Session::getUser()->hasRole("ROLE_ADMIN"))
            ? '<a href="#"><img src="public/img/unlock-solid.svg" width="75%" height="75%" alt="penToSquare"></a>
                <a href="#"><img src="public/img/lock-solid.svg" width="75%" height="75%" alt="trash"></a>'
            : ""
        ?> 

    <?php
        }    
    ?>
</div>
