<?php require_once 'includes/DB.php'; ?>
<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of enter
 *
 * @author walid
 */
class enter {

    public $username;
    public $email;
    public $pass;
    public $img;

    public function sign_up() {

        global $conn;
        $sql = "insert into signup (username , email , password , img) values ('$this->username' , '$this->email' , '$this->pass' , '$this->img' )";
        $sql_stmt = $conn->query($sql);
        $_SESSION["loggedIn"] = $this->username;
        $_SESSION["loggedinimg"] = $this->img;
        setcookie('username', $this->username, time() + 60 * 60 * 24 * 365);
        header("Location:myprofile.php");
        $conn->close();
    }

    public function log_in() {
        global $conn;
//        $sql = "select username , password , img from signup where username like '" . $this->username . "' and password like " . $this->pass;
        $sql = "select * from signup ";
        $sql_stmt = $conn->query($sql);
        
        while($row = $sql_stmt->fetch_assoc()){
        if ($this->username == $row["username"] && $this->pass == $row["password"]) {
            if (isset($_POST['loginkeeping'])) {
                /* Set cookie to last 1 year */
                setcookie('username', $this->username, time() + 60 * 60 * 24 * 365);
            }

            $_SESSION["loggedIn"] = $this->username;
            $_SESSION["loggedinimg"] = $row["img"];
            $_SESSION["user_id"] = $row["id"];
            header("Location:myprofile.php");
            exit();
//            echo 'good';
        } 
        }
            echo 'Invalid Account';
    }

    public function getImg($img_tmp_name) {
        move_uploaded_file(
                $img_tmp_name, "pix/" . $this->img);
    }

}
