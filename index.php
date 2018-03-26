<?php
require 'autoload.php';

$perso = new Personnage([
  'nom' => 'Victor',
  'force_perso' => 5,
  'degats' => 0,
  'niveau' => 1,
  'experience' => 5
]);

$db = new PDO('mysql:host=localhost;dbname=poo-php', 'root', '');

$manager = new PersonnageMapper($db);

$manager->add($perso);
