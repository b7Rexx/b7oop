<?php
require_once 'class/DBOperation.php';
$session = new Session();
$session->welcome_session_check();
require_once 'includes/header.php';

$db_operation = new DBOperation();
$user = $db_operation->select_user_detail('users', $_SESSION['user']);
?>

<div class="container">
    <br>
    <div class="row">
        <div class="col-md-3">
            <a href="welcome.php">
                <i class="fa fa-grav fa-5x float-left mb-4" aria-hidden="true"></i>
                &nbsp;<h2><?= ucfirst(strtolower($user['name'])) ?></h2></a>
        </div>
        <div class="col-md-6">
        </div>
        <div class="col-md-3">
            <a href="actions/logout.php" class="btn btn-danger float-right">Logout</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            Index
        </div>
        <div class="col-md-6">
            <div>
                <?php
                $db_operation->imageList('images', 'none');
                ?>
            </div>
        </div>
        <div class="col-md-3">
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
