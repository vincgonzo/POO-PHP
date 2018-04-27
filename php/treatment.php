<?php
if (isset($_POST['creer']) && isset($_POST['nom']))
{
  $perso = new Personnage(['nom' => $_POST['nom']]);

  if (!$perso->nomValide())
  {
    $message = 'Le nom choisi est invalide.';
    unset($perso);
  }
  elseif ($manager->exists($perso->nom()))
  {
    $message = 'Le nom du personnage est déjà pris.';
    unset($perso);
  }
  else
  {
    $manager->add($perso);
  }
}

elseif (isset($_POST['utiliser']) && isset($_POST['nom']))
{
  if ($manager->exists($_POST['nom']))
  {
    $perso = $manager->get($_POST['nom']);
  }
  else
  {
    $message = 'Ce personnage n\'existe pas !';
  }
}

elseif (isset($_GET['frapper']))
{
  if (!isset($perso))
  {
    $message = 'Merci de créer un personnage ou de vous identifier.';
  }

  else
  {
    if (!$manager->exists((int) $_GET['frapper']))
    {
      $message = 'Le personnage que vous voulez frapper n\'existe pas !';
    }

    else
    {
      $persoAFrapper = $manager->get((int) $_GET['frapper']);

      $retour = $perso->frapper($persoAFrapper); // On stocke dans $retour les éventuelles erreurs ou messages que renvoie la méthode frapper.

      switch ($retour)
      {
        case Personnage::CEST_MOI :
          $message = 'Mais... pourquoi voulez-vous vous frapper ???';
          break;

        case Personnage::PERSONNAGE_FRAPPE :
          $message = 'Le personnage a bien été frappé !';

          $manager->update($perso);
          $manager->update($persoAFrapper);

          break;

        case Personnage::PERSONNAGE_TUE :
          $message = 'Vous avez tué ce personnage !';

          $manager->update($perso);
          $manager->delete($persoAFrapper);

          break;
      }
    }
  }
}
