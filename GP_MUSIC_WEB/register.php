<?php

@include 'config.php';

if(isset($_POST['submit'])){

$name = mysqli_real_escape_string($conn, $_POST['username']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$pass = md5($_POST['password']);
$cpass = md5($_POST['cpassword']);

$select = " SELECT * FROM user_form WHERE email = '$email' && password = 'pass' ";

$result = mysqli_query($conn, $select);

if(mysqli_num_rows($result) > 0){
    $error[] = 'user already exist!';
}else{
    if($pass != $cpass){
        $error[] = 'password do not match!';
    }else{
        $insert = "INSERT INTO user_form(name, email, password) VALUES('$name','$email','$pass')";
        mysqli_query($conn, $insert);
        header('location:login.php');
    }
}

};

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
        crossorigin="anonymous"></script>

</head>

<body>
    <div class="video-container">
    <video autoplay muted loop id="background-video">
        <!-- background video -->
        <source src="assets/images/a-train.mp4" type="video/mp4">
        Your browser does not support the video tag.
      </video>
      </div>
      
      <div class="register-container">
        <form action="" method="post">
            <?php

            if(isset($error)){
                foreach($error as $error){
                    echo '<span class="error-msg">'.$error.'</span>';
                };
            };

            ?>
            <div class="form-group">
                <label for="username">User name:</label>
                <input type="text" id="username" name="username" required placeholder="Enter your username">
            </div>

            <div class="form-group">
                <label for="email">Email:</label><br>
                <input type="email" id="email" name="email" required placeholder="Enter your email">
            </div>

            <div class="form-group">
                <label for="password">New Password:</label>
                <input type="password" id="password" name="password" required placeholder="Enter your password">
            </div>

            <div class="form-group">
                <label for="password">Re-enter Password:</label>
                <input type="password" id="cpassword" name="cpassword" required placeholder="Confirm your password">
            </div>

            <div class="form-group">
                <button type="submit" name="submit" value="register now">Register</button>
            </div>
            <p id="register-error-message" class="error-message"></p>
        </form>

        <div class="additional-links">
            <span>Already have an account? <a href="login.php">Login</a></span>
        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>