<?php
function is_logged_in($redirect = false, $destination = "bankLogin.php")
{
    $isLoggedIn = isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true;
    if ($redirect && !$isLoggedIn) {
        // If not logged in and redirect flag is true, redirect to the destination
        error_log("You must be logged in to view this page", 1);
        header("Location: $destination");
        exit(); // Terminate script execution after redirect
    }
    return $isLoggedIn;
}
