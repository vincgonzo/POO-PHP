<?php


class Magicien extends Personnage
{
  protected $magie;

  public function lancerUnSort(Personnage $perso)
  {
    $this->attrAtout();

    if ($perso->id == $this->id)
    {
      return self::CEST_MOI;
    }

    if ($this->atout == 0)
    {
      return self::PAS_DE_MAGIE;
    }

    if ($this->estEndormi())
    {
      return self::PERSO_ENDORMI;
    }

    $perso->time_endormi = time() + ($this->atout * 6) * 3600;

    return self::PERSONNAGE_ENSORCELE;
  }

  public function gagnerExperience()
  {
    parent::gagnerExperience();

    if($this->magie < 100)
    {
      $this->magie += 10;
    }
  }
}
