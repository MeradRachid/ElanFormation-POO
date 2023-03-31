<?php

    $posts = $result["data"]['posts'];

?>

<h1>~ Bienvenue ~</h1>
<h2 class="text-center"> Messages du Topic</h2>

<?php
    foreach($posts as $post)
    {
?>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                <th> 

                    <?=$post->getCreationDate()?>
                    
                    <form action="index.php?ctrl=forum&action=like&id=<?=$post->getId()?>" method="post">
                        <button type="submit">Like </button>
                    </form> 

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
           var_dump($_SESSION['user']);
    }
?>



<?php

// var_dump($topic);   
?>
