<?php
function reset_session()
{
    session_unset(); // Unset all session variables
    session_destroy(); // Destroy the session
    session_start(); // Start a new session
    if (!session_id()) {
        // Handle any errors in starting a new session
        echo "Failed to start a new session";
        exit; // Terminate script execution
    }
}
