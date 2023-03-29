<h1>~ Bienvenue sur Topic Detail ~</h1>

<?php

    $posts = $result["data"]['posts'];
?>

<?php
    foreach($posts as $post)
    {
?>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                <th> <?=$post->getCreationDate()?> </th>
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
        //    var_dump($post);
    }
?>



<?php

// var_dump($topic);   
?>
