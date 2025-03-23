<?php

require_once('../includes/session.php');

function handleLogIn($data)
{
  startSession();

  $email = $data['email'];
  $password = $data['password'];


  $userFile = dirname(__DIR__) . '\\data\\users.txt';
  $users = [];

  if (file_exists($userFile)) {
    $users = json_decode(file_get_contents($userFile), true) ?? [];
  }

  //Check if the user exist in the file or not
  $user = null;
  foreach ($users as $storedUser) {
    if ($storedUser['email'] === $email) {
      $user = $storedUser;
      break;
    }
  }

  if ($user && password_verify($password, $user['password'])) {
    loginUser($user);
    header('Location: ../app/home.php');
    exit();
  } else {
    header('Location: ../app/logIn.php?error=invalid');
    exit();
  }
}
