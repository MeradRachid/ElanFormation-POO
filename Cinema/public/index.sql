-- >> Requêtes SQL à faire :

-- (°) : Gender Actor, identity & Character's name.
SELECT  p.gender, p.lastName, p.firstName, mc2.character_name
FROM person p
JOIN actor a ON p.person_id = a.person_id
JOIN movie_cast mc ON a.actor_id = mc.actor_id
JOIN movie_character mc2 ON mc.character_id = mc2.character_id
JOIN movie m ON mc.movie_id = m.movie_id
GROUP BY mc2.character_name, p.lastName, p.firstName, p.gender

-- a) Information d'un film (film_id) : titre, année, durée au format(HH:MM) & réalisateur.
SELECT 
    m.movie_title AS titre, 
    YEAR(m.release_date) AS annee, 
    CONCAT(FLOOR(m.duration / 60), ':', LPAD(MOD(m.duration, 60), 2, '0')) AS duree, 
    p.firstName AS prenom_realisateur, 
    p.lastName AS nom_realisateur
FROM 
    movie m
    JOIN person p ON m.director_id = p.person_id
WHERE 
    m.movie_id = [film_id];
-- Remplacez <film_id> par l'ID du film souhaité.

-- b) Liste des films dont la durée excède 2h15, classé par durée décroissante.
SELECT movie_title, duration
FROM movie
WHERE duration > 135
ORDER BY duration DESC;

-- c) Liste des films d'un réalisateur, classé par ordre de sortie.
SELECT m.movie_title, m.release_date
FROM movie m
INNER JOIN director d ON m.director_id = d.director_id
WHERE d.director_id = [director_id]
ORDER BY m.release_date;

-- d) Nombre de films par genre (décroissant).
SELECT genre_name, COUNT(*) AS num_movies
FROM movie_genre mg
INNER JOIN genre g ON mg.genre_id = g.genre_id
GROUP BY mg.genre_id
ORDER BY num_movies DESC;

-- e) Nombre de films par réalisateur (décroissant).
SELECT person.firstName, person.lastName, COUNT(movie.movie_id) as num_movies
FROM director
JOIN person ON director.person_id = person.person_id
JOIN movie ON director.director_id = movie.director_id
GROUP BY person.person_id
ORDER BY num_movies DESC;

-- f) Casting d'un film (film_id) : nom, prenom & genre.
SELECT p.firstName, p.lastName, p.gender, mc2.character_name
FROM person p
JOIN actor a ON p.person_id = a.person_id
JOIN movie_cast mc ON a.actor_id = mc.actor_id
JOIN movie_character mc2 ON mc.character_id = mc2.character_id
WHERE mc.movie_id = [film_id];
-- Remplacez <film_id> par l'ID du film souhaité.

-- f°²) Pour ne pas avoir à indiquer d'ID : 
SELECT DISTINCT p.firstName, p.lastName, p.gender, mc2.character_name, m.movie_title
FROM person p
JOIN actor a ON p.person_id = a.person_id
JOIN movie_cast mc ON a.actor_id = mc.actor_id
JOIN movie_character mc2 ON mc.character_id = mc2.character_id
JOIN movie m ON mc.movie_id = m.movie_id;

-- g) Films tournés par un acteur(actor_id) avec le rôle et l'année de sortie (récent vers ancien).
SELECT mc2.character_name, p.firstName, p.lastName, DATE_FORMAT(m.release_date, '%Y-%M-%D') as release_date
FROM movie_cast mc
JOIN person p ON mc.actor_id = p.person_id
JOIN movie m ON mc.movie_id = m.movie_id
JOIN movie_character mc2 ON mc.character_id = mc2.character_id
WHERE mc.actor_id = [actor_id]
ORDER BY m.release_date DESC;
-- Remplacez <actor_id> par l'ID de l'acteur souhaité.

-- h) Liste des personnes qui sont à la fois acteurs et réalisateurs.
SELECT DISTINCT p.firstName, p.lastName
FROM person p
INNER JOIN director d ON p.person_id = d.person_id
INNER JOIN actor a ON p.person_id = a.person_id;

-- i) Liste des films qui ont moins de 10 ans.
SELECT movie_title, release_date
FROM movie
WHERE release_date >= DATE_SUB(NOW(), INTERVAL 10 YEAR)
ORDER BY release_date DESC;

-- j): Parité Homme/Femme 
SELECT p.gender, COUNT(*) AS count
FROM actor a
JOIN person p ON a.person_id = p.person_id
GROUP BY p.gender;

