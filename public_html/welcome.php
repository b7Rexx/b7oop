<?php
require_once 'class/DBOperation.php';
$session = new Session();
$session->welcome_session_check();
require_once 'includes/header.php';

$db_operation = new DBOperation();
$user = $db_operation->select_user_detail('users', $_SESSION['user']);

//echo "<pre>";
//print_r($_COOKIE);
//print_r($_SESSION);
//echo "</pre>";
?>

<div class="container">
    <br>
    <div class="row">
        <div class="col-md-3">
            <a href="Index.php">
                <i class="fa fa-grav fa-5x float-left mb-4" aria-hidden="true"></i>
                &nbsp;<h2>Home</h2></a>
        </div>
        <div class="col-md-6">
        </div>
        <div class="col-md-3">
            <a href="actions/logout.php" class="btn btn-danger float-right">Logout</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 upload_image">
            <img src="img/profile/<?= $user['photo'] ?>" alt="profile image" style="width: 250px;height:300px;">
            <form action="actions/upload_image.php" method="post" enctype="multipart/form-data">
                <input type="file" name="upload_image" required>
                <input type="text" name="upload_image_id" style="display:none;" value="<?= $user['id'] ?>">
                <button type="submit"><i class="fa fa-camera" aria-hidden="true"></i> upload</button>
            </form>
            <br><br>
            <h2><?= ucfirst(strtolower($user['name'])) ?></h2>
            <p>Email: <?= $user['email'] ?><br>Gender: <?= $user['gender'] ?><br>
                Contact: <?= $user['contact'] ?><br>Address: <?= ucfirst(strtolower($user['address'])) ?></p>
            <p><?= $user['bio'] ?></p>
        </div>
        <div class="col-md-6">
            <form class="form-control user_image_post" method="post" enctype="multipart/form-data"
                  action="actions/user_image_post.php">
                <i>Title: </i><input type="text" name="title" required>
                <input type="file" name="image" required>
                <textarea type="text" name="description" class="form-control mt-2"></textarea>
                <input type="text" name="post_image_id" style="display:none;" value="<?= $user['id'] ?>">
                <button type="submit" class="btn btn-primary float-right mt-3">POST</button>
            </form>
            <br><br>
            <div>
                <br>
                <?php
                $db_operation->imageList('images', $user['id'],'delete_button');
                ?>
            </div>
        </div>
        <div class="col-md-3">
            <a class="float-right" href="edit_profile.php"><i class="fa fa-wrench" aria-hidden="true"></i> Edit profile</a>

            <div class="list">
                <i class="fa fa-users" aria-hidden="true"></i> Users
                <br>
                <?php $list = $db_operation->fetch_list_users('users', $user['id']); ?>
            </div>
        </div>
    </div>
</div>
<?php
require_once 'includes/footer.php';
?>
