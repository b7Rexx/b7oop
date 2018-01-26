<?php
require_once '../class/DBOperation.php';
$db_operation = new DBOperation();
if (!empty($_POST)) {
    $title = $_POST['title'];
    $image = $_FILES['image']['tmp_name'];
    $description = $_POST['description'];

    $photo = $_SESSION['user'] . "_" . md5(time()) . "." . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
    $id = $_POST['post_image_id'];

    if (move_uploaded_file($image, "../img/uploads  /" . $photo)) {
        $db_operation->set_photo($photo,$id,$title,$description);
//        if ($res) {
//            echo "<br>";
//            echo "hello Test 1";
//        }
    }
}
header('location: http://b7oop.com/welcome.php');
die;