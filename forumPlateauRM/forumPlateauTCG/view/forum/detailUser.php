<h1>~ Bienvenue sur User Detail ~</h1>

<?php
    $user = $result["data"]['user'];
    // var_dump($user);
?>
    <p> 
        <?=$user->getUserName()?> <br>
        <em> <?=$user->getRegisterDate()?> </em>
    </p>
    <p class="text-justify">
        -- Afficher la liste des posts ou topics -- <br>
         ~ Que l'user à créé d'une part..  
           et dans lesquels l'user à posté d'autre part ~ <br>
           => (findTopics & findPosts ByUser($id))


    </p>
