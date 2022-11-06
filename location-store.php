<?php
require_once 'class/Crud.php';

$Crud = new Crud;
// Va insérer une location dans la base de données
$insert = $Crud->insert('location', $_POST);