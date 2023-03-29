<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script src="https://cdn.tiny.cloud/1/zg3mwraazn1b2ezih16je1tc6z7gwp5yd4pod06ae5uai8pa/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="icon" type="image/png" href="public/img/moon.jpg">
    <title>FORUM DU PLATEAU</title>
</head>

<body class="bg-secondary-subtle text-emphasis-secondary no-repeat" background="public/img/bg_bggenerator_com.png">
    <div id="wrapper" class="container d-flex flex-column bg-primary-subtle">
       <div id="mainpage">
            <!-- c'est ici que les messages (erreur ou succès) s'affichent-->
            <h3 class="message" style="color: red"><?= App\Session::getFlash("error") ?></h3>
            <h3 class="message" style="color: green"><?= App\Session::getFlash("success") ?></h3>

            <header>
            <nav class="d-flex align-items-center justify-content-between navbar navbar-expand-lg bg-secondary p-1 rounded" data-bs-theme="dark">
                <a href="index.php?action=homePage"><img src="public/img/moon.jpg" alt="Logo" width="43px" height="43px" class="d-inline-block align-text-top rounded"></a>
                <a class="navbar-brand" href="index.php?action=homePage"><strong> COMMUNAUTÉ FRANÇAISE DES JOUEURS DE TCG : RÉGION GRAND-EST </strong></a>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown d-flex">
                        <ul class="d-flex align-items-center justify-content-center">
                            <?php
                                if(App\Session::getUser())
                                {
                            ?>
                                    <a href="/security/viewProfile.html">
                                        <span class="fas fa-user"></span>&nbsp;<?= App\Session::getUser()?>
                                    </a> 

                                    <a href="index.php?ctrl=security&action=logout">Déconnexion</a> 
                            <?php
                                }
                                else
                                { 
                            ?>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-primary active"><a href="index.php?action=home" class="text-decoration-none text-reset">Accueil</a></button>
                                <button type="button" class="btn btn-primary"><a href="index.php?ctrl=security&action=loginForm" class="text-decoration-none text-reset">Connexion</a></button>
                                <button class="nav-item dropdown btn btn-primary">
                                <span class="nav-link active dropdown-toggle text-decoration-none text-reset" role="button" data-bs-toggle="dropdown" aria-expanded="false"> Vers la liste des </span>
                                    <ul class="dropdown-menu text-center">
                                        <li><a href="index.php?ctrl=forum&action=listCategories" class="text-decoration-none text-center"> Catégories, </a></li>
                                        <li><a href="index.php?ctrl=forum&action=index" class="text-decoration-none text-center"> Topics, </a></li>
                                        <li><a href="index.php?ctrl=forum&action=listUsers" class="text-decoration-none text-center"> Users.</a></li>
                                    </ul>
                                </button>
                                <button type="button" class="btn btn-info"><a href="index.php?ctrl=security&action=registerForm" class="text-decoration-none text-reset">Inscription</a></button>
                            </div>

                            <?php
                                }
                            ?>

                        <p>
                            <?php
                                if(App\Session::isAdmin())
                                {
                                    ?>
                                        <a href="index.php?ctrl=home&action=users">Voir la liste des utilisateurs</a>
                                    <?php
                                }
                            ?>
                        </p>
                    </ul>
                </nav>
           </header>
           
           <main id="forum" class="d-flex flex-column"> 

                <?= $page ?> <!-- C'est ici qu'on applique la temporisation de sortie avec $page == $content( ou $contenu) -->

           </main>

       </div>

       <footer class="text-center">
            <p>&copy; 2020 - Forum CDA - <a href="/home/forumRules.html">Règlement du forum</a> - <a href="">Mentions légales</a></p>
            <!--<button id="ajaxbtn">Surprise en Ajax !</button> -> cliqué <span id="nbajax">0</span> fois-->
       </footer>
   </div>

   <script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous">
    </script>
    <script>

        $(document).ready(function(){
            $(".message").each(function(){
                if($(this).text().length > 0){
                    $(this).slideDown(500, function(){
                        $(this).delay(3000).slideUp(500)
                    })
                }
            })
            $(".delete-btn").on("click", function(){
                return confirm("Etes-vous sûr de vouloir supprimer?")
            })
            tinymce.init({
                selector: '.post',
                menubar: false,
                plugins: [
                    'advlist autolink lists link image charmap print preview anchor',
                    'searchreplace visualblocks code fullscreen',
                    'insertdatetime media table paste code help wordcount'
                ],
                toolbar: 'undo redo | formatselect | ' +
                'bold italic backcolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | help',
                content_css: '//www.tiny.cloud/css/codepen.min.css'
            });
        })        

        /*
        $("#ajaxbtn").on("click", function(){
            $.get(
                "index.php?action=ajax",
                {
                    nb : $("#nbajax").text()
                },
                function(result){
                    $("#nbajax").html(result)
                }
            )
        })*/
    </script>
        
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    
</body>
</html>