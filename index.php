<?php
session_start();
if (!empty($_COOKIE['username'])) {
    $_SESSION["loggedIn"] = $_COOKIE['username'];
}

if (!empty($_SESSION["loggedIn"])) {
    header("Location:myprofile.php");
    exit();
}
?>
<?php include_once 'includes/DB.php'; ?>
<?php include_once 'lib/enter.php'; ?>
<?php
$maindb = new DB();
$conn = $maindb->getCon();
$enter = new enter();
if (!empty($_POST["usernamesignup"])) {
    $enter->username=$_POST["usernamesignup"];
    $enter->pass=$_POST["passwordsignup"];
    $enter->email=$_POST["emailsignup"];
    $enter->img=$_FILES["file"]["name"];
    $enter->sign_up();
    $enter->getImg($_FILES["file"]["tmp_name"]);
} else if (!empty($_POST["username"])) {
    $enter->username=$_POST["username"];
    $enter->pass=$_POST["password"];
    $enter->log_in();

}
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
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
                        <div id="login" class="animate form">
                            <form   autocomplete="on"   method="post"> 
                                <h1>Log in</h1> 
                                <p> 
                                    <label for="username" class="uname" data-icon="u" > Your username </label> 
                                    <input id="username" name="username" required="required" type="text" placeholder="myusername"/>
                                </p>
                                <p> 
                                    <label for="password" class="youpasswd" data-icon="p"> Your password </label>
                                    <input id="password" name="password" required="required" type="password" placeholder="eg. X8df!90EO" /> 
                                </p>
                                <p class="keeplogin"> 
                                    <input type="checkbox" name="loginkeeping" id="loginkeeping" value="loginkeeping" /> 
                                    <label for="loginkeeping">Keep me logged in</label>
                                </p>
                                <p class="login button"> 
                                    <input type="submit" value="Login" /> 
                                </p>
                                <p class="change_link">
                                    Not a member yet ?
                                    <a href="#toregister" class="to_register">Join us</a>
                                </p>
                            </form>
                        </div>

                        <div id="register"  class="animate form">
                            <form   autocomplete="on"  method="post" enctype="multipart/form-data"> 
                                <h1> Sign up </h1> 
                                <p> 
                                    <label for="usernamesignup" class="uname" data-icon="u">Your username</label>
                                    <input id="usernamesignup" name="usernamesignup" required="required" type="text" placeholder="mysuperusername690" />
                                </p>

                                <p> 
                                    <label for="passwordsignup" class="youpasswd" data-icon="p">Your password </label>
                                    <input id="passwordsignup" name="passwordsignup" required="required" type="password" placeholder="eg. X8df!90EO"/>
                                </p>
                                <p> 
                                    <label for="passwordsignup_confirm" class="youpasswd" data-icon="p">Please confirm your password </label>
                                    <input id="passwordsignup_confirm" name="passwordsignup_confirm" required="required" type="password" placeholder="eg. X8df!90EO"/>
                                </p>
                                <p> 
                                    <label for="emailsignup" class="youpasswd" data-icon="p">Your Email </label>
                                    <input id="emailsignup" name="emailsignup" required="required" type="email" placeholder="eg. user@gmail.com"/>
                                </p>

                                <p>
                                    <label for="file">Upload Your Images:</label>
                                    <input type="file" name="file" id="file" /> 
                                    Must Be jpg image
                                </p>


                                <p class="signin button"> 
                                    <input type="submit" value="Sign up"/> 
                                </p>
                                <p class="change_link">  
                                    Already a member ?
                                    <a href="#tologin" class="to_register"> Go and log in </a>
                                </p>
                            </form>
                        </div>

                    </div>
                </div>  
            </section>
        </div>
    </body>
</html>
