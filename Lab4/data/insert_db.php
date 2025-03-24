<?php

require __DIR__ . '/connect_pdo.php';

function insert_into_table($data)
{


  try {

    $conn = connect_to_db_pdo();

    if ($conn) {
      $query = "insert into `users` (full_name,email,password,room_no,extension,profile_picture) values(?,?,?,?,?,?);";

      $stmt = $conn->prepare($query);

      $full_name = $data['fullName'];
      $email = $data['email'];
      $password = $data['password'];
      $room_no = $data['roomNo'];
      $extension = $data['extension'];
      $profile_picture = $data['profilePicture'];

      $res = $stmt->execute([$full_name, $email, $password, $room_no, $extension, $profile_picture]);

      if ($res) {
        $ids = $conn->lastInsertId();
        echo $ids;
      }

      $conn = null;
    }
  } catch (PDOException $e) {

    echo $e->getMessage();
  }
}
