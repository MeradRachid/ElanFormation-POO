<?php
    $posts = $result["data"]['posts'];  
?>

    <h1>~ Bienvenue sur Posts List ~</h1>

    <?php
        foreach($posts as $post)
        {
    ?>
        <ul>
            <li> 
                <a href="index.php?ctrl=forum&action=detailPost&id=<?=$post->getId()?>" class="text-decoration-none"> <?=$post->getCreationDate()?> </a>
             </li>
        </ul>

<?php
        }    
        
?>
