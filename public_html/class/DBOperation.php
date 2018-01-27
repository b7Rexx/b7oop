<?php
require_once 'Session.php';

Class DBOperation
{
    public $db, $user;

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

    //select user or image detail
    function select_user_detail($table, $user)
    {
        if ($table == 'users') {
            $result = mysqli_query($this->db, "SELECT * from $table WHERE email='$user' or id='$user'");
            return mysqli_fetch_assoc($result);
        } elseif ($table == 'images') {
            $result = mysqli_query($this->db, "SELECT * from $table WHERE id='$user'");
            return mysqli_fetch_assoc($result);
        }
    }

    /**
     * Select list of post images
     */
    function imageList($table, $id,$welcome='ok')
    {
        if($id == 'none'){
        $list = mysqli_query($this->db, "SELECT * from $table ORDER BY id DESC");
        $set= true;
        }else{
        $list = mysqli_query($this->db, "SELECT * from $table WHERE user_id='$id' ORDER BY id DESC");
        $set=false;
        }
        if ($list) {
            while ($row = mysqli_fetch_assoc($list)) {
                if($set)
                {
                    $return = mysqli_fetch_assoc(mysqli_query($this->db,"SELECT * FROM users WHERE id='{$row['user_id']}'"));
                    $prof = $return['photo'];
                    $email = $return['email'];
                    $name = ucfirst($return['name']);
                    echo "<div><a href='view_profile.php?email={$email}'><img src='img/profile/{$prof}' height='70' width='50' alt='(Image)'><b>&nbsp;&nbsp;{$name}</b></a> <i>posted on : {$row['created']}</i></div>";
                }
                    ?>
                <div class="post_image mt-1">
                <?php if($welcome == 'delete_button'){ ?>
                <a href="../actions/del_post_image.php?id=<?= $row['id'] ?>"
                   onclick="return confirm('Are you sure you want to delete this image?')">&times;</a>
                <?php }?>
                <h4 class="ml-4 pt-1" style="font-weight: bold"><?= $row['title'] ?></h4>
                <img src="img/uploads/<?= $row['image'] ?>" alt="post image">
                <p class="ml-3"><b>Description:</b> <?= $row['description'] ?></p>
                <?php
                $this->commentView($row['id']);
                echo "</div>";
            }
        }
    }

    //view list of comments on the image
    function commentView($id)
    {
        $result = mysqli_query($this->db, "SELECT * FROM comments WHERE image_id='$id'");
        echo "<div style='max-height: 140px;overflow-y: scroll'>";
        while ($row = mysqli_fetch_assoc($result)) {
            $return = $this->select_user_detail('users', $row['user_id']);
            echo "<div class='comment'>";
            $check_email = $this->session_info('user_email',$row['image_id']);
            $check_name = $this->session_info('user_name');
            if($_SESSION['user'] == $check_email){
            ?>
                <a href="../view_profile.php?email=<?= $return['email']?>"><b><?= ucfirst($return['name']) ?></b></a><a href="../actions/delete_comment.php?id=<?= $row['id'] ?>"
                                                         onclick="return confirm('Delete this comment?')">Delete</a>
            <?php
            }
            elseif ($row['user_id'] == $check_name) {
                ?>
                <a href="../view_profile.php?email=<?= $return['email']?>"><b><?= ucfirst($return['name']) ?></b></a><a href="../actions/delete_comment.php?id=<?= $row['id'] ?>"
                                                         onclick="return confirm('Delete this comment?')">Delete</a>
                <?php
            } else {
                ?>
                <a href="../view_profile.php?email=<?= $return['email']?>"><b><?= ucfirst($return['name']) ?></b></a>
                <?php
            }
            echo "<p>{$row['user_comment']}</p>";
            echo "<i>{$row['created']}</i>";
            echo "</div>";
            }
            echo "</div>";
            $this->commentAdd($id);
    }


    //get session info
    function session_info($value,$id='ok')
    {
        if($value == 'user_name'){
        return ($this->select_user_detail('users', $_SESSION['user']))['id'];
        }else{
        $result = (mysqli_fetch_assoc(mysqli_query($this->db,"SELECT * from images where id='$id'")))['user_id'];
        return (mysqli_fetch_assoc(mysqli_query($this->db,"SELECT * from users WHERE id='$result'")))['email'];
        }
    }

    //form to add comments -- each image have add comment section below image
    function commentAdd($id)
    {
        ?>
        <div>
            <form action="../actions/add_comment.php" method="post">
                <input type="text" name="comment" class="form-control mb-1" autocomplete="off" required>
                <input type="text" name="image_id" value="<?= $id ?>" style="display: none;">
                <button type="submit" class="btn btn-outline-success mb-3">Add comment</button>
            </form>
        </div>
        <?php
    }

    //insert into comment db
    function insert_into_comment($comment, $user_id, $image_id)
    {
        mysqli_query($this->db, "INSERT INTO comments (user_comment,user_id,image_id) VALUES ('$comment','$user_id','$image_id')");
    }


    //delete comment
    function delete_comment($id)
    {

        mysqli_query($this->db, "DELETE FROM comments where id='$id'");
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

    //set image of user or posts
    function set_photo($photo, $id, $title = 'ok', $description = 'No_description')
    {
        if ($title == 'ok') {
            return mysqli_query($this->db, "UPDATE users SET photo='$photo' WHERE id='$id'");
        } else {
            return mysqli_query($this->db, "INSERT INTO images (image,title,description,user_id) VALUES ('$photo','$title','$description','$id')");
        }
    }

    //delete posted images
    function del_post_image($id)
    {
        mysqli_query($this->db, "DELETE from images where id='$id'");
    }
}