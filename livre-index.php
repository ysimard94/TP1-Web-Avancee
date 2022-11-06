<?php
require_once "class/Crud.php";

$Crud = new Crud;

$livres = $Crud->select("livre", "titre");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livres</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <nav>
        <a href="index.php">Liste des locations</a>
        <a href="client-index.php">Liste des clients</a>
        <a href="livre-index.php">Liste des livres</a>
        <a href="location-create.php">Insérer une location</a>
        <a href="client-create.php">Créer un nouveau client</a>
    </nav>
    <main>
        <h1>Liste des livres</h1>
        <table>
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Auteur</th>
                    <th>Nombre de pages</th>
                    <th>Catégorie</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($livres as $livre){
                        $categorie = $Crud->selectCompare($livre['categorie_id'], '*', 'categorie');
                ?>
                    <tr>
                        <td><?php echo $livre['titre'] ?></td>
                        <td><?php echo $livre['auteur'] ?></td>
                        <td><?php echo $livre['nombre_pages'] ?></td>
                        <td><?php echo $categorie['nom']; ?></td>
                    </tr>
                <?php       
                    }
                ?>
            </tbody>
        </table>
    </main>
</body>
</html>