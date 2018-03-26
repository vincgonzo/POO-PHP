<?php
class Personnage
{
  private $_id;
  private $_nom;
  private $_force_perso;
  private $_degats;
  private $_niveau;
  private $_experience;

  public function __construct(array $datas)
  {
    foreach ($datas as $key => $value) {
      $method = 'set'.ucfirst($key);

      if(method_exists($this, $method)){
        $this->$method($value);
      }
    }
  }

  // Getters
 public function id()
 {
   return $this->_id;
 }

 public function nom()
 {
   return $this->_nom;
 }

 public function force_perso()
 {
   return $this->_force_perso;
 }

 public function degats()
 {
   return $this->_degats;
 }

 public function niveau()
 {
   return $this->_niveau;
 }

 public function experience()
 {
   return $this->_experience;
 }

 // Setters
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

 public function setForce_perso($force_perso)
 {
   $force_perso = (int) $force_perso;

   if ($force_perso >= 1 && $force_perso <= 100)
   {
     $this->_force_perso = $force_perso;
   }
 }

 public function setDegats($degats)
 {
   $degats = (int) $degats;

   if ($degats >= 0 && $degats <= 100)
   {
     $this->_degats = $degats;
   }
 }

 public function setNiveau($niveau)
 {
   $niveau = (int) $niveau;

   if ($niveau >= 1 && $niveau <= 100)
   {
     $this->_niveau = $niveau;
   }
 }

 public function setExperience($experience)
 {
   $experience = (int) $experience;

   if ($experience >= 1 && $experience <= 100)
   {
     $this->_experience = $experience;
   }
 }
}
