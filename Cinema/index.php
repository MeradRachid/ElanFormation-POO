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
         * $id = (isset($_GET["id"])) ? $_GET["id"] : null;
         *   // $type = (isset($_GET["type"])) ? $_GET["type"] : null;
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

        switch ($_GET['action']) 
        {
            case "listFilms" : $ctrlCinema->listFilms();
                # code...
            break;
            
            case "listActors" : $ctrlCinema->listActors();
                # code...
            break;

            case "listCharacters" : $ctrlCinema->listCharacters();
                # code...
            break;

            case "listDirectors" : $ctrlCinema->listDirectors();
                # code...
            break;

            case "listGenres" : $ctrlCinema->listGenres();
                # code...
            break;

            case "detailGenre" : $ctrlCinema->detailGenre();
                # code...
            break;

            case "detailFilm" : $ctrlCinema->detailFilm();
                # code...
            break;

            case "detailCharacter" : $ctrlCinema->detailCharacter();
                # code...
            break;

            case "detailActor" : $ctrlCinema->detailActor();
                # code...
            break;

            case "detailDirector" : $ctrlCinema->detailDirector();
                # code...
            break;

        }
    }

?>