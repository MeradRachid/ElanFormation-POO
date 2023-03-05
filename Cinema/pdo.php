<!-- 
    Pour dialoguer avec MySQL depuis PHP, on fait appel à l'extension PDO de PHP.
    PDO ("PHP Data Objects") : Extension fournie avec PHP, mais elle doit être activé manuellement dans certains cas.
    Il faut faire une boucle en PHP pour récupérer ligne par ligne les données renvoyées par MySQL. 
    Pour construire une requête en fonction de la valeur d'une variable, on passe par des marqueurs qui permettent d'éviter les dangereuses failles d'injection SQL.

    try et catch sont des blocs de code utilisés en programmation pour gérer les erreurs et exceptions qui peuvent se produire pendant l'exécution d'un programme.

    Le bloc try contient le code qui peut potentiellement générer une exception. 
    Si une exception est effectivement générée, le programme quitte le bloc try et passe immédiatement au bloc catch.

    Le bloc catch contient le code qui est exécuté en cas d'exception, et permet de gérer cette exception. 
    Le bloc catch peut recevoir l'objet exception généré dans le bloc try, ce qui permet de récupérer des informations sur l'erreur, telle que son message et sa cause.

    Voici un exemple de code qui utilise try et catch : 

    try 
    {
        // code qui peut générer une exception
    }    
    catch (Exception $e) 
    {
        // code qui gère l'exception
    }
    
    L'utilisation de try et catch est recommandée dans les programmes où des erreurs peuvent se produire.
    Car cela permet de gérer ces erreurs et ainsi empêcher le programme de se bloquer ou de planter.

-->

