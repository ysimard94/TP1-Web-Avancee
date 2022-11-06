<?php
require_once 'class/Crud.php';

$Crud = new Crud;
// Va mettre à jour les informations modifiés du profil du client
$update = $Crud->update('client', $_POST);

?>