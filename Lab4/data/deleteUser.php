<?php



function deleteUser($id)
{

  try {

    $conn = connect_to_db_pdo();

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
