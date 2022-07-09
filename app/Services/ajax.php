<?php

namespace App\Services;

use Database\DBConnection;
use \PDO;

require '../../database/DBConnection.php';
require '../../database/config.php';

$contents = file_get_contents("php://input");
$data = json_decode($contents, true);

$search = "%".$data['textToFind']."%"; 

$bdd = (new DBConnection(DB_NAME, DB_HOST, DB_USER, DB_PWD))->getPDO();

$stmt = $bdd->prepare('SELECT * FROM book WHERE title LIKE :find ORDER BY id DESC');
$stmt->bindValue('find', $search, PDO::PARAM_STR);
$stmt->execute();
$books = $stmt->fetchAll(PDO::FETCH_ASSOC);

if(count($books) > 1) {
    $text = count($books)." livres";
} else{
    $text = count($books)." livre";
}

include '../../views/searchbar.phtml';
