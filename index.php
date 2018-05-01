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
 ?>
    <p><a href="?deconnexion=1">Déconnexion</a></p>
     <fieldset>
       <legend>Mes informations</legend>
       <p>
         Nom : <?= htmlspecialchars($perso->nom()) ?><br />
         Dégâts : <?= $perso->degats() ?><br/>
         Force Personnage : <?= $perso->force_perso() ?><br/>
         Xp : <?= $perso->experience() ?>
         <?php
          switch ($perso->type()) {
            case 'magicien':
              echo 'Magie :';
              break;

            case 'guerrier':
              echo 'Protection :';
              break;
          }

          echo $perso->atout();
            ?>
       </p>
     </fieldset>

     <fieldset>
       <legend>Qui frapper ?</legend>
       <p>
 <?php
 $returnPerso = $manager->getList($perso->nom());

 if (empty($returnPerso))
 {
   echo 'Personne à frapper !';
 }

 else
 {
   if($perso->estEndormi())
   {
     echo 'Un magicien vous a endormi ! Vous allez vous réveiller dans '. $perso->reveil() .'.';
   }
   foreach ($returnPerso as $unPerso)
   {
     echo '<a href="?frapper=', $unPerso->id(), '">', htmlspecialchars($unPerso->nom()), '</a> (dégâts : ', $unPerso->degats(), '<br />type = '. $unPerso->type() .' )';

     if($perso->type() == 'magicien')
     {
       echo '| <a href"?ensorceler='. $unPerso->id().'">Lancer un sort</a>';
     }
     echo '<br/>';
   }
 }

 ?>
       </p>
     </fieldset>
 <?php
 }
 else
 {
 ?>
     <form action="" method="post">
       <p>
         Nom : <input type="text" name="nom" maxlength="50" />
         <input type="submit" value="Créer ce personnage" name="creer" />
         <select class="type_perso" name="type_perso">
           <option value="magicien">Magicien</option>
           <option value="guerrier">Guerrier</option>
         </select>
         <input type="submit" value="Utiliser ce personnage" name="utiliser" />
       </p>
     </form>
 <?php
 }
 ?>
   </body>
 </html>
 <?php
 if (isset($perso))
{
  $_SESSION['perso'] = $perso;
}
