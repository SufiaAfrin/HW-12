<?php

include "../database/env.php";
session_start();


$fname = $_REQUEST['fname'];
$lname = $_REQUEST['lname'];
$email = $_REQUEST['email'];
$id = $_SESSION['auth']['id'];
$profileImg = $_FILES['profile_img'];
$errors = [];
$accepted_types = ['jpg','png'];
$ext = pathinfo($profileImg['name'])['extension'];

// print_r($ext);
// exit();

//validation

if($profileImg['size'] == 0) {
    $errors['profile_img_error'] = "Image is empty!";
} else if(!in_array($ext, $accepted_types)){
    $errors['profile_img_error'] = "Supported types are jpg and png";
}else if($profileImg['size'] > 500000){
    $errors['profile_img_error'] = "Image size must be 500kb!"; 
}
// var_dump($errors);
// exit();
//Redirect

if (count($errors) == 0){
    //move uploaded file

    $fileName = "user-" . uniqid() . ".$ext";
    if(!is_dir("../uploads/users")){
        mkdir("../uploads/users");
    }
    $uploadedFiles = move_uploaded_file($profileImg['tmp_name'], "../uploads/users/$fileName");
    // print_r($uploadedFiles);
    // exit();
    if($uploadedFiles){
        $query = "UPDATE users SET  fname ='$fname' , lname = '$lname' , email = '$email' , profile_img = '$fileName' WHERE id = '$id'";
        $res = mysqli_query($conn, $query);

        //session update
        $_SESSION['auth']['fname'] = $fname;
        $_SESSION['auth']['lname'] = $lname;
        $_SESSION['auth']['email'] = $email;
        $_SESSION['auth']['profile'] = $fileName;

        header("Location: ../backend/profile.php");
    }
    
}else{
    header("Location: ../backend/profile.php");
}







