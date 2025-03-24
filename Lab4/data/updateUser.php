<?php

//require __DIR__ . '/connect_pdo.php';

function updateUser($userData)
{

  try {

    $conn = connect_to_db_pdo();

    if ($conn) {
      $query = "update users set full_name=? , email = ? ,room_no = ? ,extension=?,profile_picture = ? where id = ?";


      $stmt = $conn->prepare($query);

      $result = $stmt->execute([
        $userData['fullName'],
        $userData['email'],
        $userData['roomNo'],
        $userData['extension'],
        $userData['profilePicture'],
        $userData['id']
      ]);

      $conn = null;
      return $result;
    }
  } catch (PDOException $e) {
    echo $e->getMessage();
    return false;
  }

  return false;
}
