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
            $likeManager = new LikeManager();
        
            $topicId = isset($_GET['topic_id']) ? $_GET['topic_id'] : null; // Vérifiez que le paramètre topic_id est défini
        
            return 
            [
                "view" => VIEW_DIR."forum/listTopics.php",
                "data" => [
                    "topics" => $topicManager->findAll(["creationDate", "ASC"]),
                    "likes" => $likeManager->updateLikes($topicId), // Transmettez l'ID du topic à la méthode updateLikes()
                ]
            ];

        }

        public function detailTopic($id)
        {
            $postManager = new PostManager();
            $topicManager = new TopicManager();

            return 
            [
                "view" => VIEW_DIR."forum/detailTopic.php",
                "data" => 
                [
                    "posts" => $postManager->findByTopic($id),

                    "topic" => $topicManager->findOneById($id)
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
                    "topics" => $topicManager->findByCategory($id)
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


/*
        public function liked()
        {
            // if button submit pressed 
            // if(!isset($_POST['submit']))
            // {
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
                    $likeManager->add([ "user_id" => $user, "topic_id" => $topic ]);
                    header("location:index.php?ctrl=forum&action=detailTopic&id=".$topic); 
                    // $this->redirectTo("forum","listTopic");
                } 
                 else
                 {
                    $likeManager->deleteLike($topic, $user);
                    //  and redirect to the topic page 
                    //  $this->redirectTo("forum","listTopic");   
                    header("location:index.php?ctrl=forum&action=detailTopic&id=".$topic);
                 } // the user has already liked the topic then delete the like from db 

                 $likeManager->updateLikes($topic);
                 // } 
                }                
*/

        public function like()
        { 
            // if button submit pressed
            if(empty($_POST))
            { 
                $likeManager = new LikeManager(); 
            
                // get the user in session 
                $user = SESSION::getUser()->getId(); 
            
                // get the id of the topic 
                $topic = $_GET['id']; 
            
                // look if there is a dublicate of the user and the topic 
                $userLike=$likeManager->findOneByPseudo($user, $topic); 
                
                // $TopicLike=$likeManager->findOneByTopic($topic); 

                // if the user hasn't liked the topic then 
                if (!$userLike) 
                { 
                    $likeManager->add([ "user_id" => $user, "topic_id" => $topic, ]);
                    header("location:index.php?ctrl=forum&action=detailTopic&id=".$topic); 
                }
                else    
                {
                    // else if the user has already liked the topic then delete the like from db 
                    $likeManager->deleteLike($topic, $user); // and redirect to the topic page 
                    header("location:index.php?ctrl=forum&action=detailTopic&id=".$topic); 
                }
                // count the number of like on a topic 
                $likeManager->updateLikes($topic);
            } 

        }


    }

?>
