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
        
            // Vérifiez que le paramètre topic_id est défini 
            $topicId = isset($_GET['topic_id']) ? $_GET['topic_id'] : null; 
        
            if (isset($topicId)) 
            {
                $likes = $likeManager->countLikesByTopic($topicId);
                $_SESSION['likes'] = $likes;
            } 
            elseif (isset($_SESSION['likes'])) 
            {
                $likes = $_SESSION['likes'];
            }
        
            // Récupérer le nombre de likes de $id à partir de la session, s'il existe
            $likes = isset($_SESSION['likes'][$topicId]) ? $_SESSION['likes'][$topicId] : null;
        
            if(!$likes) // Si le nombre de likes n'est pas enregistré en session, le récupérer dans la base de données
            {
                $likes = $likeManager->countLikesByTopic($topicId);
        
                // Mettre à jour le tableau $_SESSION['likes'] avec le nombre de likes pour le topic correspondant
                $_SESSION['likes'][$topicId] = $likes;
            }
            
            $topics = $topicManager->findAll(["creationDate", "ASC"]); // déclarer la variable $topics
        
            return 
            [
                "view" => VIEW_DIR."forum/listTopics.php",
                "data" => 
                [
                    "topics" => $topics,
                    "likes" => $likes
                ]
            ];
        }
                

        public function detailTopic($id)
        {
            $postManager = new PostManager();
            $topicManager = new TopicManager();
            $likeManager = new LikeManager();
        
            // Récupérer le nombre de likes de $id à partir de la session, s'il existe
            $likes = isset($_SESSION['likes'][$id]) ? $_SESSION['likes'][$id] : null;
        
            // Si le nombre de likes n'est pas enregistré en session, le récupérer dans la base de données
            if(!$likes) 
            {
                $likes = $likeManager->countLikesByTopic($id);
        
                // Mettre à jour le tableau $_SESSION['likes'] avec le nombre de likes pour le topic correspondant
                $_SESSION['likes'][$id] = $likes;
            }
        
            return [
                "view" => VIEW_DIR."forum/detailTopic.php",
                "data" => [
                    "posts" => $postManager->findByTopic($id),
                    "topic" => $topicManager->findOneById($id),
                    "likes" => $likes
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



        public function like($id)
        { 
            // if button submit pressed
            if(empty($_POST))
            { 
                $likeManager = new LikeManager(); 
            
                // get the user in session 
                $user = SESSION::getUser()->getId(); 
            
                // get the id of the topic 
                $topic = $id; 
            
                // look if there is a dublicate of the user and the topic 
                $userLike=$likeManager->findOneByPseudo($user, $topic); 

                // if the user hasn't liked the topic then 
                if (!$userLike) 
                { 
                    $likeManager->add([ "user_id" => $user, "topic_id" => $topic]);
                    header("location:index.php?ctrl=forum&action=detailTopic&id=".$topic); 
                }
                else    
                {
                    // else if the user has already liked the topic then delete the like from db 
                    $likeManager->deleteLike($topic, $user); 
                    // and redirect to the topic page 
                    $this->redirectTo("forum","topic", $id); 
                }
                
                // count the number of like on a topic 
                $likes = $likeManager->countLikesByTopic($topic);

                // Mettre à jour le tableau $_SESSION['likes'] avec le nombre de likes pour le topic correspondant
                $_SESSION['likes'][$id] = $likes;

            } 

        }


    }

?>
