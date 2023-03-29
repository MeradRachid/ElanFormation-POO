<?php
    $user = $result["data"]['user'];
    // var_dump($user);
    ?>

<h1>~ Bienvenue ~</h1>
<h2 class="text-center"> Détail du Profil</h2>

    <p> 
        <?=$user->getUserName()?> <br>
        <em> <?=$user->getRegisterDate()?> </em>
    </p>
    <p class="text-justify"> To do list : <br>
        -- Afficher la liste des posts ou topics -- <br>
         ~ Que l'user à créé d'une part..  
           et dans lesquels il a participé d'autre part ~ <br>
           => (findTopics & findPosts ByUser($id)) ? 
    </p>