-- k) : Acteurs ayant 50 ans ou plus 
SELECT p.firstName, p.lastName, YEAR(CURDATE()) - YEAR(p.birth_date) AS age
FROM person p
JOIN actor a ON p.person_id = a.actor_id
WHERE YEAR(CURDATE()) - YEAR(p.birth_date) >= 50
ORDER BY age DESC;
-- On joint la table person avec la table actor pour récupérer seulement les acteurs.
-- On utilise la fonction YEAR() pour extraire l'année de la date de naissance de chaque acteur,
-- On soustrait cette année de l'année actuelle (obtenue avec la fonction CURDATE()), pour calculer l'âge de chaque acteur.
-- On filtre sur les acteurs de 50 ans ou plus en utilisant une condition dans la clause WHERE.
-- On trie les résultats par ordre décroissant d'âge avec la clause ORDER BY.

-- l) : Acteurs ayant joués dans 3 films ou plus
SELECT p.firstName, p.lastName, COUNT(DISTINCT mc.movie_id) AS num_movies
FROM person p
JOIN movie_cast mc ON p.person_id = mc.actor_id
GROUP BY p.person_id
HAVING num_movies >= 3
ORDER BY p.lastName, p.firstName;
-- On fait une jointure entre les tables person et movie_cast sur la colonne person_id qui correspond à l'ID des acteurs.
-- On utilise la fonction COUNT(DISTINCT mc.movie_id) pour compter le nombre de films distincts dans lesquels chaque acteur a joué. 
-- On utilise DISTINCT pour s'assurer qu'on ne compte pas plusieurs fois le même film si un acteur a joué plusieurs personnages dans ce film.
-- On regroupe les résultats par person_id (l'ID de l'acteur) en utilisant la clause GROUP BY.
-- On utilise la clause HAVING pour filtrer les acteurs qui ont joué dans moins de 3 films.
-- Enfin, on trie les résultats par nom de famille et prénom en utilisant la clause ORDER BY.



-- >> création Tables BDD cinema : 
CREATE TABLE Genre 
(
    genre_id INT PRIMARY KEY AUTO_INCREMENT,
    genre_name VARCHAR(90) NOT NULL
);

CREATE TABLE Person 
(
    person_id INT PRIMARY KEY AUTO_INCREMENT,
    firstName VARCHAR(90) NOT NULL,
    lastName VARCHAR(90) NOT NULL,
    birth_date DATETIME NOT NULL,
    gender VARCHAR(50) NOT NULL,
    poster VARCHAR(255)
);

CREATE TABLE Movie_character 
(
    character_id INT PRIMARY KEY AUTO_INCREMENT,
    character_name VARCHAR(90) NOT NULL
);

CREATE TABLE Actor 
(
    actor_id INT PRIMARY KEY AUTO_INCREMENT,
    person_id INT NOT NULL,
    FOREIGN KEY (person_id) REFERENCES Person(person_id)
);

CREATE TABLE Director 
(
    director_id INT PRIMARY KEY AUTO_INCREMENT,
    person_id INT NOT NULL,
    FOREIGN KEY (person_id) REFERENCES Person(person_id)
);

CREATE TABLE Movie 
(
    movie_id INT PRIMARY KEY AUTO_INCREMENT,
    movie_title VARCHAR(255) NOT NULL,
    release_date DATETIME NOT NULL,
    duration TIME NOT NULL,
    synopsis TEXT NOT NULL,
    rating FLOAT(2) NOT NULL,
    poster VARCHAR(255),
    director_id INT NOT NULL,
    FOREIGN KEY (director_id) REFERENCES Director(director_id)
);

CREATE TABLE Movie_genre 
(
    movie_id INT NOT NULL,
    genre_id INT NOT NULL,
    PRIMARY KEY (movie_id, genre_id),
    FOREIGN KEY (movie_id) REFERENCES Movie(movie_id),
    FOREIGN KEY (genre_id) REFERENCES Genre(genre_id)
);

CREATE TABLE Movie_cast 
(
    movie_id INT NOT NULL,
    actor_id INT NOT NULL,
    character_id INT NOT NULL,
    PRIMARY KEY (movie_id, actor_id, character_id),
    FOREIGN KEY (movie_id) REFERENCES Movie(movie_id),
    FOREIGN KEY (actor_id) REFERENCES Actor(actor_id),
    FOREIGN KEY (character_id) REFERENCES Movie_character(character_id)
);

