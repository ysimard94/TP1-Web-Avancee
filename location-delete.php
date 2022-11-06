<?php
require_once 'class/Crud.php';

$Crud = new Crud;
// Va servir à supprimer une location à partir de son id
$delete = $Crud->delete('location', $_POST['id']);
