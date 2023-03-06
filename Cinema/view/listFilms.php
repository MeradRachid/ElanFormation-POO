
        <?php ob_start(); ?>

        <p class="badge text-bg-info m-1 fs-5"> There are <?= $requete->rowCount() ?> films. </p>

        <table class="table table-striped-columns table-sm table-hover"> 
            <thead>
                <tr>
                    <th> # </th>
                    <th> MOVIE TITLE </th>
                    <th> RELEASED ON </th>
                    <th> DURATION </th>
                </tr>

            </thead>
            <tbody class="table-group-divider">
                <?php
                    foreach($requete->fetchAll() as $id => $film)
                    { ?>
                        <tr>
                            <td> <?= $id ?> </td>
                            <td> <?= $film["movie_title"] ?> </td>
                            <td> <?= $film["release_date"] ?> </td>
                            <td> <?= $film["duration"] ?> </td>
                        </tr>
              <?php } ?>
            </tbody>
        </table>

        <?php

        $titre = "Liste des Films"; 
        $titre_secondaire = "Liste des films";
            $contenu = ob_get_clean();
            require "view/template.php";        
        ?>