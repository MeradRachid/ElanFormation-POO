
-- Pour créer une base de données : 
-- L’option IF NOT EXISTS permet juste de ne pas retourner d’erreur si une base du même nom existe déjà. 
-- La base de données ne sera pas donc écrasée. Attention, n'est pas toujours supporté, dans ce cas se référer à la documentation.
CREATE DATABASE IF NOT EXISTS `forumTCG` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `forumTCG`;
 
-- Pour renommer une contrainte existante : (A tester)
-- ALTER TABLE distributeurs RENAME CONSTRAINT verif_cp TO verif_code_postal;

CREATE TABLE User
(
    id_user INT PRIMARY KEY AUTO_INCREMENT,
    userName VARCHAR(90) UNIQUE NOT NULL,
    registerDate datetime NOT NULL DEFAULT CURRENT_TIMESTAMP, 
    role JSON NOT NULL,
    email VARCHAR(90) NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE Category 
(
    id_category INT PRIMARY KEY AUTO_INCREMENT,
    categoryName VARCHAR(90) NOT NULL,
    creationDate DATETIME NOT NULL 
);

CREATE TABLE Topic 
(
    id_topic INT PRIMARY KEY AUTO_INCREMENT,
    category_id INT NOT NULL,
    user_id INT NOT NULL,
    topicTitle VARCHAR(90) NOT NULL,
    creationDate DATETIME NOT NULL,
    topicLocked BOOLEAN NOT NULL,    
    FOREIGN KEY (category_id) REFERENCES Category(id_category),
    FOREIGN KEY (user_id) REFERENCES User(id_user)
);

CREATE TABLE Post 
(
    id_post INT PRIMARY KEY AUTO_INCREMENT,
    topic_id INT NOT NULL,
    user_id INT NOT NULL,
    creationDate DATETIME NOT NULL,
    message Text NOT NULL,
    FOREIGN KEY (topic_id) REFERENCES Topic(id_topic),
    FOREIGN KEY (user_id) REFERENCES User(id_user)
);

-- >> insertion Utilisateurs :  
INSERT INTO User (id_user, userName, registerDate, role, email, password)
VALUES
(1, "Mac Intosh", "2023-03-16 00:59:00", "ROLE_ADMIN", "sql@gmail.com", 'Test-12345678'),
(2, "Lee Nux", "2023-03-20 09:09:09", "ROLE_USER", "user@gmail.com", 'Test-12345678'),
(3, 'Wynn Doz', "2023-03-22 10:54:33", "ROLE_USER", 'test@gmail.com', 'Test-12345678'),
(4, 'Oun Bunt&ucirc;', "2023-03-26 07:55:46", "ROLE_USER", 'test@test.fr', 'Test-12345678'),
(5, 'Andr Ho&iuml;d', NULL, "ROLE_USER", 'i-bot@email.com', 'Test-12345678');

-- >> insertion Categories :
INSERT INTO Category (id_category, categoryName, creationDate)
VALUES
(1, "Avant Propos", "2023-03-17 15:41:25"),
(2, "Bienvenue", "2023-03-20 21:15:09");

-- >> insertion Topics :
INSERT INTO Topic (id_topic, category_id, user_id, topicTitle, creationDate, topicLocked)
VALUES
(1, 1, 1, "Reglement Interieur", "2023-03-18 21:15:09", FALSE),
(2, 2, 1, "Welcome Strangers", "2023-03-20 08:54:01", FALSE);

-- >> insertion Posts :
INSERT INTO Post (id_post, topic_id, user_id, creationDate, message)
VALUES
(1, 1, 1, "2023-03-19 16:45:32", "Le réglement, tu respecteras..."),
(2, 2, 2, "2023-03-20 12:21:30", " Hello World !!!"); 