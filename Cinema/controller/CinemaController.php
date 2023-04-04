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
                                    SELECT movie_title, DATE_FORMAT(release_date, "%Y-%M-%D") AS release_date, synopsis, duration, rating FROM movie
                                  ');
            require "view/listFilms.php";
        }

        /**
         * Details d'un film 
         */

        public function detailFilm($id)
        {
            $pdo = Connect::seConnecter();
            $requete = $pdo->prepare('
                                        SELECT movie_id, movie_title, DATE_FORMAT(release_date, "%Y-%M-%D") AS release_date, synopsis, duration, Concat(p.firstName, " " , p.lastName) AS identity, m.poster
                                        FROM movie m , director d , person p
                                        WHERE m.director_id = d.director_id
                                        AND d.person_id = p.person_id
                                        AND movie_id = :id
                                    ');
            $requete->execute(["id" => $id]);         

            $requete3 = $pdo->query('
                                        SELECT DISTINCT p.firstName, p.lastName, p.gender, p.poster
                                        FROM person p
                                        INNER JOIN actor a ON p.person_id = a.person_id
                                        LIMIT 10
                                   ');

            require "view/detailFilm.php";
        }

        public function addFilmForm()
        {
            require "view/formFilm.php";
        }

        public function addFilm($array)
        {
            $pdo = Connect::seConnecter();
        
            $sql = $pdo->query('
                                SELECT d.director_id, p.firstName, p.lastName 
                                FROM person p 
                                JOIN director d ON d.person_id = p.person_id
                            ');

            $directors = $sql->fetchAll(PDO::FETCH_ASSOC);
            

            $requete = $pdo->prepare('INSERT INTO movie (movie_title, release_date, duration, rating, director_id) 
                                      VALUES (:movie_title, :release_date, :duration, :rating)
                                    ');

            if(isset($_POST['submit']))
            {
                $movie_title = filter_input(INPUT_POST, "movie_title", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $release_date = filter_input(INPUT_POST, "release_date", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $duration = filter_input(INPUT_POST, "duration", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $rating = filter_input(INPUT_POST, "rating", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                require "view/formFilm.php";
                
                // Ajouter le code pour vérifier la valeur retournée par la méthode rowCount()
                $requete->execute(["movie_title" => $movie_title, "release_date" => $release_date, "duration" => $duration, "rating" => $rating]);

                // Récupérer l'id du nouveau film créé
                $movieId = $pdo->lastInsertId();

                // var_dump($movieId);
                // die();
                // $rowCount = $requete->rowCount();
                // if($rowCount > 0){
                // }
                // else {
                //     echo "L'ajout du film a échoué.";
                // }
            }
        }
        /**
         * Pour UPDATE un film en lui ajoutant un Director
         * UPDATE movie
         * SET director_id = 1
         * WHERE movie_id = 7
         */
        
         
        
        



        public function listCharacters()
        {
            $pdo = Connect::seConnecter();
            $requete = $pdo->query('
                                    SELECT mc.character_id, mc.character_name
                                    FROM movie_character mc
                                  ');
            require "view/listCharacters.php";
        }
        
        // DetailCharacter ici ...  

        public function addCharacterForm()
        {
            require "view/formCharacter.php";
        }

        public function addCharacter($array)
        {
            $pdo = Connect::seConnecter();

            $requete = $pdo->prepare('INSERT INTO movie_character (character_name) 
                                      VALUES (:characterName)
                                    ');

            if(isset($_POST['submit']))
            {
                $characterName = filter_input(INPUT_POST, "characterName", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                require "view/formCharacter.php";

                $requete->execute(["characterName" => $characterName]);

                $charaId = $pdo->lastInsertId();

                // $requete2 = $pdo->prepare(" INSERT INTO movie_cast(actor_id, movie_id)
                //                             VALUES (:id)
                //                         ");

                // $requete2->execute(["id" => $charaId]);
            }
        }



        public function listActors()
        {
            $pdo = Connect::seConnecter();
            $requete = $pdo->query('
                                    SELECT p.lastName, p.firstName, p.gender
                                    FROM person p
                                    JOIN actor a ON p.person_id = a.person_id
                                    GROUP BY p.lastName, p.firstName, p.gender
                                    ORDER BY p.lastName DESC
                                  ');
            require "view/listActors.php";
        }

        // DetailActor ici ...  

        public function addActorForm()
        {
            require "view/formActor.php";
        }

        public function addActor($array)
        {
            $pdo = Connect::seConnecter();

            $requete = $pdo->prepare('INSERT INTO person (firstName, lastName, birth_date, gender) 
                                      VALUES (:firstName, :lastName, :birthDate, :gender)
                                    ');

            if(isset($_POST['submit']))
            {
                $firstname = filter_input(INPUT_POST, "firstName", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $lastname = filter_input(INPUT_POST, "lastName", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $birthdate = filter_input(INPUT_POST, "birthDate", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $gender = filter_input(INPUT_POST, "gender", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                require "view/formActor.php";

                $requete->execute(["firstName" => $firstname , "lastName" => $lastname, "birthDate" => $birthdate, "gender" => $gender]);

                $actorId = $pdo->lastInsertId();

                $requete2 = $pdo->prepare('INSERT INTO actor (person_id)
                                           VALUES (:id)
                                        ');

                $requete2->execute(["id" => $actorId]);
            }
        }



        public function listDirectors()
        {
            $pdo = Connect::seConnecter();

            $requete = $pdo->query('
                                    SELECT DISTINCT p.firstName, p.lastName, p.gender
                                    FROM person p
                                    INNER JOIN director d ON p.person_id = d.person_id
                                  ');
            require "view/listDirectors.php";
        }

        // DetailDirector ici ...          

        public function addDirectorForm()
        {
            require "view/formDirector.php";
        }

        public function addDirector($array)
        {
            $pdo = Connect::seConnecter();
            $sql = $pdo->prepare('INSERT INTO person (firstName, lastName, birth_date, gender) 
                                  VALUES (:firstName, :lastName, :birthDate, :gender)
                                ');

            if(isset($_POST['submit']))
            {
                $firstname = filter_input(INPUT_POST, "firstName", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $lastname = filter_input(INPUT_POST, "lastName", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $birthdate = filter_input(INPUT_POST, "birthDate", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $gender = filter_input(INPUT_POST, "gender", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            require "view/formDirector.php";

            $sql->execute(["firstName" => $firstname , "lastName" => $lastname, "birthDate" => $birthdate, "gender" => $gender]);

            $directorId = $pdo->lastInsertId();

            $sql2 = $pdo->prepare(" INSERT INTO director (person_id)
                                    VALUES (:id)
                                ");

            $sql2->execute(["id"=>$directorId]);
            }
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

        public function detailGenre($id)
        {
            // header("location:index.php?action=homePage");

            $pdo = Connect::seConnecter();
            $requete = $pdo->prepare('
                                        SELECT g.genre_name, m.movie_title
                                        FROM genre g
                                        JOIN movie_genre mg ON mg.genre_id = g.genre_id
                                        JOIN movie m ON m.movie_id = mg.movie_id
                                        WHERE g.genre_id = :id
                                    ');
            $requete->execute(["id" => $id]);

            require "view/detailGenre.php";
        }

        public function addGenreForm()
        {
            require "view/formGenre.php";
        }

        public function addGenre($array)
        {
            $pdo = Connect::seConnecter();

            $requete = $pdo->prepare('INSERT INTO genre (genre_name) 
                                      VALUES (:genre)
                                    ');

            if(isset($_POST['submit']))
            {
                $genre = filter_input(INPUT_POST, "genre", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                require "view/formGenre.php";

                $requete->execute(["genre" => $genre]);

                $genreID = $pdo->lastInsertId();
            }
        }

        /*      
        Affiche le(s) genre(s) d'un film 
        ~ > 
            SELECT g.genre_name, m.movie_title
            FROM genre g
            JOIN movie_genre mg ON mg.genre_id = g.genre_id
            JOIN movie m ON m.movie_id = mg.movie_id
            WHERE mg.movie_id = :id
        < ~

        Affiche le(s) film(s) d'un genre
        ~ > 
            SELECT g.genre_name, m.movie_title
            FROM genre g
            JOIN movie_genre mg ON mg.genre_id = g.genre_id
            JOIN movie m ON m.movie_id = mg.movie_id
            WHERE g.genre_id = :id
        < ~ 
        */



        public function homePage()
        {
            require "view/homePage.php";
        }
        


    }

?>