<?php

    try 
    {   // On définit à présent les informations de connexion à la base de données avec les variables $host, $dbname, $username et $password.
        $pdo = new PDO("mysql:host=localhost;dbname=cinema;charset=utf8", "root", "");
        // Ensuite, on utilise la classe PDO pour se connecter à la base de données en utilisant les informations de connexion définies précédemment.
    }
    catch (PDOException $e) 
    {
        echo "Erreur de connexion : " . $e->getMessage();
    } 	// En cas d'erreur, on affiche un message et on arrête tout
        
    // Si tout va bien, on peut continuer
  
    // Lorsqu'une requête SQL « plante », bien souvent PHP vous dira qu'il y a eu une erreur à la ligne du fetchAll :

    // Exemple >> Fatal error: Call to a member function fetchAll() on a non-object in index.php on line 13
    // Ce n'est pas la ligne du fetchAll qui est en cause : c'est souvent vous qui avez mal écrit votre requête SQL quelques lignes plus haut. 
    // Pour afficher des détails sur l'erreur, il faut activer les erreurs lors de la connexion à la base de données via PDO.

    // Lorsque vous avez un problème avec une requête et que vous voulez demander de l'aide : 
    // Pensez toujours à activer les erreurs lors de la connexion à la base de données comme je viens de vous montrer, cela vous permettra d'avoir un message d'erreur détaillé.
    // N'oubliez pas que personne ne peut vous aider si vous donnez juste le message par défaut Call to a member function fetchAll() on a non-object  ! 


    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    // On fait appel à la méthode setAttribute() pour configurer certaines options du gestionnaire de requêtes PDO (PDOStatement).    

    // Le premier appel, $pdo>setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Configure le mode d'erreur de PDO pour qu'il lance une exception de type PDOException en cas d'erreur SQL. 
    // Cela permet de capturer les erreurs SQL et de les gérer de manière plus précise.
    // Par exemple en affichant un message d'erreur approprié à l'utilisateur.

    // Le second appel, $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); 
    // Est une instruction qui permet de définir le mode de récupération des données à partir de la base de données par défaut. 

    // Ici, on définit le mode par défaut comme étant PDO::FETCH_ASSOC, ce qui signifie que les données seront récupérées sous forme de tableaux associatifs. 
    // Cela signifie que chaque ligne récupérée sera représentée sous forme d'un tableau associatif, 
    // Où les clés seront les noms des colonnes de la table et les valeurs seront les valeurs de chaque colonne pour cette ligne.

    // Cela permet de simplifier le code, car on peut accéder aux données en utilisant simplement le nom de la colonne comme clé de tableau, plutôt que d'utiliser des index numériques. 
    // Nous pouvons accéder à la valeur de la colonne "title" en utilisant $movie['title'] plutôt que $movie[0].

    // On définit une requête SQL qui utilise la table movie
    // Si on utilisait la chaîne de caractères 'SELECT * FROM movie'
    // On récupérereait donc tout le contenu de la table movie. 
    $stmtCinema = $pdo->query('SELECT movie_title, DATE_FORMAT(release_date, "%Y-%M-%D") AS release_date, synopsis, duration FROM movie');

    // La méthode query() est une méthode de l'objet PDO qui permet d'exécuter une requête SQL qui ne requiert pas de préparation préalable. 
    // La méthode prend en paramètre la requête SQL à exécuter et renvoie un objet PDOStatement qui peut être utilisé pour récupérer les résultats de la requête.
    // La méthode query() peut être utilisée lorsque la requête SQL est statique et ne nécessite pas de lier des valeurs de paramètres dynamiquement. 
    // Elle est utile pour les requêtes SELECT simples, mais elle ne permet pas de prévenir les attaques par injection SQL car les paramètres ne sont pas liés dynamiquement. 
    // Il ne FAUT JAMAIS concatèner une requête SQL pour passer des variables, au risque de créer des injections SQL !

    // Par conséquent, il est recommandé d'utiliser la méthode prepare() pour toutes les requêtes qui incluent des variables ou des paramètres liés dynamiquement.
    // Comme ceci : 
    // $sqlQuery = 'SELECT * FROM movie';
    // $cinemaStatement = $pdo->prepare($sqlQuery);
    // $cinemaStatement->execute();
    // $movie = $cinemaStatement->fetchAll();

    // On utilise la méthode execute() de l'objet PDOStatement pour exécuter la déclaration préparée et obtenir un objet PDOStatement qui représente les résultats de la requête.
    // La méthode fetchAll() est appelée sur l'objet $statement après l'exécution de la requête avec la méthode execute().

    // On utilise la méthode fetchAll() de l'objet PDOStatement pour récupérer tous les résultats de la requête sous forme d'un tableau associatif. 
    // Chaque élément du tableau représente une ligne de la table movie, avec les clés du tableau correspondant aux noms des colonnes de la table.    
  
    // On pourrait également faire appel à $po->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);, qui désactive la fonctionnalité d'émulation des "requêtes préparées" de PDO. 
  
    // Par défaut, PDO émule les requêtes préparées côté client, ce qui peut potentiellement entraîner des failles de sécurité si les données entrantes ne sont pas correctement filtrées. 
  
    // En désactivant cette émulation, on s'assure que les requêtes préparées sont bien utilisées côté serveur, ce qui garantit une meilleure sécurité.
    // Car c'est ce qui nous permet d'optimiser l'exécution de la requête et de prévenir les attaques par injection SQL.

    $movies = $stmtCinema->fetchAll();
    // // Le nom de variable $stmt est couramment utilisé pour représenter un objet de requête préparée (PDOStatement en PHP). 
    // // Cette convention de nommage est assez répandue dans la communauté PHP pour représenter un objet de requête préparée qui sera utilisé pour exécuter une requête SQL.
    // // Cela permet de distinguer clairement la requête SQL de la variable qui la stocke.
    
    echo "<h3> Movie Table : </h3>";

    // Enfin, on parcourt le tableau de résultats en utilisant une boucle foreach qui permet d'afficher les informations de chaque film, comme le titre, l'année de sortie, la durée, etc. 
    foreach ($movies as $movie) 
    {
        echo '<p>'.$movie['movie_title'].' - release in - '.$movie['release_date'].' - duration - '.$movie['duration'].' minutes <br>'
        .$movie['synopsis'].'</p>';
    }  
  
?>