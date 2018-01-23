<?php
require_once 'Session.php';

$db = mysqli_connect('localhost', 'root', '', 'b7oop');

if (!$db) {
    die(mysqli_connect_error());
}


Class DBOperation
{


    //gives whole table for login check
    function select_db($db, $table)
    {
        return mysqli_query($db, "SELECT * from $table");
    }

    //gives last row during register
    function select_last_row($db)
    {
        $reg_info = mysqli_query($db, "SELECT * FROM users ORDER BY id DESC LIMIT 1");
        return mysqli_fetch_assoc($reg_info);
    }

    //select user detail
    function select_user_detail($db, $table, $user)
    {
        $result = mysqli_query($db, "SELECT * from $table WHERE email='$user'");
        return mysqli_fetch_assoc($result);
    }

    /**
     * Select list of post images
     */
    function imageList($db, $table, $id)
    {
        $list = mysqli_query($db, "SELECT * from $table WHERE user_id='$id' ORDER BY id DESC");
        if ($list) {
            while ($row = mysqli_fetch_assoc($list)) {
                ?>
                <div style="border:1px solid wheat">
                    <h3><?= $row['title'] ?></h3><br>
                    <img src="img/uploads/<?= $row['image'] ?>" alt="post image" style="height:auto;width: 400px">
                    <p><?= $row['description'] ?></p>
                </div>
                <?php
            }
        }
    }

    function fetch_list_users($db, $table,$id)
    {
        $result = mysqli_query($db, "SELECT * from $table WHERE id !=$id ORDER BY name");
        while ($row = mysqli_fetch_assoc($result)){
            ?>
            <hr style="margin: 5px">
            <a href="http://b7oop.com/view_profile.php?email=<?=$row['email']?>"><i class="fa fa-user"></i> <?=ucfirst($row['name'])?></a>
            <?php
        }
    }
}