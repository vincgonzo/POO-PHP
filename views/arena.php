<p><a href="?deconnexion=1">Déconnexion</a></p>
 <fieldset>
   <legend>Mes informations</legend>
   <p>
     Nom : <?= htmlspecialchars($perso->nom()) ?><br />
     Dégâts : <?= $perso->degats() ?><br/>
     Force Personnage : <?= $perso->force_perso() ?><br/>
     Xp : <?= $perso->experience() ?><br/>
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
 echo 'Un magicien vous a endormi ! Vous allez vous réveiller dans '. $perso->reveil() .'.<br/>';
}
foreach ($returnPerso as $unPerso)
{
 echo '<a href="?frapper=', $unPerso->id(), '">', htmlspecialchars($unPerso->nom()), '</a> (dégâts : ', $unPerso->degats(), ' -- type = '. $unPerso->type() .' )';

 if($perso->type() == 'magicien')
 {
   echo '| <a href="?ensorceler='. $unPerso->id().'">Lancer un sort</a>';
 }
 echo '<br/>';
}
}

?>
   </p>
 </fieldset>