-- >> insertion Genre Cinématographique :  
INSERT INTO genre (genre_id, genre_name) VALUES
    (1, 'Action'),
    (2, 'Adventure'),
    (3, 'Fantasy');


-- >> insertion Films : 
INSERT INTO movie (movie_id, movie_title, release_date, duration, synopsis, rating, poster, director_id) VALUES
(1, 'The Lord of the Rings : The Fellowship of the Ring', '2001-12-19', SEC_TO_TIME(178*60), 'A young hobbit, Frodo, who has found the One Ring that belongs to the Dark Lord Sauron, begins his journey with eight companions to Mount Doom, the only place where it can be destroyed.', 4.8, '<img src="public/img/films/LoR01_FoR.jpg">', 1),
(2, 'The Lord of the Rings : The Two Towers', '2002-12-18', SEC_TO_TIME(179*60), 'While Frodo and Sam edge closer to Mordor with the help of the shifty Gollum, the divided fellowship makes a stand against Sauron''s new ally, Saruman, and his hordes of Isengard.', 4.9, NULL, 1),
(3, 'The Lord of the Rings : The Return of the King', '2003-12-17', SEC_TO_TIME(201*60), 'Gandalf and Aragorn lead the World of Men against Sauron''s army to draw his gaze from Frodo and Sam as they approach Mount Doom with the One Ring.', 5, NULL, 1),
(4, 'The Hobbit : An Unexpected Journey', '2012-12-13', SEC_TO_TIME(169*60), 'A reluctant hobbit, Bilbo Baggins, sets out to the Lonely Mountain with a spirited group of dwarves to reclaim their mountain home, and the gold within it from the dragon Smaug.', 3.7, NULL, 2),
(5, 'The Hobbit : The Desolation of Smaug', '2013-12-13', SEC_TO_TIME(161*60), 'The dwarves, along with Bilbo Baggins and Gandalf the Grey, continue their quest to reclaim Erebor, their homeland, from Smaug. Bilbo Baggins is in possession of a mysterious and magical ring.', 4.1, NULL, 2),
(6, 'The Hobbit : The Battle of the Five Armies', '2014-12-17', SEC_TO_TIME(144*60), 'Bilbo and company are forced to engage in a war against an array of combatants and keep the Lonely Mountain from falling into the hands of a rising darkness.', 4, NULL, 2);

-- >> insertion Personnages : 
INSERT INTO movie_character (character_id, character_name) VALUES
(1, 'Frodo Baggins'),
(2, 'Gandalf'),
(3, 'Aragorn'),
(4, 'Legolas'),
(5, 'Gimli'),
(6, 'Samwise Gamgee'),
(7, 'Peregrin Took'),
(8, 'Meriadoc Brandybuck'),
(9, 'Saruman'),
(10, 'Arwen Undómiel'),
(11, 'Elrond'),
(12, 'Galadriel'),
(13, 'Sauron'),
(14, 'Éowyn'),
(15, 'Éomer'),
(16, 'Faramir'),
(17, 'Denethor'),
(18, 'Gollum'),
(19, 'Old Bilbo Baggins'),
(20, 'Thorin Oakenshield'),
(21, 'Balin'),
(22, 'Dwalin'),
(23, 'Kíli'),
(24, 'Fili'),
(25, 'Bofur'),
(26, 'Bifur'),
(27, 'Bombur'),
(28, 'Óin'),
(29, 'Glóin'),
(30, 'Dori'),
(31, 'Nori'),
(32, 'Ori'),
(33, 'Radagast'),
(34, 'Tauriel'),
(35, 'Bowman'),
(36, 'Beorn'),
(37, 'Smaug The Dragon'),
(38, 'Cameo'),
(39, 'Young Bilbo Baggins');

