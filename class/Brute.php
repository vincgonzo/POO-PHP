<?php


class Brute extends Personnage
{
  protected $extra_force;

  public function frapper(Personnage $perso)
  {
    $this->attrAtout();
    $this->extra_force = $this->force_perso() + $this->atout;

    if($perso->id() == $this->id){
        return self::CEST_MOI;
    }

    if($this->estEndormi())
    {
      return self::PERSO_ENDORMI;
    }

    $this->setExperience();

    return $perso->recevoirDegats($this->extra_force);
  }
}
