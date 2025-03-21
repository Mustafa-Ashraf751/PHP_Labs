<?php

function validateForm($data)
{
  //Array of errors
  $errors = [];

  //validate the firstName field
  if (empty($data['firstName'])) {
    $errors['firstName'] = 'First name is required please enter data';
  } elseif (strlen($data['firstName']) < 2) {
    $errors['firstName'] = 'First name must be at least 3 character';
  } elseif (!preg_match("/[a-zA-Z]{3,30}$/", $data['firstName'])) {
    $errors['firstName'] = 'Invalid input please enter valid name and try again!';
  }

  //validate the lastName field
  if (empty($data['lastName'])) {
    $errors['lastName'] = 'last name is required please enter data';
  } elseif (strlen($data['lastName']) < 2) {
    $errors['lastName'] = 'last name must be at least 3 character';
  } elseif (!preg_match("/[a-zA-Z]{3,30}$/", $data['lastName'])) {
    $errors['lastName'] = 'Invalid input please enter valid name and try again!';
  }

  //validate the address field
  if (empty($data['address'])) {
    $errors['address'] = 'Address is required please enter data';
  } elseif (strlen($data['firstName']) < 5 || strlen($data['address']) > 255) {
    $errors['firstName'] = 'Address length should be between 5 and 255 character';
  }

  //validate the country field
  if (empty($data['country'])) {
    $errors['country'] = 'County is required please enter data';
  }

  //validate the gender field
  if (empty($data['gender'])) {
    $errors['gender'] = 'Gender is required please enter data';
  }


  //validate the gender field
  if (empty($data['department'])) {
    $errors['department'] = 'Department is required please enter data';
  }


  //validate the username field
  if (empty($data['username'])) {
    $errors['username'] = 'User name is required please enter data';
  } elseif (strlen($data['username']) < 2 || strlen($data['username']) > 20) {
    $errors['username'] = 'User name must be between 3 and 20 characters';
  } elseif (!preg_match('/^[A-Za-z][A-Za-z0-9]{5,31}$/', $data['username'])) {
    $errors['username'] = 'Invalid input please enter valid username and try again!';
  }

  //validate the password field
  if (empty($data['password'])) {
    $errors['password'] = 'Password is required please enter data';
  } elseif (strlen($data['password']) < 6 || strlen($data['password']) > 20) {
    $errors['password'] = 'User name must be between 3 and 20 characters';
  } elseif (!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $data['password'])) {
    $errors['password'] = 'Invalid password please enter valid password and try again!';
  }


  //validate captcha
  if (empty($data['captchaInput'])) {
    $errors['captchaInput'] = 'Captcha code  is required please enter data';
  } elseif ($data['captchaInput'] !== $_SESSION['captcha']) {
    $errors['captchaInput'] = "The code does't match please try again!";
  }

  return $errors;
}
