<?php
require_once 'class/DBOperation.php';
$session = new Session();
$session->login_session_check();

//echo "<pre>";
//print_r($_COOKIE);
//print_r($_SESSION);
//echo "</pre>";

require_once 'includes/header.php';
?>
<div class="container">
    <div class="row">
        <div class="col-md-4 mx-auto">
            <br>
            <i class="fa fa-grav fa-4x" aria-hidden="true"></i>
            <a href="register.php" class="float-right btn btn-primary m-4">Register</a>
            <br><br><br>

            <form action="actions/login_action.php" method="post">
                <i class="fa fa-user"></i> <label for="user">Username</label>
                <input class="form-control mb-2" type="text" id="user" name="user" required>
                <i class="fa fa-key"></i> <label for="pass">Password</label>
                <input class="form-control" type="password" id="pass" name="pass" required><br>
                <input type="checkbox" name="set_user" value="ok"> Stay Signed in <br>
                <?php $session->displayLoginMsg(); ?>
                <button type="submit" class="btn btn-success mt-3">Login</button>
            </form>
        </div>
    </div>
</div>
<?php
require_once 'includes/footer.php';
?>
