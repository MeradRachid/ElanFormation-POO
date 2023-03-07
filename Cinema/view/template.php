<!-- "template.php" qui servira de base / squelette à l'ensemble des vues.

On aura besoin de déclarer le doctype, les links css / js etc qu'une seule fois dans ce fichier. 

On exploitera ce qu'on appelle "la temporisation de sortie" en PHP -->

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $titre ?></title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link rel="stylesheet" href="public/css/style.css"/> 
    </head>
    <body>
        <div id="bodyWrap" class="container">
            <nav class="d-flex align-items-center navbar navbar-expand-lg bg-primary p-1 rounded" data-bs-theme="dark">
                <a href="#">
                    <img src="public/img/RaiKoh.png" alt="Logo" width="43" height="43" class="d-inline-block align-text-top rounded">
                </a>
                <a class="navbar-brand ps-3" href="#"><strong> Middle-Earth Cinema </strong></a>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link active dropdown-toggle" href="index.php?action=listGenres" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Genres
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="index.php?action=listGenres">Action</a></li>
                            <li><a class="dropdown-item" href="index.php?action=listGenres">Aventure</a></li>
                            <li><a class="dropdown-item" href="index.php?action=listGenres">Fantasy</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="index.php?action=listGenres">Show All</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link active dropdown-toggle" href="index.php?action=listFilms" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Films 
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="index.php?action=listFilms">Lord of Rings</a></li>
                            <li><a class="dropdown-item" href="index.php?action=listFilms">The Hobbit</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="index.php?action=listFilms">Show All</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link active dropdown-toggle" href="index.php?action=listCharacters" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Characters
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="index.php?action=listCharacters">Lord of Rings</a></li>
                            <li><a class="dropdown-item" href="index.php?action=listCharacters">The Hobbit</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="index.php?action=listCharacters">Show All</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link active dropdown-toggle" href="index.php?action=listActors" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Actors
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="index.php?action=listActors">Lord of Rings</a></li>
                            <li><a class="dropdown-item" href="index.php?action=listActors">The Hobbit</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="index.php?action=listActors">Show All</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link active dropdown-toggle" href="index.php?action=listDirectors" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Directors
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="index.php?action=listDirectors">Peter Jackson</a></li>
                            <li><a class="dropdown-item" href="index.php?action=listDirectors">Andy Serkis</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="index.php?action=listDirectors">Show All</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <?= $contenu ?>
            <!-- /**
            * On commence et on termine la vue par "ob_start()" et "ob_get_clean()"
            * On va donc "aspirer" tout ce qui se trouve entre ces 2 fonctions (temporisation de sortie)
            * Avec pour but de stocker le contenu dans une variable $contenu
            * 
            * Le require de fin permet d'injecter le contenu dans le template "squelette" template.php
            * 
            * Du coup dans notre "template.php" on aura des variables 
            * Qui vont accueillir les éléments provenant des différentes vues
            * Au final, DANS CHAQUE VUE, il faudra TOUJOURS : 
            * Donner une valeur à $titre, $contenu et $titre_secondaire
            *  */  -->
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
        </div>
    </body>
</html>