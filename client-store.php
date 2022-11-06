<?php
require_once 'class/Crud.php';

$Crud = new Crud;
// Va insérer un client dans la base de données
$insert = $Crud->insert('client', $_POST);