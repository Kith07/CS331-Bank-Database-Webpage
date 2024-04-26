<?php
require_once(__DIR__ . "/navigation.php");

session_start();

if (isset($_SESSION['message'])) {
    echo "<div class='message'>" . $_SESSION['message'] . "</div>";
    // Once the message is displayed, remove it from the session
    unset($_SESSION['message']);
}

$email = $password = "";
$email_err = $password_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $pdo = getDB();

    if (empty(trim($_POST["email"]))) {
        $email_err = "<strong>Please enter your email.</strong>";
    } else {
        $email = trim($_POST["email"]);
    }

    if (empty(trim($_POST["password"]))) {
        $password_err = "<strong>Please enter your password.</strong>";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if (empty($email_err) && empty($password_err)) {
        // Prepare a select statement
        try {
            // Prepare a SQL query
            $sql = "SELECT * FROM Customers2 WHERE email = :email AND password = :password";
            $stmt = $pdo->prepare($sql);

            // Bind parameters
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);

            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION["loggedin"] = false;

                if ($row) {
                    // Combination exists, redirect to home page
                    $_SESSION["email"] = $email;
                    $_SESSION["loggedin"] = true;
                    header("location: homePage.php");
                    exit();
                } else {
                    // Combination doesn't exist, display error
                    $email_err = "<br><strong>No account found with that email or incorrect password.</strong>";
                }
        } catch (PDOException $e) {
            // Handle database connection or query errors
            echo "Database Error: " . $e->getMessage();
        }
    }
}
?>

<div class="container-fluid">
    <form onsubmit="return validateForm()" method="POST" action="bankLogin.php">
        <div>
            <?php if (!empty($email_err)) {
                echo "<div class='error'>$email_err</div>";
            } ?>
            <?php if (!empty($password_err)) {
                echo "<div class='error'>$password_err</div>";
            } ?>
            </br><label for="email">Email:</label>
            <input type="email" id="email" name="email" required />
        </div>
        <div>
            </br><label for="pw">Password:</label>
            <input type="password" id="pw" name="password" required minlength="8" />
        </div>
        </br><input type="submit" value="Login" />
    </form>
</div>

<script>
    function validateForm() {
        let email = document.getElementById('email').value;
        let password = document.getElementById('pw').value;
        let isValid = true;

        function isValidEmail(email) {
            const emailRegEx = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegEx.test(email);
        }

        if (email.trim() === "") {
            document.getElementById('email_err').innerHTML = "<strong>Email must not be empty</strong>";
            isValid = false;
        } else if (!isValidEmail(email)) {
            document.getElementById('email_err').innerHTML = "<strong>Invalid email address</strong>";
            isValid = false;
        } else {
            document.getElementById('email_err').innerHTML = ""; // Clear previous error message
        }

        if (password.trim() === "") {
            document.getElementById('password_err').innerHTML = "<strong>Password must not be empty</strong>";
            isValid = false;
        } else if (password.length < 8) {
            document.getElementById('password_err').innerHTML = "<strong>Password too short</strong>";
            isValid = false;
        } else {
            document.getElementById('password_err').innerHTML = ""; // Clear previous error message
        }

        return isValid;
    }
</script>