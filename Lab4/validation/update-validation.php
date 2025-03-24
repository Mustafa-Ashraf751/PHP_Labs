<?php
function formValidation($data)
{
  $errors = [];


  //validate the Name field
  if (empty($data['fullName'])) {
    $errors['fullName'] = 'Name is required please enter data';
  } elseif (strlen($data['fullName']) < 2) {
    $errors['fullName'] = 'Name must be at least 3 character';
  } elseif (!preg_match("/[a-zA-Z]{3,30}$/", $data['fullName'])) {
    $errors['fullName'] = 'Invalid input please enter valid name and try again!';
  }

  //validate the email field
  if (empty($data['email'])) {
    $errors['email'] = 'Email is required please enter valid email address';
  } elseif (!preg_match("/^[a-zA-Z0-9]+([._%+-][a-zA-Z0-9]+)*@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/
", $data['email'])) {
    $errors['email'] = 'Invalid email address please enter valid email!';
  }



  //Validate the room no field
  if (empty($data['roomNo'])) {
    $errors['roomNo'] = 'Please choose room number to continue!';
  }

  //Validate the extension field
  if (empty($data['extension'])) {
    $errors['extension'] = 'Please provide extension number to continue!';
  }

  //Validate the profile picture and make sure that it's a photo
  if (!empty($_FILES['profilePicture']['name'])) {
    $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
    $maxSize = 2 * 1024 * 1024;

    if (!in_array($_FILES['profilePicture']['type'], $allowedTypes)) {
      $errors['profilePicture'] = 'Only JPG and PNG files are allowed';
    }

    if ($_FILES['profilePicture']['size'] > $maxSize) {
      $errors['profilePicture'] = 'File size must be less than 2MB';
    }

    //Check images that it's real and not fake or script
    if (!getimagesize($_FILES['profilePicture']['tmp_name'])) {
      $errors['profilePicture'] = 'Uploaded file is not a valid image';
    }
  }

  return $errors;
}