-- >> insertion Personnes : 
INSERT INTO person (person_id, firstName, lastName, birth_date, gender, poster) VALUES
(1, 'Elijah', 'Wood', '1981-01-28', 'M', '<img src="public/img/persons/ElijahWood.jpg" class="img-fluid rounded w-25" alt="ElijahWood">'),
(2, 'Ian', 'McKellen', '1939-05-25', 'M', '<img src="public/img/persons/IanMcKellen.jpg" class="img-fluid rounded w-25" alt="IanMcKellen">'),
(3, 'Viggo', 'Mortensen', '1958-10-20', 'M', '<img src="public/img/persons/ViggoMortensen.jpg" class="img-fluid rounded w-25" alt="ViggoMortensen">'),
(4, 'Orlando', 'Bloom', '1977-01-13', 'M', '<img src="public/img/persons/OrlandoBloom.jpg" class="img-fluid rounded w-25" alt="OrlandoBloom">'),
(5, 'John', 'Rhys-Davies', '1944-05-05', 'M', '<img src="public/img/persons/JohnRhys-Davies.jpg" class="img-fluid rounded w-25" alt="JohnRhys-Davies">'),
(6, 'Sean', 'Astin', '1971-02-25', 'M', '<img src="public/img/persons/SeanAstin.jpg" class="img-fluid rounded w-25" alt="SeanAstin">'),
(7, 'Billy', 'Boyd', '1968-08-28', 'M', '<img src="public/img/persons/BillyBoyd.jpg" class="img-fluid rounded w-25" alt="BillyBoyd">'),
(8, 'Dominic', 'Monaghan', '1976-12-08', 'M', '<img src="public/img/persons/DominicMonaghan.jpg" class="img-fluid rounded w-25" alt="DominicMonaghan">'),
(9, 'Christopher', 'Lee', '1922-05-27', 'M', '<img src="public/img/persons/ChristopherLee.jpg" class="img-fluid rounded w-25" alt="ChristopherLee">'),
(10, 'Liv', 'Tyler', '1977-07-01', 'F', '<img src="public/img/persons/LivTyler.jpg" class="img-fluid rounded w-25" alt="LivTyler">'),
(11, 'Hugo', 'Weaving', '1960-04-04', 'M', '<img src="public/img/persons/HugoWeaving.jpg" class="img-fluid rounded w-25" alt="HugoWeaving">'),
(12, 'Cate', 'Blanchett', '1969-05-14', 'F', '<img src="public/img/persons/CateBlanchett.jpg" class="img-fluid rounded w-25" alt="CateBlanchett">'),
(13, 'Sala', 'Baker', '1976-09-22', 'M', '<img src="public/img/persons/SalaBaker.jpg" class="img-fluid rounded w-25" alt="SalaBaker">'),
(14, 'Miranda', 'Otto', '1967-12-15', 'F'),
(15, 'Karl', 'Urban', '1972-06-07', 'M'),
(16, 'David', 'Wenham', '1965-09-21', 'M'),
(17, 'John', 'Noble', '1948-08-20', 'M'),
(18, 'Andy', 'Serkis', '1964-04-20', 'M', '<img src="public/img/persons/AndySerkis.jpg" class="img-fluid rounded w-25" alt="AndySerkis">'),
(19, 'Ian', 'Holm', '1931-09-12', 'M', '<img src="public/img/persons/IanHolm.jpg" class="img-fluid rounded w-25" alt="IanHolm">'),
(20, 'Martin', 'Freeman', '1971-09-08', 'M'),
(21, 'Richard', 'Armitage', '1971-08-22', 'M'), 
(22, 'Benedict', 'Cumberbatch', '1976-07-19', 'M'),
(23, 'Ken', 'Stott', '1954-10-19', 'M'),
(24, 'Graham', 'McTavish', '1961-01-04', 'M'),
(25, 'Aidan', 'Turner', '1983-06-19', 'M'),
(26, 'Dean', 'O.Gorman', '1976-12-01', 'M'),
(27, 'James', 'Nesbitt', '1965-01-15', 'M'),
(28, 'William', 'Kircher', '1958-05-23', 'M'),
(29, 'Stephen', 'Hunter', '1968-10-26', 'M'),
(30, 'John', 'Callen', '1946-11-04', 'M'),
(31, 'Peter', 'Hambleton', '1976-07-19', 'M'),
(32, 'Mark', 'Hadlow', '1976-07-19', 'M'),
(33, 'Jed', 'Brophy', '1963-10-29', 'M'),
(34, 'Adam', 'Brown', '1980-05-29', 'M'),
(35, 'Sylvester', 'Mc Coy', '1943-08-20', 'M'),
(36, 'Evangeline', 'Lilly', '1979-08-03', 'F'),
(37, 'Luke', 'Evans', '1979-04-15', 'M'),
(38, 'Mikael', 'Persbrandt', '1963-09-25', 'M'),
(39, 'Peter', 'Jackson', '1961-10-31', 'M', '<img src="public/img/persons/PeterJackson.jpg" class="img-fluid img-thumbnail rounded w-25" alt="PeterJackson">');

