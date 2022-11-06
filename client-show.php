<?php
if(isset($_GET['id']))
{
    $id = $_GET['id'];
    require_once "class/Crud.php";
    $Crud = new Crud;
    $client = $Crud->selectId('client', $id);
    // Va retourner la ville du client grâce à une comparaison de requête SQL
    $ville = $Crud->selectCompare($client['ville_id'], '*', 'ville');

    extract($client);
}
else
{
    header('Location: client-index.php');
}
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
        <p><strong>Prénom : </strong><?php echo $prenom; ?></p>
        <p><strong>Nom : </strong><?php echo $nom; ?></p>
        <p><strong>Adresse : </strong><?php echo $adresse; ?></p>
        <p><strong>Code Postal : </strong><?php echo $code_postal; ?></p>
        <p><strong>Téléphone : </strong><?php echo $phone; ?></p>
        <p><strong>Ville : </strong><?php echo $ville['nom']; ?></p>
        <p><a href="client-edit.php?id=<?php echo $id; ?>">Modifier</a></p>
    </main>
</body>
</html>