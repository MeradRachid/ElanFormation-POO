<?php $category_id = $_POST['category_id']; 

var_dump($category_id);

?>
<div class="d-flex justify-content-center">

    <form action="index.php?ctrl=forum&action=addTopic" method="POST" class="m-3 d-flex flex-column justify-content-center">

        <input type="hidden" name="category_id" value="<?=$category_id?>">

        <input type="text" name="topicTitle" placeholder=" Topic Title " class="rounded p-1 m-1 text-center" required> <br>
        
        <textarea name="message" cols="30" rows="10" placeholder="Start your message here.." class="form-control rounded p-1 m-1 text-center" style="width : 18rem; height: 18rem; overflow-wrap: break-word;" required></textarea>
        
        <button type="submit" class="rounded p-1 m-1 border-success" style="max-width: 18rem;"> Add New Topic </button> <br>

    </form>

</div>
