<?php

    $posts = $result["data"]['posts'];

    $topic = $result['data']['topic']

?>

<h1>~ Bienvenue ~</h1>
<h2 class="text-center"> Messages du Topic</h2>


<form action="index.php?ctrl=forum&action=like&id=<?=$topic->getId()?>" method="post">
    <button type="submit">Liked <?= $topic->getLikes() ? "(" .$topic->getLikes(). ")" : "" ?></button>
</form>

<?php
    foreach($posts as $post)
    {
?>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                <th> 

                    <?=$post->getCreationDate()?> <?= $topic->getTopicTitle(); ?> 

                </th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <tr>
                    <td>
                        <em> <?=$post->getMessage()?> </em>                        
                    </td>
                </tr>                
            </tbody>
        </table>
<?php        
        var_dump($topic->getLikes());
    }
?>



<?php

// var_dump($topic);   
?>
