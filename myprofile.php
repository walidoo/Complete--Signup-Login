<?php
require_once 'includes/DB.php';
session_start();

if (empty($_SESSION["loggedIn"])) {
    header("Location:index.php");
    exit();
}
    $maindb = new DB();
    $conn = $maindb->getCon();
?>
<!DOCTYPE html>
<html lang="en" class="no-js"> 
    <head>
        <meta charset="UTF-8" />
        <title>Login and Registration Form</title>
        <link rel="shortcut icon" href="../favicon.ico"> 
        <link rel="stylesheet" type="text/css" href="css/demo.css" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <link rel="stylesheet" type="text/css" href="css/animate-custom.css" />
    </head>
    <body>
        <div class="container">
            <section>				
                <div id="container_demo" > 
                    <a class="hiddenanchor" id="toregister"></a>
                    <a class="hiddenanchor" id="tologin"></a>
                    <div id="wrapper">
                        <div id="login" class=" form">
                            <h1>Welcome 
                                <?php echo $_SESSION["loggedIn"];
                                ?>

                            </h1>
                            <p>
                                <img height="100px" width="100px" src="<?php echo "pix/" . $_SESSION["loggedinimg"]; ?>" >

                                <br>
                                <a href="logout.php">
                                    Logout
                                </a>
                            </p>
                        <div class="message_content">
                            <h1>Your Message :</h1>
                            <?php 
                            $message = "select msg , msg_time  from message where reciever_id=".$_SESSION["user_id"];
                            $message_sql = $conn->query($message);
                            while($row = $message_sql->fetch_assoc()) {
                                if(!empty($row)) {
                                echo '<div style="width:390px;height:30px;border-radius:2px;border:1px solid #406F76;margin-bottom:3px;">'.
                                     '<p>'.$row["msg"].'</p></div>';
                                }
                                else {
                                echo '<div style="width:390px;height:30px;border-radius:2px;border:1px solid #406F76;margin-bottom:3px;">'.
                                     '<p>There are no messages yet.</p></div>'; 
                                }
                            }                           
                            ?>
                        </div>
                        </div>
                    </div>
            <div class="msg_content">
                <form action="" method="post">
                <select name="all_users">
                    <?php 
                    $sql_users = "select id,username from signup";
                    $query_users = $conn->query($sql_users);
                    while($row = $query_users->fetch_assoc()) {
                       echo '<option value="'.$row["username"].'">'.$row["username"].'</option>';
                    }
                    
                    ?>
                </select><br>
                <textarea  name="msg_text" class="msg_text" placeholder="Your Message"></textarea><br>
                <input type="submit" name="send_msg" class="send_msg" value="Send Message" />
            </form>
            </div>
                </div>
          </section>
            <?php 
            if(isset($_POST["send_msg"])) {
            $msg_content = $_POST["msg_text"];
            $msg_time = date($timestamp = time());
            $sql_users = "select id,username from signup";
            $query_users = $conn->query($sql_users);
            while($row = $query_users->fetch_assoc()) {
                if($row["username"] == $_POST["all_users"]) {
                    $sender_id = $_SESSION["user_id"];
                    $reciver_id = $row["id"];
                 $insert_msg = "insert into message (sender_id , reciever_id , msg , msg_time) values ($sender_id , $reciver_id , '$msg_content' ,'$msg_time')";
                 $sql_stmt = $conn->query($insert_msg);
                }
            }
            $conn->close();
            echo 'Your message is sent';
            }
                       
            ?>
        </div>
    </body>
</html>