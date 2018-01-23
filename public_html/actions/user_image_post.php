<?php
require_once '../class/DBOperation.php';

if (!empty($_POST)) {
    $title = $_POST['title'];
    $image = $_FILES['image']['tmp_name'];
    $description = $_POST['description'];

    $photo = $_SESSION['user'] . "_" . md5(time()) . "." . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
    $id = $_POST['post_image_id'];

    if (move_uploaded_file($image, "../img/uploads  /" . $photo)) {
        $res = mysqli_query($db, "INSERT INTO images (image,title,description,user_id) VALUES ('$photo','$title','$description','$id')");
//        if ($res) {
//            echo "<br>";
//            echo "hello Test 1";
//        }
    }
}
header('location: http://b7oop.com/welcome.php');
