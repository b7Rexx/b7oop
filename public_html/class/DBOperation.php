<?php
require_once 'Session.php';

Class DBOperation
{
    public $db;

    function __construct()
    {
        $this->db = mysqli_connect('localhost', 'root', '', 'b7oop');

        if (!$this->db) {
            die(mysqli_connect_error());
        }
    }

    //gives whole table for login check
    function select_db($table)
    {
        return mysqli_query($this->db, "SELECT * from $table");
    }

    //gives last row during register
    function select_last_row()
    {
        $reg_info = mysqli_query($this->db, "SELECT * FROM users ORDER BY id DESC LIMIT 1");
        return mysqli_fetch_assoc($reg_info);
    }

    //select user detail
    function select_user_detail($table, $user)
    {
        $result = mysqli_query($this->db, "SELECT * from $table WHERE email='$user'");
        return mysqli_fetch_assoc($result);
    }

    /**
     * Select list of post images
     */
    function imageList($table, $id)
    {
        $list = mysqli_query($this->db, "SELECT * from $table WHERE user_id='$id' ORDER BY id DESC");
        if ($list) {
            while ($row = mysqli_fetch_assoc($list)) {
                ?>
                <div style="border:1px solid wheat;border-bottom:2px dashed wheat; ">
                    <h3 class="ml-4 pt-1"><?= $row['title'] ?></h3><br>
                    <img src="img/uploads/<?= $row['image'] ?>" alt="post image" class="post_img">
                    <p class="ml-3"><?= $row['description'] ?></p>
                </div>
                <?php
            }
        }
    }


//fetchs list of users in online bar
    function fetch_list_users($table, $id)
    {
        $result = mysqli_query($this->db, "SELECT * from $table WHERE id !=$id ORDER BY name");
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <hr style="margin: 5px">
            <a href="http://b7oop.com/view_profile.php?email=<?= $row['email'] ?>"><i
                        class="fa fa-user"></i> <?= ucfirst($row['name']) ?></a>
            <?php
        }
    }


    //deletes the user whole data
    function delete_user_with_id($table, $id)
    {
        $user_photo = mysqli_fetch_assoc(mysqli_query($this->db, "SELECT * from $table WHERE id=$id"));

        if ($user_photo['photo'] != 'default_photo.png') {
            unlink("../img/profile/" . $user_photo['photo']);
        }
        $result = mysqli_query($this->db, "SELECT * FROM images WHERE user_id=$id");
        while ($row = mysqli_fetch_assoc($result)) {
            $image_post = "../img/uploads/" . $row['image'];
            unlink($image_post);
        }
        mysqli_query($this->db, "DELETE FROM $table WHERE id=$id");
        $sess = new Session();
        $sess->logout();
    }


    //edits info in database
    function edit_info($gender, $address, $contact, $bio, $id, $name = 'ok')
    {
        if ($name == 'ok') {
            return mysqli_query($this->db, "UPDATE users SET gender='$gender',address='$address',contact='$contact',bio='$bio' WHERE id='$id';");
        } else {
            return mysqli_query($this->db, "UPDATE users SET name='$name',gender='$gender',address='$address',contact='$contact',bio='$bio' WHERE id='$id';");
        }
    }


    //insert database
    function insert_db($user, $email, $hash_pass)
    {
        return mysqli_query($this->db, "INSERT INTO users(name,email,pass) VALUES ('$user','$email','$hash_pass')");
    }

    function set_photo($photo, $id, $title = 'ok', $description = 'No_description')
    {
        if ($title == 'ok') {
            return mysqli_query($this->db, "UPDATE users SET photo='$photo' WHERE id='$id'");
        } else {
            return mysqli_query($this->db, "INSERT INTO images (image,title,description,user_id) VALUES ('$photo','$title','$description','$id')");
        }
    }

}