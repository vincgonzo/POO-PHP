<?php
class Personnage
{
  private $_force;
  private $_experience;
  private $_localisation;
  private $_degats;

  const FORCE_PETITE = 20;
  const FORCE_MOYENNE = 50;
  const FORCE_GRANDE = 70;

  private static $_textToSay = 'I\'m gonna kill you boy !!';

  public function __construct($force, $degats)
  {
    $this->setForce($force);
    $this->setDegats($degats);
    $this->_experience = 1;
  }

  public function frapper(Personnage $persoAFrapper)
  {
    $persoAFrapper->_degats += $this->_force;
  }

  public function gagnerExperience()
  {
    $this->_experience++;
  }

  // Mutateur chargé de modifier l'attribut $_degats.
   public function setDegats($degats)
   {
     if (!is_int($degats)) // S'il ne s'agit pas d'un nombre entier.
     {
       trigger_error('Le niveau de dégâts d\'un personnage doit être un nombre entier', E_USER_WARNING);
       return;
     }

     $this->_degats = $degats;
   }

  public function setForce($force)
  {
    if (in_array($force, [self::FORCE_PETITE, self::FORCE_MOYENNE, self::FORCE_GRANDE]))
    {
      $this->_force = $force;
    }

    if ($force > 100)
    {
      trigger_error('La force d\'un personnage ne peut dépasser 100', E_USER_WARNING);
      return;
    }

    $this->_force = $force;
  }

  public function setExperience($experience)
  {
    if (!is_int($experience))
    {
      trigger_error('L\'expérience d\'un personnage doit être un nombre entier', E_USER_WARNING);
      return;
    }

    if ($experience > 100)
    {
      trigger_error('L\'expérience d\'un personnage ne peut dépasser 100', E_USER_WARNING);
      return;
    }

    $this->_experience = $experience;
  }

  public function degats()
  {
    return $this->_degats;
  }

  public function force()
  {
    return $this->_force;
  }

  public function experience()
  {
    return $this->_experience;
  }

  public static function talk()
  {
    echo self::$_textToSay;
  }
}
