<?php
abstract class Personnage
{
  protected $id,
          $nom,
          $degats,
          $force_perso,
          $niveau,
          $experience,
          $time_endormi,
          $type,
          $atout;

  const CEST_MOI = 1;
  const PERSONNAGE_TUE = 2;
  const PERSONNAGE_FRAPPE = 3;
  const PERSONNAGE_ENSORCELE = 4;
  const PAS_DE_MAGIE = 5;
  const PERSO_ENDORMI = 6;

  public function __construct(array $donnees)
  {
    $this->hydrate($donnees);
    $this->type = strtolower(static::class);
  }

  // Method to hydrate the db
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

  public function estEndormi()
  {
    return $this->time_endormi > time();
  }

  public function frapper(Personnage $perso)
  {

    if($perso->id() == $this->id){
        return self::CEST_MOI;
    }

    if($this->estEndormi())
    {
      return slef::PERSO_ENDORMI;
    }

    $this->setExperience();

    return $perso->recevoirDegats($this->force_perso());
  }

  public static function recevoirDegats($degats)
  {
    $this->degats += (5 * $degats);

    if($this->degats >= 100){
      return self::PERSONNAGE_TUE;
    }

    return self::PERSONNAGE_FRAPPE;
  }

  public function nomValide()
  {
    return !empty($this->nom);
  }

  public function reveil()
  {
    $secondes = $this->time_endormi;
    $secondes -= time();

    $heures = floor($secondes / 3600);
    $secondes -= $heures * 3600;
    $minutes = floor($secondes / 60);
    $secondes -= $minutes * 60;

    $heures .= $heures <= 1 ? ' heure' : ' heures';
    $minutes .= $minutes <= 1 ? ' minute' : ' minutes';
    $secondes .= $secondes <= 1 ? ' seconde' : ' secondes';

    return $heures . ', ' . $minutes . ' et ' . $secondes;
  }

  public function atout()
  {
    return $this->atout;
  }

  public function degats()
  {
    return $this->degats;
  }

  public function id()
  {
    return $this->id;
  }

  public function nom()
  {
    return $this->nom;
  }

  public function niveau()
  {
    return $this->niveau;
  }

  public function experience()
  {
    return $this->experience;
  }

  public function force_perso()
  {
    return $this->force_perso;
  }

  public function time_endormi()
  {
    return $this->time_endormi;
  }

  public function type()
  {
    return $this->type;
  }

  public function setAtout($atout)
  {
    $atout = (int) $atout;

    if ($atout >= 0 && $atout <= 100)
    {
      $this->atout = $atout;
    }
  }

  public function atout()
  {
    return $this->atout;
  }

  public function setDegats($degats)
  {
    $degats = (int) $degats;

    if ($degats >= 0 && $degats <= 100)
    {
      $this->degats = $degats;
    }
  }

  public function setForce()
  {
      $this->force_perso += 1;
  }

  public function setNiveau()
  {
    if($this->niveau % 20 == 0)
    {
      $this->niveau += 1;
    }
  }

  public function setExperience()
  {
    if($this->experience % 10 == 0)
    {
      $this->setForce();
    }
    $this->experience += 1;
  }

  public function setId($id)
  {
    $id = (int) $id;

    if ($id > 0)
    {
      $this->id = $id;
    }
  }

  public function setNom($nom)
  {
    if (is_string($nom))
    {
      $this->nom = $nom;
    }
  }

  public function settime_endormi($time)
   {
     $this->time_endormi = (int) $time;
   }
}
