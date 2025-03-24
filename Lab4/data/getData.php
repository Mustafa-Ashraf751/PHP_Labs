<?php

require __DIR__ . '/connect_pdo.php';


function getAll()
{
  $data = null;
  try {
    $conn = connect_to_db_pdo();

    if ($conn) {
      $select_query = "select * from `users`";

      $stmt = $conn->prepare($select_query);

      $stmt->execute();

      $data = $stmt->fetchAll(Pdo::FETCH_ASSOC);

      $conn = null;
    }
  } catch (PDOException $e) {
    echo $e->getMessage();
  }
  return $data;
}


function getUserByEmail($email)
{

  $data = null;

  try {
    $conn = connect_to_db_pdo();

    if ($conn) {
      $select_query = "select * from `users` where email = ?";

      $stmt = $conn->prepare($select_query);

      $stmt->execute([$email]);

      $data = $stmt->fetch(PDO::FETCH_ASSOC);

      $conn = null;
    }
  } catch (PDOException $e) {
    echo $e->getMessage();
  }

  return $data;
}

function getUserById($id)
{

  $data = null;

  try {
    $conn = connect_to_db_pdo();

    if ($conn) {
      $select_query = "select * from `users` where id = ?";

      $stmt = $conn->prepare($select_query);

      $stmt->execute([$id]);

      $data = $stmt->fetch(PDO::FETCH_ASSOC);

      $conn = null;
    }
  } catch (PDOException $e) {
    echo $e->getMessage();
  }

  return $data;
}
