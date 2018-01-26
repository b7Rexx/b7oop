<?php
require_once 'class/DBOperation.php';
require_once 'includes/header.php';

$session = new Session();
$session->add_info();

$db_operation = new DBOperation();
$last_row = $db_operation->select_last_row();

?>
<div class="container">
    <div class="row">
        <div class="col-md-4 mx-auto">
            <br>
            <i class="fa fa-grav fa-4x" aria-hidden="true"></i><b>Add User Info.</b>
            <a href="welcome.php" class="float-right btn btn-primary m-4">View Profile</a>
            <br><br>
            <i class="fa fa-user fa-3x"></i> <?= $last_row['name'] ?>
            <br><br>
            <form action="actions/register_action.php" method="post">
                <i class="fa fa-male" aria-hidden="true"></i> <i class="fa fa-female" aria-hidden="true"></i> Gender:
                <br>
                <input type="radio" name="gender" value="male">Male&nbsp;&nbsp;&nbsp;
                <input type="radio" name="gender" value="female">Female <br>
                <i class="fa fa-map-marker mt-2"></i> <label for="r_address">Address:</label>
                <input class="form-control mb-2" type="text" id="r_address" name="address" placeholder="Address">
                <i class="fa fa-mobile"></i> <label for="r_contact">Contact no:</label>
                <input class="form-control" type="text" id="r_contact" name="contact">
                <i class="fa fa-book"></i> <label for="r_bio">Bio:</label>
                <textarea class="form-control" type="text" id="r_bio" name="bio"></textarea>
                <input type="text" name="reg_info" value="<?= $last_row['id'] ?>" style="display: none">
                <button type="submit" class="btn btn-success mt-3">Add info</button>
                <a href="login.php" class="btn btn-outline-primary float-right mt-3">Skip</a>
            </form>
        </div>
    </div>
</div>
<?php
require_once 'includes/footer.php';
?>
