<?php
session_start();

require "Util.php";
$util = new Util();

//Clear Session
$_SESSION["member_id"] = "";
$_SESSION["adminName"] = "";
session_unset();
session_destroy();

// clear cookies
$util->clearAuthCookie2();


header("Location: loginSample.php");
?>