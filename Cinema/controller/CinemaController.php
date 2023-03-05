<!-- Contiendra l'ensemble des requêtes dans les fonctions en relation avec les vues  -->

<?php
    namespace Controller;
    use Model\Connect;

    // On remarque ici l'utilisation de 'use' pour accéder à Connect situé dans le namespace Model 

    class CinemaController
    {
        /**
         * Lister les films 
         */

        public function listFilms()
        {
            $pdo = Connect::seConnecter();
            $requete = $pdo->query('
                                    SELECT movie_title, DATE_FORMAT(release_date, "%Y-%M-%D") AS release_date, synopsis, duration FROM movie
                                  ');
            require "view/listFilms.php";
        }
    }

?>