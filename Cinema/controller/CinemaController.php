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
                                    SELECT p.lastName, p.firstName, p.gender
                                    FROM person p
                                    JOIN actor a ON p.person_id = a.person_id
                                    JOIN movie_cast mc ON a.actor_id = mc.actor_id
                                    JOIN movie_character mc2 ON mc.character_id = mc2.character_id
                                    JOIN movie m ON mc.movie_id = m.movie_id
                                    GROUP BY p.lastName, p.firstName, p.gender
                                    ORDER BY p.lastName DESC
                                  ');
            require "view/listActors.php";
        }
        
        public function listCharacters()
        {
            $pdo = Connect::seConnecter();
            $requete = $pdo->query('
                                    SELECT p.lastName, p.firstName, p.gender, mc2.character_name
                                    FROM person p
                                    JOIN actor a ON p.person_id = a.person_id
                                    JOIN movie_cast mc ON a.actor_id = mc.actor_id
                                    JOIN movie_character mc2 ON mc.character_id = mc2.character_id
                                    JOIN movie m ON mc.movie_id = m.movie_id
                                    GROUP BY mc2.character_name, p.lastName, p.firstName, p.gender
                                  ');
            require "view/listCharacters.php";
        }
        
        public function listDirectors()
        {
            $pdo = Connect::seConnecter();
            $requete = $pdo->query('
                                    SELECT DISTINCT p.firstName, p.lastName, p.gender
                                    FROM person p
                                    INNER JOIN director d ON p.person_id = d.person_id
                                    INNER JOIN actor a ON p.person_id = a.person_id;
                                  ');
            require "view/listDirectors.php";
        }
        
        public function listGenres()
        {
            $pdo = Connect::seConnecter();
            $requete = $pdo->query('
                                    SELECT g.genre_name
                                    FROM genre g                                    
                                  ');
            require "view/listGenres.php";
        }

        public function detailFilm($id)
        {
            $pdo = Connect::seConnecter();
            $requete = $pdo->prepare('
                                      SELECT movie_title, DATE_FORMAT(release_date, "%Y-%M-%D") AS release_date, synopsis, duration 
                                      FROM movie
                                      WHERE movie_id = :id;
                                   ');
            $requete->execute(["id" => $id]);

            $requete2 = $pdo->prepare('
                                       SELECT * FROM person 
                                       WHERE person_id = :id
                                       ORDER BY person_id LIMIT 4;
                                    ');
            $requete2->execute(["id" => $id]);

            $requete3 = $pdo->prepare('
                                    SELECT DISTINCT p.firstName, p.lastName, p.gender
                                    FROM person p
                                    INNER JOIN director d ON p.person_id = d.person_id
                                    INNER JOIN actor a ON p.person_id = a.person_id
                                    WHERE p.person_id = :id;
                                   ');
            $requete3->execute(["id" => $id]);

            require "view/detailFilm.php";
        }
    }

?>