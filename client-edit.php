<?php
// S'il y a un id enovyé à partir de la page de liste des clients,
// récupérer celui-ci dans une variable et insérer les informations
// du client associé dans les champs pour la modification de ceux-ci
if(isset($_GET['id'])){
    $id = $_GET['id'];

    require_once "class/Crud.php";

    $Crud = new Crud;
    $client = $Crud->selectId('client', $id);
    $villes = $Crud->select('ville');

    extract($client);
}
// Sinon renvoyer l'utilisateur vers la liste de clients
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
    <title>Modifier</title>
    <style>
        input{
            display: block;
            margin: 5px;
        }
    </style>
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
        <h1>Modifier</h1>
        <form action="client-update.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id;?>">
            <label>Prénom 
                <input type="text" name="prenom" value="<?php echo $prenom;?>">
            </label>
            <label>Nom 
                <input type="text" name="nom" value="<?php echo $nom;?>">
            </label>
            <label>Adresse
                <input type="text" name="adresse" value="<?php echo $adresse;?>">
            </label>
            <label>Code Postal
                <input type="text" name="code_postal" value="<?php echo $code_postal;?>">
            </label>
            <label>Ville
                <select name="ville_id">
                <?php foreach($villes as $ville){ ?>
                    <option value="<?php echo $ville['id']; ?>" id="<?php echo $ville['id']; ?>"
                    <?php 
                    // Pour que la ville du client soit sélectionnée de base
                    if($ville['id'] == $client['ville_id']){
                        echo 'selected';
                    }
                    ?>
                    ><?php echo $ville['nom']; ?></option>
                <?php 
                }
                ?>
                </select>
            </label>
            <input type="submit" value="Modifier" class="submit">
        </form>
        <form action="client-delete.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id;?>">
            <input type="submit" value="Effacer" class="submit">
        </form>
    </main>
</body>
</html>