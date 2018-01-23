<?php

require_once '../class/DBOperation.php';

if (!empty($_POST)) {

    $image = $_FILES['upload_image']['tmp_name'];
    $photo = $_SESSION['user'] . "." . pathinfo($_FILES['upload_image']['name'], PATHINFO_EXTENSION);
    $id = $_POST['upload_image_id'];
    print_r($_FILES);
    if (move_uploaded_file($image, "../img/profile/" . $photo)) {
        echo "Hello Test";
        mysqli_query($db, "UPDATE users SET photo='$photo' WHERE id='$id'");
    }
}
header('location: http://b7oop.com/welcome.php');