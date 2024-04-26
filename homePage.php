<?php
session_start();
require(__DIR__ . "/navigation.php");

// Check if user is logged in
if (!is_logged_in()) {
    header("Location: bankLogin.php");
    exit();
}
?>

<div class="container-fluid">
    <h1>Home</h1>
    <div class="message">
        <?php
        if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && isset($_SESSION["email"])) {
            // Output welcome message with email
            echo "<p>Welcome, " . $_SESSION["email"] . "!</p>";
        } else {
            echo "<p>Welcome to the home page!</p>";
        }
        ?>
        <div>
            <a href="<?php echo get_url("/branchList.php"); ?>" class="btn">Branches</a>
            <a href="<?php echo get_url("/employeeList.php"); ?>" class="btn">Employees</a>
            <a href="<?php echo get_url("/customerList.php"); ?>" class="btn">Customers</a>
        </div>
    </div>
</div>