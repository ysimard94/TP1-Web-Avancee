<?php
require_once "class/Crud.php";

$Crud = new Crud;

$clients = $Crud->select("client");
$livres = $Crud->select("livre");
$locations = $Crud->select("location");


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des locations</title>
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
        <h1>Liste des locations</h1>
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Livre</th>
                    <th>Date début</th>
                    <th>Date fin</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($locations as $row){
                        // $ville = $Crud->selectVille($row['ville_id']);
                        $nom = $Crud->selectCompare($row['client_id'], '*' ,'client' );
                        $livre = $Crud->selectCompare($row['livre_id'], '*', 'livre');
                 
                        
                ?>
                    <tr>
                        <td><?php echo $nom['prenom'] . ' ' . $nom['nom'] ?></td>
                        <td><?php echo $livre['titre'] ?></td>
                        <td><?php echo $row['datedebut']; ?></td>
                        <td><?php echo $row['datefin']; ?></td>
                        <td>
                            <form action="location-delete.php" method="post">
                                <input type="hidden" name="id" value="<?php echo $row['id'];?>">
                                <input type="submit" value="Effacer">
                            </form> 
                        </td>
                    </tr>
                <?php       
                    }
                ?>
            </tbody>
        </table>
    </main>
</body>
</html>