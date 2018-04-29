<?php
abstract class Personnage
{
  protected $_id,
          $_degats,
          $_force_perso,
          $_niveau,
          $_experience,
          $_nom;

  const CEST_MOI = 1;
  const PERSONNAGE_TUE = 2;
  const PERSONNAGE_FRAPPE = 3;

  public function __construct(array $donnees)
  {
    $this->hydrate($donnees);
  }

  public function hydrate(array $donnees)
  {
   foreach ($donnees as $key => $value)
   {
     $method = 'set'.ucfirst($key);

     if (method_exists($this, $method))
     {
       $this->$method($value);
     }
   }
  }

  public function frapper(Personnage $perso)
  {

    if($perso->id() == $this->_id){
        return self::CEST_MOI;
    }

    $this->setExperience();

    return $perso->recevoirDegats($this->force_perso());
  }

  public function recevoirDegats($degats)
  {
    $this->_degats += (5 * $degats);

    if($this->_degats >= 100){
      return self::PERSONNAGE_TUE;
    }

    return self::PERSONNAGE_FRAPPE;
  }

  public function nomValide()
  {
    return !empty($this->_nom);
  }

  public function degats()
  {
    return $this->_degats;
  }

  public function id()
  {
    return $this->_id;
  }

  public function nom()
  {
    return $this->_nom;
  }

  public function niveau()
  {
    return $this->_niveau;
  }

  public function experience()
  {
    return $this->_experience;
  }

  public function force_perso()
  {
    return $this->_force_perso;
  }

  public function setDegats($degats)
  {
    $degats = (int) $degats;

    if ($degats >= 0 && $degats <= 100)
    {
      $this->_degats = $degats;
    }
  }

  public function setForce()
  {
      $this->_force_perso += 1;
  }

  public function setNiveau()
  {
    if($this->_niveau % 20 == 0)
    {
      $this->_niveau += 1;
    }
  }

  public function setExperience()
  {
    if($this->_experience % 10 == 0)
    {
      $this->setForce();
    }
    $this->_experience += 1;
  }

  public function setId($id)
  {
    $id = (int) $id;

    if ($id > 0)
    {
      $this->_id = $id;
    }
  }

  public function setNom($nom)
  {
    if (is_string($nom))
    {
      $this->_nom = $nom;
    }
  }
}
