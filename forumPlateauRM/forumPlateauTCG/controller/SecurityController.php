<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Entities\User;
    use Model\Managers\CategoryManager;
    use Model\Managers\TopicManager;
    use Model\Managers\PostManager; 
    use Model\Managers\UserManager;
    
    class SecurityController extends AbstractController implements ControllerInterface
    {
        public function index()
        {
            
        }



        public function register()
        {
            if(!empty($_POST))
            {
                $nickname = filter_input(INPUT_POST, "userName", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $confirmPassword = filter_input(INPUT_POST, "confirmPassword", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
                // Attention, il faut aussi filtrer les avatars dans le cas où vous les demandez. 
            }

            if($nickname && $password && $email)
            {
                if(($password == $confirmPassword) and strlen($password) >= 8)
                {
                    $manager = new UserManager();
                    $user = $manager->findOneByUserName($nickname);

                    if(!$user)
                    {
                        $hash = password_hash($password, PASSWORD_DEFAULT);

                        if($manager->add([
                                            "userName" => $nickname,
                                            "email" => $email,
                                            "password" => $hash,
                                            "role" =>json_encode(['ROLE_USER']),
                                        ])) 
                        {

                        // Ajout d'un message de succès
                        SESSION::addFlash("success", "Bravo, votre compte à bien été créé !");

                        }
                    }

                }
            }
            return 
            [
                "view" => VIEW_DIR."security/login.php",
            ];
        }

             /**
             * Le mot de passe est hashé pour ne plus pouvoir être affiché en clair.
             * On suit les recommandations de l'OWASP & de la CNIL par mesure de sécurité.      
             * On ne compare ni les mots de passes en clair, ni leurs hashs.. 
             * Mais l'empreinte numérique après hashage (Voir aussi le SALT par la suite...) 
             * Md5() & sha1() sont des fonctions obsolètes car facilement crackable via force brute. 
             * On parle désormais de mots de passes faibles.. 
             * En opposition aux mots de passes forts comme B-Crypt & Argon-2i. 
             * Empreinte numérique = Algo + Cost + Salt + Hash.
             *  
             **/

        public function registerForm()
        {
            return
            [
                "view" => VIEW_DIR."security/register.php",
                "data" => null,
            ];
        }



        public function loginForm()
        {
            return
            [
                "view" => VIEW_DIR."security/login.php",
            ];
        }

        public function login()
        {            
            if(!empty($_POST))
            {
                $userName = filter_input(INPUT_POST, "userName", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            }
        
            if($userName && $password)
            {
                // Connexion à la base de données via le manager 
                $userManager = new UserManager();

                 // Requête SQL pour récupérer l'utilisateur correspondant au pseudo saisi
                $user = $userManager->findOneByUsername($userName);                
                
                if($user) 
                {
                    // On récupère le hash dans la base de données
                    $hash = $user->getPassword();

                    if(password_verify($password, $hash))
                    {

                        // Le mot de passe est correct, on met en session l'utilisateur connecté
                        // $_SESSION['user'] = $user;
    
                        SESSION::setUser($user);
            
                        // Ajout d'un message de connexion avec succès  
                        SESSION::addFlash("success", "Bravo " .$user->getUserName(). ", vous êtes bien connecté!");
            
                        // Redirection vers la page d'accueil
                        $this->redirectTo("homePage");
            
                        exit();

                    }

                }
                else 
                {

                    // Le mot de passe est incorrect, on affiche donc un message d'erreur
                    SESSION::addFlash("error", "Saisie incorrecte, l'identifiant ou le mot de passe n'est pas reconnu. Vous n'êtes pas connecté.");
        
                    $this->redirectTo("security", "loginForm");
                }  

            }
            else
            {
                // Ajout d'un message d'erreur
                SESSION::addFlash("error", "Saisie incorrecte, vous n'êtes pas connecté.");
        
                $this->redirectTo("security", "loginForm");
            }
        }
        


        public function logout()
        {
            
            // session_destroy(); // détruit la session en cours
            
            unset($_SESSION['user']); 

            return
            [
                "view" => VIEW_DIR."security/logout.php",
            ];
        }

        /**
         * Faille CSRF : CSRF vient de Cross-Site Request Forgery
         * Falsification de requête inter-sites en français.
         * 
         * Consiste à manipuler un utilisateur authentifié à son insu :
         * Par exemple en faisant passer un formulaire pirate pour un form legit. 
         * Ce qui donnera la possibilité d'agir sur le site.
         * La vigilance de l'utilisateur à ce moment là, étant proche du nul.
         * Il ne se méfiera pas et fera lui-meme l'action pirate.
         * 
         * Pour s'en prémunir, on utilisera des jetons 'Token' en session :
         * Qui seront hashé et modifié puis utilisé comme élément de comparaison.
         * ~ Le token ne sera pas visible (propriété hidden) et expire à la fin de la session.
         * Si le token en session n'est pas reconnu lors de l'envoi du formulaire : 
         * On arrête tout (déconnexion de l'user et retour à la case Home)
         * 
        **/

        public function modifyPassword()
        {

        }

         /**
         * Regex password sur stack overflow etc.. ~ Regex = Expression Régulière ~
         * Les frameworks ayant coutume de gérer les regexs.
         * On ne les fait généralement pas à la main.
         *   
         * Dans le filter input du password, au lieu de SANITIZE : 
         * 
         * FILTER_VALIDATE_REGEX, 
         * array("options" => array("regexp" => "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/" )); 
         * 
         * This regular expression cheks that a password :
         * At least one uppercase English letter. You can remove this condition by removing (?=.*?[A-Z])
         * At least one lowercase English letter.  You can remove this condition by removing (?=.*?[a-z])
         * At least one digit. You can remove this condition by removing (?=.*?[0-9])
         * At least one special character,  You can remove this condition by removing (?=.*?[#?!@$%^&*-])
         * Has minimum 8 characters in length. Adjust it by modifying {8,} 
         * 
         * Source : https://uibakery.io/regex-library/password-regex-php 
         * 
         * Imposer un maximum de 32 characters pour le password peut-être une bonne option.
         * 
         **/





    }