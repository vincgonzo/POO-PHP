<?php
if(isset($_SESSION['perso']))
{
  $perso = $_SESSION['perso'];
}


if (isset($_POST['creer']) && isset($_POST['nom']) && isset($_POST['type_perso']))
{
  switch ($_POST['type_perso']) {
    case 'magicien':
      $perso = new Magicien(['nom' => $_POST['nom']]);
      break;
    case 'guerrier':
      $perso = new Guerrier(['nom' => $_POST['nom']]);
      break;
    case 'brute':
      $perso = new Brute(['nom' => $_POST['nom']]);
      break;

    default:
      $message = 'le type du personnage est invalide.';
      break;
  }
  if(isset($perso))
  {

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

        case Personnage::PERSO_ENDORMI :
          $message = 'Vous êtes endormi, vous ne pouvez pas frapper de personnage !.';
          break;
      }
    }
  }
}

elseif (isset($_GET['ensorceler'])) {
  if(!isset($perso))
  {
    $message = 'Merci de créer un personnage ou de vous identifier.';
  }
  else
  {
    if($perso->type() != 'magicien')
    {
      $message = 'Seuls les magiciens peuvent ensorceler des personnages !';
    }
    else
    {
      $persoAEnsorceler = $manager->get((int) $_GET['ensorceler']);
      $retour = $perso->lancerUnSort($persoAEnsorceler);

      switch ($retour)
      {
        case Personnage::CEST_MOI :
          $message = 'Mais... pourquoi voulez-vous vous ensorceler ???';
          break;

        case Personnage::PERSONNAGE_ENSORCELE :
          $message = 'Le personnage a bien été ensorcelé !';

          $manager->update($perso);
          $manager->update($persoAEnsorceler);

          break;

        case Personnage::PAS_DE_MAGIE :
          $message = 'Vous n\'avez pas de magie !';
          break;

        case Personnage::PERSO_ENDORMI :
          $message = 'Vous êtes endormi, vous ne pouvez pas lancer de sort !';
          break;
      }
    }
  }
}
