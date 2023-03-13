<!-- On "use" le controller Cinema 
     On autocharge les classes du projet 
     On instancie le controller Cinema Et en fonction de l'action détectée dans l'URL via la propriété "action" 
     On interagit avec la bonne méthode du controller  -->

<?php 
    use Controller\CinemaController;

    spl_autoload_register(function($class_name)
    {
        include $class_name.'.php'; 
    });

    $ctrlCinema = new CinemaController();

    // On aura toujours un namespace permettant de catégoriser virtuellement (dans un espace de nom la classe en question). 
    // Ainsi on pourra "use" la classe sans connaître son emplacement physique. 
    // On a juste besoin de savoir dans quel namespace elle se trouve, pratique !

    if(isset($_GET["action"]))
    {
        /**
         * N'oublions pas de faire passer l'id en paramètre pour afficher les détails d'un film : 
         * 
         * if(isset($_GET["action"]))
         *  {
         *      switch ($_GET["action"])
         *      {
         *          // Films
         *          case "listFilms" : $ctrlCinema->listFilms(); break;
         *          case "detailFilm" : $ctrlCinema->detailFilm($id); break;
         *      }
         *  }
         * 
         * Quand vous faites une requête dans lequel on a un élément variable 
         * (comme ici l'id de l'acteur), il faut bien faire un "prepare" (et pas un "query")
         * Pour ensuite pouvoir faire un "execute"
         * Notons que dans le "execute" on fait bien passer un tableau associatif, 
         * Qui associe le nom de champ paramétré avec la valeur de l'îd (celui passé dans la méthode : $id)
         * (Voir images/pj dans le dossier Cinema)
         */

            // $type = (isset($_GET["type"])) ? $_GET["type"] : null;
        $id = (isset($_GET["id"])) ? $_GET["id"] : null;

        switch ($_GET['action']) 
        {
            case "listFilms" : $ctrlCinema->listFilms();
                # code...
            break;
            case "detailFilm" : $ctrlCinema->detailFilm($id);
                # code...
            break;
            case "addFilmForm" : $ctrlCinema->addFilmForm();
                # code...
            break;
            case "addFilm" : $ctrlCinema->addFilm($_POST);
                # code...
            break;



            case "listActors" : $ctrlCinema->listActors();
                # code...
            break;
            case "detailActor" : $ctrlCinema->detailActor($id);
                # code...
            break;
            case "addActorForm" : $ctrlCinema->addActorForm();
                # code...
            break;
            case "addActor" : $ctrlCinema->addActor($_POST);
                # code...
            break;



            case "listCharacters" : $ctrlCinema->listCharacters();
                # code...
            break;
            case "detailCharacter" : $ctrlCinema->detailCharacter($id);
                # code...
            break;
            case "addCharacterForm" : $ctrlCinema->addCharacterForm();
                # code...
            break;
            case "addCharacter" : $ctrlCinema->addCharacter($_POST);
                # code...
            break;



            case "listDirectors" : $ctrlCinema->listDirectors();
                # code...
            break;
            case "detailDirector" : $ctrlCinema->detailDirector($id);
                # code...
            break;
            case "addDirectorForm" : $ctrlCinema->addDirectorForm();
                # code...
            break;
            case "addDirector" : $ctrlCinema->addDirector($_POST);
                # code...
            break;



            case "listGenres" : $ctrlCinema->listGenres();
                # code...
            break;
            case "detailGenre" : $ctrlCinema->detailGenre($id);
                # code...
            break;
            case "addGenreForm" : $ctrlCinema->addGenreForm();
                # code...
            break;
            case "addGenre" : $ctrlCinema->addGenre($_POST);
                # code...
            break;
            
            case "homePage" : $ctrlCinema->homePage();
        }

    }
    else
    {
        $ctrlCinema->homePage();
    }

?>


<!-- 
- Temporisation de sortie : 
 PHP peut bloquer l'envoi des données au navigateur grâce à la fonction ob_start() qui enclenche une temporisation de sortie. Cela signifie que tant qu'elle est enclenchée, aucune donnée, hormis les en-têtes, ne sera directement envoyée au navigateur, mais temporairement mises en tampon à la place. Cela laisse le temps de filtrer les données et d'en lire le contenu de manière plus sécurisé avant de l'effacer. 
 -> ob_get_clean : Lit le contenu courant du tampon de sortie puis l'efface.
 
- Requete http : 
 Une requête HTTP, acronyme de « Hypertext Transfer Protocol » renvoie au protocole HTTP utilisé par le navigateur web pour consulter un site internet. L'ordinateur de l'internaute, via un navigateur, envoie une requête au serveur web, qui lui apporte alors immédiatement une réponse en affichant la page web demandée.
 Le protocole HTTP connaît différentes méthodes de requête, comme GET, qui est l’ « ancêtre » des requêtes HTTP. Cette méthode de requête existe depuis le début du Web. Elle est utilisée pour demander une ressource, par exemple un fichier HTML, au serveur Web.

- Injection sql : 
 Les failles SQLi (injections SQL), est un groupe de méthodes qui exploitent les failles de sécurité en agissant sur la base de données, en injectant dans la requête un morceau de code non prévu par le système qui compromettra la sécurité. 

 Par défaut, PDO émule les requêtes préparées côté client, ce qui peut potentiellement entraîner des failles de sécurité si les données entrantes ne sont pas correctement filtrées. En désactivant cette émulation, on s'assure que les requêtes préparées sont bien utilisées côté serveur, ce qui garantit une meilleure sécurité.
 Ce qui nous permet d'optimiser l'exécution de la requête et de prévenir les attaques par injection SQL.

- Requete préparée : 
 Une requête préparée ou requête paramétrable est utilisée pour exécuter la même requête plusieurs fois, avec une grande efficacité et protège des injections SQL. 
 L'exécution d'une requête préparée se déroule en deux étapes : la préparation et l'exécution.
 Pour construire une requête en fonction de la valeur d'une variable, on passe par des marqueurs qui permettent d'éviter les dangereuses failles d'injection SQL.

- PDO : 
 Pour PDO ("PHP Data Objects"). 
 Une extension fournie avec PHP, mais elle doit être activé manuellement dans certains cas. 
 Pour dialoguer avec MySQL depuis PHP, on fait appel à l'extension PDO de PHP.
 Il faut faire une boucle en PHP pour récupérer ligne par ligne les données renvoyées par MySQL. 

--> 