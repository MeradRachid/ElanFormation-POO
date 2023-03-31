<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\CategoryManager;
    use Model\Managers\TopicManager;
    use Model\Managers\PostManager; 
    use Model\Managers\UserManager;
    use Model\Managers\LikeManager;

    class ForumController extends AbstractController implements ControllerInterface
    {
        public function index()
        {
            $topicManager = new TopicManager();

            return 
            [
                "view" => VIEW_DIR."forum/listTopics.php",
                "data" => 
                [
                    "topics" => $topicManager->findAll(["creationDate", "ASC"])
                ]
            ];

        }

        public function detailTopic($id)
        {
            $postManager = new PostManager();

            return 
            [
                "view" => VIEW_DIR."forum/detailTopic.php",
                "data" => 
                [
                    "posts" => $postManager->findByTopic($id, ["creationDate", "ASC"])
                ]
            ];

        }



        public function listCategories()
        {
            $categoryManager = new CategoryManager();

            return 
            [
                "view" => VIEW_DIR."forum/listCategories.php",
                "data" => 
                [
                    "categories" => $categoryManager->findAll(["creationDate", "ASC"])
                ]
            ];
        }

        public function detailCategory($id)
        {
            $topicManager = new TopicManager();

            return 
            [
                "view" => VIEW_DIR."forum/detailCategory.php",
                "data" => 
                [
                    "topics" => $topicManager->findByCategory($id, ["creationDate", "ASC"])
                ]
            ];
        }



        public function listUsers()
        {
            $this->restrictTo("ROLE_ADMIN");
            $userManager = new UserManager();
            
            return 
            [
                "view" => VIEW_DIR."forum/listUsers.php",
                "data" => 
                [
                    "users" => $userManager->findAll(["registerDate", "ASC"])
                ]
            ];

        }

        public function detailUser($id)
        {
            $userManager = new UserManager();

            return 
            [
                "view" => VIEW_DIR."forum/detailUser.php",
                "data" => 
                [
                    "user" => $userManager->findOneById($id)
                ]
            ];

        }



        public function like()
        {
            // if button submit pressed 
            if(!isset($_POST['submit']))
            {
                $likeManager = new LikeManager(); 

                // get the user in session 
                $user = SESSION::getUser()->getId(); 

                // get the id of the topic 
                $topic = $_GET['id']; 

                // look if there is a dublicate of the user and the topic 
                $userLike=$likeManager->findOneByPseudo($user); 
                $TopicLike=$likeManager->findOneByTopic($topic);

                // if the user or the topic hasn't been liked yet then add to db 
                if (!$userLike || !$TopicLike) 
                { 
                    $likeManager->add([ "user_id" => $user, "topic_id" => $topic, ]);
                    // header("location:index.php?ctrl=forum&action=detailTopic&id=".$topic); 
                    $this->redirectTo("forum","detailTopic", $topic);
                } 
                 else
                 {
                     
                     $likeManager->deleteLike($topic, $user);
                    //  and redirect to the topic page 
                     $this->redirectTo("forum","detailTopic", $topic);   
                 } // the user has already liked the topic then delete the like from db 
 
            } 
        }



        // public function listPosts()
        // {
        //     $postManager = new PostManager();
        //     return 
        //     [
        //         "view" => VIEW_DIR."forum/listPosts.php",
        //         "data" => 
        //         [
        //             "posts" => $postManager->findAll(["creationDate", "ASC"])
        //         ]
        //     ];
        // }



    }

?>
