<?php

require_once '../includes/session.php';
require_once '../data/getData.php';

function handleLogIn($data)
{
  startSession();

  $email = $data['email'];
  $password = $data['password'];


  $user = getUserByEmail($email);


  if ($user && password_verify($password, $user['password'])) {
    loginUser($user);
    header('Location: ../app/home.php');
    exit();
  } else {
    header('Location: ../app/logIn.php?error=invalid');
    exit();
  }
}
