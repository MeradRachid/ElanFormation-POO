<?php
    $posts = $result["data"]['posts'];  
?>

    <h1>~ Bienvenue sur List Posts ~</h1>

    <?php
        foreach($posts as $post)
        {
    ?>
        <ul>
            <li> 
                <?=$post->getMessage()?>
             </li>
        </ul>

<?php
        }    
        
?>