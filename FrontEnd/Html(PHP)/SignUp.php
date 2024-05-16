<?php
    session_start();

    include("../../Connection/connection.php");

    $error = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $full_name = $_POST["full_name"];
        $user_name = $_POST["user_name"];
        $email = $_POST["email"];
        $user_id = $_POST["user_id"];
        $password = $_POST["password"];
        $confirm_password = $_POST["confirm_password"];

        if (!empty($full_name) && !empty($user_name) && !empty($email) && !empty($user_id) && !empty($password) && !empty($confirm_password)) {
            $email_query = "SELECT * FROM users WHERE Email = '$email' LIMIT 1";
            $result = mysqli_query($conn, $email_query);
            if (mysqli_num_rows($result) > 0) {
                $error = "The user with this email already exists. Please try again with a different email.";
            } elseif ($password !== $confirm_password) {
                $error = "The password is incorrect. Please try again.";
            } else {
                $query = "INSERT INTO users (UserId, Username, FullName, Email, Password) VALUES ('$user_id', '$user_name', '$full_name', '$email', '$password')";
                mysqli_query($conn, $query);
                header("Location: login.php");
                exit();
            }
        } else {
            $error = "Something went wrong. Please enter valid information.";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script defer src = "https://use.fontawesome.com/releases/v6.0.0/js/all.js"></script>
    <title>Sign-Up</title>
    <link rel="stylesheet" href="../styles/SignUpAndLogIn.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>
                Sign up
            </h1>
            <h4>
                Create your account
            </h4>
        </div>
        <form action="" method="POST">
            <div class="form-input-container">
                <i class="form-input-icon fa-solid fa-user"></i>
                <input 
                    type="text"
                    name="full_name"
                    placeholder="FullName"
                    class="form-input"
                >
            </div>
            <div class="form-input-container">
                <i class="form-input-icon fa-solid fa-user"></i>
                <input 
                    type="text"
                    name="user_name"
                    placeholder="username"
                    class="form-input"
                >
            </div>
            <div class="form-input-container">
                <i class="form-input-icon fa-solid fa-envelope"></i>
                <input 
                    type="email"
                    name="email"
                    placeholder="email"
                    class="form-input"
                >
            </div>
            <div class="form-input-container">
                <i class="form-input-icon fa-solid fa-envelope"></i>
                <input 
                    type="text"
                    name="user_id"
                    placeholder="id"
                    class="form-input"
                >
            </div>
            <div class="form-input-container">
                <i class="form-input-icon fa-solid fa-lock"></i>
                <input 
                    type="password"
                    name="password"
                    placeholder="password"
                    class="form-input"
                >
            </div>
           <div class="form-input-container">
                <i class="form-input-icon fa-solid fa-lock"></i>
                <input 
                    type="password"
                    name="confirm_password"
                    placeholder="confirm password"
                    class="form-input"
                >
           </div>

           <?php if(!empty($error)): ?>
                <div class="error-message">
                    <?php 
                        echo $error; 
                    ?>
                </div>
            <?php endif; ?>

           <button type="submit" class="form-button">
                SignUp
           </button>
        </form>
        <div class="footer">
            <p>
                Already have an account?
            </p>
            <a href="login.php">
                Login
            </a>
        </div>
    </div>
</body>
</html>