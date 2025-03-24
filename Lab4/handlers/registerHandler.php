<?php
require_once '../validation/form-validation.php';
require_once '../includes/session.php';
require_once '../data/insert_db.php';

//This function to save the data of user to the file and redirect user to landing page
function handleRegister($data)
{
    $errors = formValidation($data);

    //Handle the saving of image
    if (empty($errors)) {
        $uploadDir = dirname(__DIR__) . '\\uploads\\';

        $fileExtension = pathinfo($_FILES['profilePicture']['name'], PATHINFO_EXTENSION);
        $fileName = uniqid() . '.' . $fileExtension;
        $uploadPath = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES['profilePicture']['tmp_name'], $uploadPath)) {
            $userData = [
                'fullName' => $data['fullName'],
                'email' => $data['email'],
                'password' => password_hash($data['password'], PASSWORD_DEFAULT),
                'roomNo' => $data['roomNo'],
                'extension' => $data['extension'],
                'profilePicture' => $fileName
            ];



            insert_into_table($userData);

            startSession();
            loginUser($userData);

            header('location:../app/home.php');
            exit();
        }
    }

    return $errors;
}
