
<?php
    session_start();
    include("../../Connection/connection.php");

    $error = "";

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $user_name = $_POST["user_name"];
        $password = $_POST["password"];

        if(!empty($user_name) && !empty($password)) {
            $query = "select * from users where Username = '$user_name' limit 1";
            $result = mysqli_query($conn , $query);
            if($result) {
                if(mysqli_num_rows($result) > 0) {
                    $user_data = mysqli_fetch_assoc($result);
                    if($user_data["Password"] === $password) {
                        header("Location: FrontPage.php");
                        exit();
                    } else {
                        $error = "Incorrect password, please try again";
                    }
                } else {
                    $error = "User not found with that username";
                }
            } else {
                $error = "Query failed";
            }
        } else {
            $error = "Please enter both username and password";
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../styles/SignUpAndLogIn.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>
                Welcome Back
            </h1>
            <h4>
                Enter your login credential to login
            </h4>
        </div>
        <form action="" method="POST">
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
                <i class="form-input-icon fa-solid fa-lock"></i>
                <input 
                    type="password"
                    name="password"
                    placeholder="password"
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

           <button class="form-button">
                Login
           </button>
        </form>
        <div class="footer">
            <p>
                Don't have an account?
            </p>
            <a href="SignUp.php">
                SignUp
            </a>
        </div>
    </div>
</body>
</html>
