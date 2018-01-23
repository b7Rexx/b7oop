<?php
require_once 'class/DBOperation.php';
require_once  'Includes/functions.php';
$session = new Session();
$session->welcome_session_check();
require_once 'includes/header.php';

$db_operation = new DBOperation();
$user = $db_operation->select_user_detail($db, 'users', $_SESSION['user']);

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
            <img src="img/profile/<?= $user['photo'] ?>" alt="profile image">
            <br><br>
            <h3><?= ucfirst(strtolower($user['name'])) ?></h3>

        </div>
        <div class="col-md-6">
            <form action="actions/edit_profile_action.php" method="post">
                Name: <br><input type="text" class="form-control" name="name" value="<?= $user['name'] ?>">
                Gender: <br><input type="radio" name="gender" <?php echo genderM($user['gender']) ?> value="male">Male&nbsp;&nbsp;&nbsp;
                <input type="radio" name="gender" <?php echo genderF($user['gender']) ?> value="female">Female<br>
                Contact: <br><input type="text" class="form-control" name="contact" value="<?= $user['contact'] ?>">
                Address: <br><input type="text" class="form-control" name="address" value="<?= $user['address'] ?>">
                Bio: <br><input type="text" class="form-control" name="bio" value="<?= $user['bio'] ?>">
                <input type="text" style="display: none" name="edit_id" value="<?= $user['id'] ?>">
                <button type="submit" class="btn btn-success mt-3 float-right">Save</button>
            </form>
        </div>
        <div class="col-md-3">
            <a class="float-right" href="edit_profile.php"><i class="fa fa-wrench" aria-hidden="true"></i> Edit
                profile</a>
            <a href="welcome.php" class="btn btn-secondary float-right ml-5"
               style="position:absolute;bottom:10px">Back</a>
        </div>
    </div>
</div>
<?php
require_once 'includes/footer.php';
?>
