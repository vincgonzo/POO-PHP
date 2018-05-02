<?php


class Guerrier extends Personnage
{
  protected $defense;

  public function recevoirDegats($degats)
  {
      if ($this->degats >= 0 && $this->degats <= 25)
      {
        $this->atout = 4;
      }
      elseif ($this->degats > 25 && $this->degats <= 50)
      {
        $this->atout = 3;
      }
      elseif ($this->degats > 50 && $this->degats <= 75)
      {
        $this->atout = 2;
      }
      elseif ($this->degats > 75 && $this->degats <= 90)
      {
        $this->atout = 1;
      }
      else
      {
        $this->atout = 0;
      }

      $this->degats += ((5 - $this->atout) * $degats);

      if ($this->degats >= 100)
      {
        return self::PERSONNAGE_TUE;
      }

      return self::PERSONNAGE_FRAPPE;
  }
}
