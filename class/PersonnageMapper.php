<?php
class PersonnageMapper
{
  private $_db;

  public function __construct($db)
 {
   $this->setDb($db);
 }

 public function add(Personnage $perso)
 {
   try {
     $q = $this->_db->prepare('INSERT INTO personnage(nom, force_perso, degats, niveau, experience) VALUES(:nom, :force_perso, :degats, :niveau, :experience)');

     $q->bindValue(':nom', $perso->nom());
     $q->bindValue(':force_perso', $perso->force_perso(), PDO::PARAM_INT);
     $q->bindValue(':degats', $perso->degats(), PDO::PARAM_INT);
     $q->bindValue(':niveau', $perso->niveau(), PDO::PARAM_INT);
     $q->bindValue(':experience', $perso->experience(), PDO::PARAM_INT);

    $q->execute();
  } catch (\Exception $e) {
    var_dump($e);
  }

 }

 public function delete(Personnage $perso)
 {
   $this->_db->exec('DELETE FROM personnage WHERE id = '.$perso->id());
 }

 public function get($id)
 {
   $id = (int) $id;

   $q = $this->_db->query('SELECT * FROM personnage WHERE id = '.$id);


   $donnees = $q->fetch(PDO::FETCH_ASSOC);

   return new Personnage($donnees);
 }

 public function getList()
 {
   $persos = [];

   $q = $this->_db->query('SELECT * FROM personnage ORDER BY nom');

   while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
   {
     $persos[] = new Personnage($donnees);
   }

   return $persos;
 }

 public function update(Personnage $perso)
 {
   $q = $this->_db->prepare('UPDATE personnage SET force_perso = :force_perso, degats = :degats, niveau = :niveau, experience = :experience WHERE id = :id');

   $q->bindValue(':force_perso', $perso->force_perso(), PDO::PARAM_INT);
   $q->bindValue(':degats', $perso->degats(), PDO::PARAM_INT);
   $q->bindValue(':niveau', $perso->niveau(), PDO::PARAM_INT);
   $q->bindValue(':experience', $perso->experience(), PDO::PARAM_INT);
   $q->bindValue(':id', $perso->id(), PDO::PARAM_INT);

   $q->execute();
 }

 public function setDb(PDO $db)
 {
   $this->_db = $db;
 }
}
