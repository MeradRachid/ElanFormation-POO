<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\CategoryManager;
    use Model\Managers\TopicManager;
    use Model\Managers\PostManager; 
    use Model\Managers\UserManager;

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
        // public function detailPost($id)
        // {
        //     $postManager = new PostManager();
        //     return 
        //     [
        //         "view" => VIEW_DIR."forum/detailTopic.php",
        //         "data" => 
        //         [
        //             "posts" => $postManager->findByTopic($id, ["creationDate", "ASC"])
        //         ]
        //     ];
        // }

    }

?>
