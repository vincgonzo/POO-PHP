<?php
require 'autoload.php';



$db = new PDO('mysql:host=localhost;dbname=poo-php', 'root', '');

$manager = new PersonnageMapper($db);