-- >> insertion Acteurs : 
INSERT INTO Actor (actor_id, person_id) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10),
(11, 11),
(12, 12),
(13, 13),
(14, 14),
(15, 15),
(16, 16),
(17, 17),
(18, 18),
(19, 19),
(20, 20),
(21, 21),
(22, 22),
(23, 23),
(24, 24),
(25, 25),
(26, 26),
(27, 27),
(28, 28),
(29, 29),
(30, 30),
(31, 31),
(32, 32),
(33, 33),
(34, 34),
(35, 35),
(36, 36),
(37, 37),
(38, 38),
(39, 39);
-- etc.

-- >> insertion Realisateur : 
INSERT INTO director (director_id, person_id) VALUES
(1, 39),
(2, 18);

-- >> insertion Association du genre à un film : 
-- Par exemple, le premier enregistrement indique que le film avec l'id 1 est associé au genre avec l'id 2, et au genre avec l'id 3.
INSERT INTO movie_genre (movie_id, genre_id) 
VALUES 
(1, 2),
(2, 1),
(3, 1),
(3, 2),
(3, 3);

-- >> insertion Association d'un acteur à son personnage dans un film : 
-- Par exemple, le premier enregistrement indique que l'acteur avec l'id 1 joue le personnage avec l'id 1 dans le film avec l'id 1, et que l'acteur avec l'id 2 joue le personnage avec l'id 2 dans le même film.
INSERT INTO movie_cast (movie_id, actor_id, character_id)
VALUES 
(1, 1, 1),
(1, 2, 2),
(1, 3, 3),
(1, 4, 4),
(1, 5, 5),
(1, 6, 6),
(1, 7, 7),
(1, 8, 8),
(1, 9, 9),
(1, 10, 10),
(1, 11, 11),
(1, 12, 12),
(1, 13, 13),
(1, 18, 18),
(1, 19, 19),
(1, 39, 38),
(2, 1, 1),
(2, 2, 2),
(2, 3, 3),
(2, 4, 4),
(2, 5, 5),
(2, 6, 6),
(2, 7, 7),
(2, 8, 8),
(2, 9, 9),
(2, 10, 10),
(2, 11, 11),
(2, 12, 12),
(2, 13, 13),
(2, 14, 14),
(2, 15, 15),
(2, 16, 16),
(2, 17, 17),
(3, 1, 1),
(3, 2, 2),
(3, 3, 3),
(3, 4, 4),
(3, 5, 5),
(3, 6, 6),
(3, 7, 7),
(3, 8, 8),
(3, 9, 9),
(3, 10, 10),
(3, 11, 11),
(3, 12, 12),
(3, 13, 13),
(3, 14, 14),
(3, 15, 15),
(3, 16, 16),
(3, 17, 17),
(3, 18, 18),
(3, 19, 19),
(3, 39, 38),
(4, 20, 39),
(5, 20, 39),
(6, 20, 39),
(6, 19, 19),
(4, 21, 20),
(5, 21, 20),
(6, 21, 20),
(4, 22, 37),
(5, 22, 37),
(6, 22, 37),
(4, 39, 38),
(5, 39, 38),
(4, 23, 21),
(5, 23, 21),
(6, 23, 21),
(4, 24, 22),
(5, 24, 22),
(6, 24, 22),
(4, 25, 23),
(5, 25, 23),
(6, 25, 23),
(4, 26, 24),
(5, 26, 24),
(6, 26, 24),
(4, 27, 25),
(5, 27, 25),
(6, 27, 25),
(4, 28, 26),
(5, 28, 26),
(6, 28, 26),
(4, 29, 27),
(5, 29, 27),
(6, 29, 27),
(4, 30, 28),
(5, 30, 28),
(6, 30, 28),
(4, 31, 29),
(5, 31, 29),
(6, 31, 29),
(4, 32, 30),
(5, 32, 30),
(6, 32, 30),
(4, 33, 31),
(5, 33, 31),
(6, 33, 31),
(4, 34, 32),
(5, 34, 32),
(6, 34, 32),
(4, 35, 33),
(5, 35, 33),
(6, 35, 33),
(4, 36, 34),
(5, 36, 34),
(6, 36, 34),
(4, 37, 35),
(5, 37, 35),
(6, 37, 35),
(4, 38, 36),
(5, 38, 36),
(6, 38, 36);



-- https://fr.wikipedia.org/wiki/Le_Seigneur_des_anneaux_(s%C3%A9rie_de_films)

-- https://fr.wikipedia.org/wiki/Liste_des_films_de_James_Bond

-- https://fr.wikipedia.org/wiki/Indiana_Jones_(franchise)

-- https://fr.wikipedia.org/wiki/Star_Wars_au_cin%C3%A9ma

-- https://fr.wikipedia.org/wiki/La_Famille_foldingue
