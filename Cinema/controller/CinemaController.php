<?php
    namespace Controller;
    use Model\Connect;
    
    // Contiendra l'ensemble des requêtes dans les fonctions en relation avec les vues
    
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

        public function listActors()
        {
            $pdo = Connect::seConnecter();
            $requete = $pdo->query('
                                    SELECT mc2.character_name, p.lastName, p.firstName, p.gender
                                    FROM person p
                                    JOIN actor a ON p.person_id = a.person_id
                                    JOIN movie_cast mc ON a.actor_id = mc.actor_id
                                    JOIN movie_character mc2 ON mc.character_id = mc2.character_id
                                    JOIN movie m ON mc.movie_id = m.movie_id
                                    GROUP BY mc2.character_name, p.lastName, p.firstName, p.gender
                                  ');
            require "view/listActors.php";
        }
    }

?>