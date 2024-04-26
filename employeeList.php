<?php
session_start();
require(__DIR__ . "/navigation.php");
require(__DIR__ . "/renderFuncs.php");

// Check if user is logged in
if (!is_logged_in()) {
    header("Location: bankLogin.php");
    exit();
}
?>

<?php
$query = "SELECT * FROM Employee";
$db = getDB();
$results = [];
try {
    $stmt = $db->prepare($query);
    $stmt->execute();
    $results = $stmt->fetchAll();
} catch (Exception $e) {
    error_log("Error Fetching Locations: " . var_export($e, true));
}

$table = ["data" => $results, "ignored_columns" => ["0", "1", "2", "3", "4", "5"], "title" => "List of Employees"];
?>

<div class = "container-fluid">
    <br><?php render_table($table); ?>
</div>