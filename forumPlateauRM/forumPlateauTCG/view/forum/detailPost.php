<?php
    $posts = $result["data"]['posts'];  
?>

    <h1>~ Bienvenue ~</h1>

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