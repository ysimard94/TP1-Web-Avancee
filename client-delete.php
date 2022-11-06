<?php
require_once 'class/Crud.php';
$Crud = new Crud;
// Va servir à supprimer le client à partir de son id
$delete = $Crud->delete('client', $_POST['id']);

echo $delete;