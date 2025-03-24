<?php

function startSession()
{
  if (session_status() === PHP_SESSION_NONE) {
    //To make the session more secure vs hacking
    ini_set('session.use_only_cookies', 1);
    ini_set('session.use_strict_mode', 1);

    session_start();
  }
}

function isLoggedIn()
{
  return isset($_SESSION['user']);
}


function getCurrentUser()
{
  return $_SESSION['user'] ?? null;
}

//To force user to go to logIn 
function requireLogin()
{
  if (!isLoggedIn()) {
    header('location: ../app/logIn.php');
    exit();
  }
}


function loginUser($user)
{
  $_SESSION['user'] = $user;
}

function logoutUser()
{
  $_SESSION = [];

  //This step to get the cookie in used and destroy it and remove it from the browser
  if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 4200, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
  }

  session_destroy();
}
