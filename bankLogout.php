<?php
session_start();    
require(__DIR__ . "/func.php");
require(__DIR__ . "/resetSession.php");

// Reset session
reset_session();

// Set the message
$_SESSION['message'] = "<br><span style='margin-left: 10px;'>&nbsp;<strong>Successfully logged out</strong></span>";

// Redirect to login page with the message
header("Location: bankLogin.php");
exit();
?>
