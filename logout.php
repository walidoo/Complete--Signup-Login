<?php
session_start();
session_destroy();
setcookie("username","");
header("Location:index.php");
exit();