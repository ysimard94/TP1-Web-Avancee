<?php
require_once "class/Crud.php";

$Crud = new Crud;

$clients = $Crud->select("client", "nom");
$livres = $Crud->select("livre", "titre");

// J'insère la date de début ainsi qu'une date de fin de location
// de 7 à 14 jours tout dépendant de l'option choisi par le client
$datedebut = date("Y-m-d");
$datefin7 = strtotime("+7 day");
$datefin7 = date("Y-m-d", $datefin7);
$datefin14 = strtotime("+14 day");
$datefin14 = date("Y-m-d", $datefin14);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvelle location</title>
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
        <h2>Saisir une location</h2>
        <form action="location-store.php" method="post">
            <label>Client
                <select name="client_id">
                <?php foreach($clients as $client){ ?>
                    <option value="<?php echo $client['id']; ?>" name="<?php echo $client['id']; ?>"><?php echo $client['prenom'] . ' ' . $client['nom']; ?></option>
                <?php 
                }
                ?>
                </select>
            </label>
            <br>
            <label>Livre
                <select name="livre_id">
                <?php foreach($livres as $livre){ ?>
                    <option value="<?php echo $livre['id']; ?>" name="<?php echo $livre['id']; ?>"><?php echo $livre['titre']; ?></option>
                <?php 
                }
                ?>
                </select>
            </label>
            <br>
            <label>Durée de location
                <select name="datefin">
                    <option value="<?php echo $datefin7 ?>" name="datefin">1 semaine</option>
                    <option value="<?php echo $datefin14 ?>" name="datefin">2 semaines</option>
                </select>
            </label>
            <input type="hidden" name="datedebut" value="<?php echo $datedebut; ?>">
            <input type="submit" value="Enregistrer" class="submit">
        </form>
    </main>
</body>
</html>