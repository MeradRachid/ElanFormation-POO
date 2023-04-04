<?php

    $posts = $result["data"]['posts'];

    $topic = $result['data']['topic'];

    $like = $result["data"]["likes"];

    // var_dump($result["data"]["likes"]); 
?>

<h1>~ Bienvenue ~</h1>
<h2 class="text-center"> Messages du Topic <?=$topic->getTopicTitle()?> </h2>


<form action="index.php?ctrl=forum&action=like&id=<?=$topic->getId()?>" method="post">
    <button type="submit" class="rounded p-1 border-info">Liked <?= $like ? "(" . $like . ")" : "" ?> </button>
</form>


<?php
    if (!empty($posts)) 
    {
        echo '<label class="label-info text-center alert alert-warning" role="alert"> No post found here. Be the first to create one : </label> <br>
              <form action="index.php?ctrl=forum&action=postForm" method="post" enctype="multipart/form-data">
                  <input type="hidden" name="topic_id" value="'.$topic->getId().'">
                  <button type="submit" name="'.$topic->getId().'" class="rounded p-1 border-success" style="max-width: 18rem;">Create a New Message</button>
              </form>';
        
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
    }
    else
    {
        echo '<label class="label-info text-center alert alert-warning" role="alert"> No post found here. Be the first to create one : </label> <br>
                <form action="index.php?ctrl=forum&action=postForm" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="topic_id" value="'.$topic->getId().'">
                    <button type="submit" name="'.$topic->getId().'" class="rounded p-1 border-success" style="max-width: 18rem;">Create a New Message</button>
                </form>';

    }
?>

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
