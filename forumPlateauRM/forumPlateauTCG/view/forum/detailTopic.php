<?php

    $posts = $result["data"]['posts'];

    $topic = $result['data']['topic'];

    $likes = isset($_SESSION['likes'][$topic->getId()]) ? $_SESSION['likes'][$topic->getId()] : null;

    // var_dump($result); 
?>

<h1>~ Bienvenue ~</h1>
<h2 class="text-center"> Messages du Topic <?= $topic->getTopicTitle() ?> </h2>

<form action="index.php?ctrl=forum&action=like&id=<?=$topic->getId()?>" method="post">
    <?php

        if (!is_null($likes)) 
        {
            echo '<button type="submit" class="rounded p-1 border-info"> Liked (' . $likes . ')</button>';
        } 
        else
        {
            echo '<button type="submit" class="rounded p-1 border-info"> Like it ! </button>';
        }

    ?>
</form>

<?php
    foreach($posts as $post)
    {
?>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                <th> 

                    <?=$post->getCreationDate()?>

                </th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <tr>
                    <td>
                        <?=$post->getMessage()?>   
                    </td>
                </tr>                
                <tr>
                    <td> 
                        <em> <a href="index.php?ctrl=forum&action=detailUser&id=<?=$topic->getUser()->getId()?>" class="text-decoration-none"> By : <?= $topic->getUser()->getUserName() ?> </a>, in <?= $topic->getTopicTitle() ?> </em>
                    </td>
                </tr>
            </tbody>
        </table>
<?php        

    }
?>



<?php
   
?>
