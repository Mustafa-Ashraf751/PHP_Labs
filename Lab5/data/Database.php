<?php

class Database
{
  private const DB_HOST = 'localhost';
  private const DB_USER = 'root';
  private const DB_PASSWORD = 'root123';
  private const DB_NAME = 'users';
  private const DB_PORT = 3306;

  private $pdo;

  public function __construct()
  {

    $this->pdo = false;

    try {
      $dns = "mysql:host=" . self::DB_HOST . ";dbname=" . self::DB_NAME . ";port=" . self::DB_PORT;

      $this->pdo = new PDO($dns, self::DB_USER, self::DB_PASSWORD);
    } catch (PDOException $e) {

      echo $e->getMessage();
    }
  }

  public function getConnection()
  {
    return $this->pdo;
  }


  public function connect($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME, $DB_PORT)
  {
    $pdo = false;
    try {
      $dns = "mysql:host=" . $DB_HOST . ";dbname=" . $DB_NAME . ";port=" . $DB_PORT;

      $pdo = new PDO($dns, $DB_USER, $DB_PASSWORD);
    } catch (PDOException $e) {

      echo $e->getMessage();
    }
    return $pdo;
  }

  public function insert($data, $pdo)
  {
    try {

      $conn = $pdo;

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

  public function getById($id, $pdo)
  {
    $data = null;

    try {
      $conn = $pdo;

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

  public function getByEmail($email, $pdo)
  {
    $data = null;

    try {
      $conn = $pdo;

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

  public function getAll($pdo)
  {
    $data = null;
    try {
      $conn = $pdo;

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

  public function updateUser($userData, $pdo)
  {
    try {

      $conn = $pdo;

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

  public function deleteUser($id, $pdo)
  {
    try {

      $conn = $pdo;

      $query = "select profile_picture from users where id = ?";
      $stmt = $conn->prepare($query);
      $stmt->execute([$id]);
      $user = $stmt->fetch(PDO::FETCH_ASSOC);


      $deleteQuery = "delete from users where id = ?";

      $stmt = $conn->prepare($deleteQuery);

      $result = $stmt->execute([$id]);


      //Delete the user picture

      if ($result && $user && !empty($user['profile_picture'])) {
        $filePath = '../uploads/' . $user['profile_picture'];

        if (file_exists($filePath)) {
          unlink($filePath);
        }
      }

      $conn = null;

      return $result;
    } catch (PDOException $e) {
      echo $e->getMessage();
      return false;
    }

    return false;
  }
}
