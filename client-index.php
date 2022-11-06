<?php
require_once "class/Crud.php";

$Crud = new Crud;

$client = $Crud->select("client", "nom", "DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
        <h1>Liste de clients</h1>
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Adresse</th>
                    <th>Code Postal</th>
                    <th>Téléphone</th>
                    <th>Ville</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($client as $row){
                        // Va retourner la ville du client grâce à une comparaison de requête SQL
                        $ville = $Crud->selectCompare($row['ville_id'], '*', 'ville');
                ?>
                    <tr>
                        <td><a href="client-show.php?id=<?php echo $row['id'] ?>"><?php echo $row['prenom'] . ' ' . $row['nom'] ?></a></td>
                        <td><?php echo $row['adresse']; ?></td>
                        <td><?php echo $row['code_postal']; ?></td>
                        <td><?php echo $row['phone']; ?></td>
                        <td><?php echo $ville['nom']; ?></td>

                    </tr>
                <?php       
                    }
                ?>
            </tbody>
        </table>
    </main>
</body>
</html>