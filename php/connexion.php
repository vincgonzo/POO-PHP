<?php
$db = new PDO('mysql:host=localhost;dbname=poo-php', 'root', '');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

$manager = new PersonnageMapper($db);
