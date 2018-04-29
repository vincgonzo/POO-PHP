<?php


class Magicien extends Personnage
{
  protected $magie;


  public function lancerSort($perso)
  {
    $perso->recevoirDegats($this->magie);
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
