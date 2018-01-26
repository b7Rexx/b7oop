<?php
require_once 'class/DBOperation.php';
$session = new Session();
$session->login_session_check();

require_once 'includes/header.php';
?>
<div class="container">
    <div class="row">
        <div class="col-md-4 mx-auto">
            <br>
            <i class="fa fa-grav fa-4x" aria-hidden="true"></i><b>Register User</b>
            <a href="login.php" class="float-right btn btn-primary m-4">Login</a>
            <br><br><br>

            <form action="actions/register_action.php" method="post">
                <i class="fa fa-user"></i> <label for="r_user">Username:</label>
                <input class="form-control mb-2" type="text" id="r_user" name="user" placeholder="Username" required>
                <i class="fa fa-envelope"></i> <label for="r_email">Email:</label>
                <input class="form-control mb-2" type="text" id="r_email" name="email" placeholder="Email" required>
                <i class="fa fa-key"></i> <label for="r_pass">Password:</label>
                <input class="form-control" type="password" id="r_pass" name="pass" required>
                <i class="fa fa-key"></i> <label for="r_cpass">Confirm Password:</label>
                <input class="form-control" type="password" id="r_cpass" name="cpass">
                <?php
                $session->displayRegisterMsg();
                ?>
                <button type="submit" class="btn btn-success mt-3">Register</button>
            </form>
        </div>
    </div>
</div>
<?php
require_once 'includes/footer.php';
?>
