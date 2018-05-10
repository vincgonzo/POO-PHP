<?php
require 'autoload.php';

session_start(); // On appelle session_start() APRÈS avoir enregistré l'autoload.

if (isset($_GET['deconnexion']))
{
  session_destroy();
  header('Location: .');
  exit();
}

if (isset($_SESSION['perso'])) // Si la session perso existe, on restaure l'objet.
{
  $perso = $_SESSION['perso'];
}
require 'php/connexion.php';
require 'php/treatment.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <title>TP : Mini jeu de combat</title>

    <meta charset="utf-8" />
  </head>
  <body>
    <p>Nombre de personnages créés : <?= $manager->count() ?></p>
<?php
if (isset($message)) // On a un message à afficher ?
 echo '<p>', $message, '</p>'; // Si oui, on l'affiche.

 if (isset($perso)) // Si on utilise un personnage (nouveau ou pas).
 {
   include 'views/arena.php';
 }
 else
 {
   include 'views/personnage-selection.php';
 }
 ?>
   </body>
 </html>
 <?php
 if (isset($perso))
{
  $_SESSION['perso'] = $perso;
}
