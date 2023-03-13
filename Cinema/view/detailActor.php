
<?php ob_start(); ?>

<table class="table table-striped-columns table-sm table-hover"> 
    <thead>
        <tr>
            <th> # </th>
            <th> FIRSTNAME </th>
            <th> LASTNAME </th>
            <th> GENDER </th>
        </tr>

    </thead>
    <tbody class="table-group-divider">
        <?php
            foreach($requete->fetchAll() as $id => $film)
            { ?>
                <tr>
                    <td> <?= $id ?> </td>
                    <td> <?= $film["firstName"] ?> </td>
                    <td> <?= $film["lastName"] ?> </td>
                    <td> <?= $film["gender"] ?> </td>
                </tr>
      <?php } ?>
    </tbody>
</table>

<?php

$titre = "Liste des Acteurs"; 
$titre_secondaire = "Liste des acteurs";
    $contenu = ob_get_clean();
    require "view/template.php";        
?>