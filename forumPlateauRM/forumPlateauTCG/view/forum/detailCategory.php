<?php 

    $category_id = $result["data"]['category_id'];
    $category = $result["data"]['category'];
    $topics = $result["data"]['topics'];
    
?>

<h1>~ Bienvenue ~</h1>
<h2 class="text-center"> Topics de la Catégorie <?= $category->getCategoryName() ?> </h2>

<?php
    if (!empty($topics)) 
    {
        echo '<form action="index.php?ctrl=forum&action=topicForm" method="post" enctype="multipart/form-data">
              <input type="hidden" name="category_id" value="'.$category_id.'">
                  <button type="submit" name="'.$category_id.'" class="rounded p-1 border-success" style="max-width: 18rem;">Create a New Topic</button>
              </form>'; 
        
        foreach($topics as $topic) 
        {
?>
            <ul class="d-flex justify-content-center">
                <div class="card border-success mb-3 text-center" style="max-width: 18rem;">
                    <div class="card-header bg-transparent border-success"><?=$topic->getCreationDate()?></div>
                    <div class="card-body text-success">
                        <h5 class="card-title"><a href="index.php?ctrl=forum&action=detailTopic&id=<?=$topic->getId()?>" class="text-reset text-decoration-none"><?=$topic->getTopicTitle()?></a></h5>
                        <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
                    </div>
                    <div class="card-footer bg-transparent border-success"><a href="index.php?ctrl=forum&action=detailUser&id=1" class="text-decoration-none">By : Mac Intosh</div></a>
                </div>
            </ul>
<?php
        }
    }
    else
    {
        echo '<label class="label-info text-center alert alert-warning" role="alert"> No topics found here. Be the first to create one : </label> <br>
                <form action="index.php?ctrl=forum&action=topicForm" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="category_id" value="'.$category_id.'">
                    <button type="submit" name="'.$category_id.'" class="rounded p-1 border-success" style="max-width: 18rem;">Create a New Topic</button>
                </form>';

    }
?>

