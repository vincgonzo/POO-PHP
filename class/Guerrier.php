<?php


class Guerrier extends Personnage
{
  protected $defense;

  public function recevoirDegats($degats)
  {
      $this->attrAtout();

      $this->degats += ((5 - $this->atout) * $degats);

      if ($this->degats >= 100)
      {
        return self::PERSONNAGE_TUE;
      }

      return self::PERSONNAGE_FRAPPE;
  }
}
