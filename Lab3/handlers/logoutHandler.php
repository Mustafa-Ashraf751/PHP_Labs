<?php

require_once('../includes/session.php');

function handleLogOut()
{
  startSession();

  logoutUser();

  header('location: ../app/logIn.php');
  exit();
}
