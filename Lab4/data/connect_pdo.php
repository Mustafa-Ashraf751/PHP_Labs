<?php

require __DIR__ . '/connect_credits.php';

function  connect_to_db_pdo()
{
  $pdo = false;

  try {
    $dns = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";port=" . DB_PORT;

    $pdo = new PDO($dns, DB_USER, DB_PASSWORD);
  } catch (PDOException $e) {

    echo $e->getMessage();
  }

  return $pdo;
}


connect_to_db_pdo();
