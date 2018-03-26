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
var_dump($db);
$manager = new PersonnageMapper($db);
var_dump($manager);

$manager->add($perso);
/*
$perso1 = new Personnage(Personnage::FORCE_PETITE, 50); // Un premier personnage
$perso2 = new Personnage(Personnage::FORCE_MOYENNE, 20); // Un second personnage

$perso1->setForce(10);
$perso1->setExperience(2);

$perso2->setForce(90);
$perso2->setExperience(58);

$perso1->frapper($perso2);  // $perso1 frappe $perso2
$perso1->gagnerExperience(); // $perso1 gagne de l'expérience

$perso2->frapper($perso1);  // $perso2 frappe $perso1
$perso2->gagnerExperience(); // $perso2 gagne de l'expérience

echo 'Le personnage 1 a ', $perso1->force(), ' de force, contrairement au personnage 2 qui a ', $perso2->force(), ' de force.<br />';
echo 'Le personnage 1 a ', $perso1->experience(), ' d\'expérience, contrairement au personnage 2 qui a ', $perso2->experience(), ' d\'expérience.<br />';
echo 'Le personnage 1 a ', $perso1->degats(), ' de dégâts, contrairement au personnage 2 qui a ', $perso2->degats(), ' de dégâts.<br />';

Personnage::talk();

$count1 = new Compteur();
$count2 = new Compteur();
$count3 = new Compteur();

echo Compteur::getCompteur();*/
