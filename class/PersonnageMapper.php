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
     $q = $this->_db->prepare('INSERT INTO personnage(nom, type) VALUES(:nom, :type)');
     $q->bindValue(':nom', $perso->nom());
     $q->bindValue(':type', $perso->type());
    $q->execute();

    $perso->hydrate([
      'id' => $this->_db->lastInsertId(),
      'degats' => 0,
      'atout' => 0,
    ]);
 }

  public function count()
  {
    return $this->_db->prepare('SELECT COUNT(*) FROM personnage')->fetchColumn();
  }

 public function delete(Personnage $perso)
 {
   $this->_db->exec('DELETE FROM personnage WHERE id = '.$perso->id());
 }

 public function exists($info)
 {
    if(is_int($info))
    {
      return (bool) $this->_db->query('SELECT COUNT(*) FROM personnage WHERE id = '.$info)->fetchColumn();
    }

    $q = $this->_db->prepare('SELECT COUNT(*) FROM personnage WHERE nom = :nom');
    $q->execute([':nom' => $info]);

    return (bool) $q->fetchColumn();
 }

 public function get($info)
 {

   if (is_int($info) )
     {
       $q = $this->_db->query('SELECT id, nom, degats, force_perso, experience, time_endormi, type, atout FROM personnage WHERE id = '.$info);
       $perso = $q->fetch(PDO::FETCH_ASSOC);
     }
     else
     {
       $q = $this->_db->prepare('SELECT id, nom, degats, time_endormi, type, atout FROM personnage WHERE nom = :nom');
       $q->execute([':nom' => $info]);

       $perso = $q->fetch(PDO::FETCH_ASSOC);
     }

     switch($perso['type'])
     {
       case 'guerrier': return new Guerrier($perso);
       case 'magicien': return new Magicien($perso);
       case 'brute': return new Brute($perso);
       default: return null;
     }
 }

 public function getList($nom)
  {
    $persos = [];

    $q = $this->_db->prepare('SELECT id, nom, degats, force_perso, experience, time_endormi, type, atout FROM personnage WHERE nom <> :nom ORDER BY nom');
    $q->execute([':nom' => $nom]);

    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
      switch($donnees['type'])
      {
        case 'guerrier': $persos[] = new Guerrier($donnees);break;
        case 'magicien': $persos[] = new Magicien($donnees);break;
        case 'brute': $persos[] = new Brute($donnees);break;
      }
    }

    return $persos;
  }

 public function update(Personnage $perso)
 {
   $q = $this->_db->prepare('UPDATE personnage SET degats = :degats, force_perso = :force_perso, experience = :experience, time_endormi = :time_endormi, atout = :atout WHERE id = :id');

   $q->bindValue(':force_perso', $perso->force_perso(), PDO::PARAM_INT);
   $q->bindValue(':experience', $perso->experience(), PDO::PARAM_INT);
   $q->bindValue(':degats', $perso->degats(), PDO::PARAM_INT);
   $q->bindValue(':time_endormi', $perso->time_endormi(), PDO::PARAM_INT);
   $q->bindValue(':atout', $perso->atout(), PDO::PARAM_INT);
   $q->bindValue(':id', $perso->id(), PDO::PARAM_INT);

   $q->execute();
 }

 public function setDb(PDO $db)
 {
   $this->_db = $db;
 }
}
