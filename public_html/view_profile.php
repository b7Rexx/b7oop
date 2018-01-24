<?php
require_once 'class/DBOperation.php';
$session = new Session();
$session->welcome_session_check();
require_once 'includes/header.php';

$db_operation = new DBOperation();
$user = $db_operation->select_user_detail($db, 'users', $_SESSION['user']);
if(isset($_GET['email'])) {
    $user_profile = $db_operation->select_user_detail($db, 'users', $_GET['email']);
}else{
    header('location: welcome.php');
    die;
}
?>

<div class="container">
    <br>
    <div class="row">
        <div class="col-md-3">
            <i class="fa fa-grav fa-5x float-left mb-4" aria-hidden="true"></i>
        </div>
        <div class="col-md-6">
        </div>
        <div class="col-md-3">
            <a href="actions/logout.php" class="btn btn-danger float-right">Logout</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 upload_image">
            <img src="img/profile/<?= $user_profile['photo'] ?>" alt="profile image" style="width: 250px;height:300px;">
            <br><br>
            <h2><?= ucfirst(strtolower($user_profile['name'])) ?></h2>
            <p>Email: <?= $user_profile['email'] ?><br>Gender: <?= $user_profile['gender'] ?><br>
                Contact: <?= $user_profile['contact'] ?><br>Address: <?= ucfirst(strtolower($user_profile['address'])) ?></p>
            <p><?= $user_profile['bio'] ?></p>
        </div>
        <div class="col-md-6">
            <form class="form-control user_image_post" method="post" enctype="multipart/form-data"
                  action="actions/user_image_post.php">
                Title: <input type="text" name="title">
                <input type="file" name="image">
                <textarea type="text" name="description" class="form-control mt-2"></textarea>
                <input type="text" name="post_image_id" style="display:none;" value="<?= $user_profile['id'] ?>">
                <button type="submit" class="btn btn-primary float-right m-3">POST</button>
            </form>
            <br><br>
            <div>
                <?php
                $db_operation->imageList($db, 'images', $user_profile['id']);
                //              ?>
            </div>
        </div>
        <div class="col-md-3">
            <a class=" btn btn-primary float-right mt-5" href="welcome.php">Go To &nbsp;&nbsp;&nbsp;<i class="fa fa-user"></i> <?=ucfirst($user['name'])?></a>

            <div class="list">
                <i class="fa fa-users" aria-hidden="true"></i> Users
                <br>
                <?php $list = $db_operation->fetch_list_users($db, 'users',$user['id']); ?>
            </div>
        </div>
    </div>
</div>
<?php
require_once 'includes/footer.php';
?>
