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
        
            $likes = 0; // Valeur par défaut si $topicId n'est pas défini 

            if (isset($topicId)) 
            {
                $likes = $likeManager->countLikes($topicId);
                $_SESSION['likes'] = $likes;
            } 
            elseif (isset($_SESSION['likes'])) 
            {
                $likes = $_SESSION['likes'];
            }
        
            return 
            [
                "view" => VIEW_DIR."forum/listTopics.php",
                "data" => 
                [
                    "topics" => $topicManager->findAll(["creationDate", "ASC"]),
                    "likes" => $likes
                ]
            ];
        }

        

        public function detailTopic($id)
        {
            $postManager = new PostManager();
            $topicManager = new TopicManager();
            $likeManager = new LikeManager();

            // Récupérer le nombre de likes à partir de la session, s'il existe
            $likes = isset($_SESSION['likes']) ? $_SESSION['likes'] : null;

            // Si le nombre de likes n'est pas enregistré en session, le récupérer de la base de données
            if(!$likes) 
            {
                $likes = $likeManager->countLikes($id);

                // Enregistrer le nombre de likes en session
                $_SESSION['likes'] = $likes;
            }

            return 
            [
                "view" => VIEW_DIR."forum/detailTopic.php",
                "data" => 
                [
                    "posts" => $postManager->findByTopic($id),
                    "topic" => $topicManager->findOneById($id),
                    "likes" => $likes
                ]
            ];

        }

        public function topicForm()
        {
            
            return
            [
                "view" => VIEW_DIR."security/topicForm.php",
                $category_id = $_POST['category_id'],
                var_dump($category_id) 
            ];
        }

        public function addTopic()
        {
            // if submit is pressed
            if(!empty($_POST))
            {
                $category_id = filter_input(INPUT_POST, "category_id", FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
                $topicTitle = filter_input(INPUT_POST, "topicTitle", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $message = filter_input(INPUT_POST, "message", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                
                if($topicTitle && $message && $category_id)
                {
                    $user_id = SESSION::getUser()->getId();

                    // var_dump($category_id, $user_id, $topicTitle);
                    // die();

                    $topicManager = new TopicManager();

                    $topicManager->add(["category_id" => $category_id, "user_id" => $user_id, "topicTitle" => $topicTitle]);



                    // // Ajout d'un message de succès
                    SESSION::addFlash("success", "Bravo, votre topic à bien été créé !");

                    $this->redirectTo("forum","detailCategory", $category_id);
                }
                else
                {
                    // Ajout d'un message d'erreur
                    SESSION::addFlash("error", "Une erreur s'est produite, votre topic n'a pas été créé !");

                    // Redirection
                    $this->redirectTo("forum","detailCategory", $category_id);
                }

            }
            else
            {                
                // Ajout d'un message d'erreur
                SESSION::addFlash("error", "Saisie incorrecte, votre topic n'a pas été créé !");
    
                // Redirection
                $this->redirectTo("forum","listCategories");
            }
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
                    "category" => $id,
                    "topics" => $topicManager->findByCategory($id)
                ]
            ];
        }

        public function categoryForm()
        {
            return
            [
                "view" => VIEW_DIR."security/categoryForm.php",
            ];
        }

        public function addCategory()
        {
            // if submit is pressed
            if(!empty($_POST))
            {
                $categoryName = filter_input(INPUT_POST, "categoryName", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                
                if($categoryName)
                {
                    $categoryManager = new CategoryManager();

                    $categoryManager->add(["categoryName" => $categoryName]);

                    // Ajout d'un message de succès
                    SESSION::addFlash("success", "Bravo, votre catégorie à bien été créé !");

                    $this->redirectTo("forum","listcategories");
                }
                else
                {
                    // Ajout d'un message d'erreur
                    SESSION::addFlash("error", "Une erreur s'est produite, votre catégorie n'a pas été créé !");

                    // Redirection
                    $this->redirectTo("forum","categoryForm");
                }

            }
            else
            {                
                // Ajout d'un message d'erreur
                SESSION::addFlash("error", "Saisie incorrecte, votre catégorie n'a pas été créé !");
    
                // Redirection
                $this->redirectTo("forum","categoryForm");
            }
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
            if(empty($_POST))
            { 
                $likeManager = new LikeManager(); 
            
                // get the user in session 
                $user = SESSION::getUser()->getId(); 
            
                // get the id of the topic 
                $topic = $_GET['id']; 
            
                // look if there is a dublicate of the user and the topic 
                $userLike=$likeManager->findOneByPseudo($user, $topic); 

                // if the user hasn't liked the topic then 
                if (!$userLike) 
                { 
                    $likeManager->add([ "user_id" => $user, "topic_id" => $topic ]);
                    header("location:index.php?ctrl=forum&action=detailTopic&id=".$topic); 
                }
                else    
                {
                    // else if the user has already liked the topic then delete the like from db 
                    $likeManager->deleteLike($topic, $user); // and redirect to the topic page 
                    header("location:index.php?ctrl=forum&action=detailTopic&id=".$topic); 
                }
                // count the number of like on a topic 
                $likeManager->countLikes($topic);
            } 

        }


    }

?>
