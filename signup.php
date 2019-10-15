<?php

session_start();
$email = $password =  "";
$error_msg = array('email' => '', 'password' => '', 'auth'=>'');

$conn = mysqli_connect('localhost', 'my_db', '123456', 'my_db');

// this if to check if it connects successfully.
if (!$conn) {
    echo 'error in connection: ' . mysqli_connect_error();
}
else{
    echo "connected successfully";
}



// How to handle the form with simple validation:

if(isset($_POST['submit'])) {
// to handle the errors:
    if(empty($_POST['email'])){
        $error_msg['email'] = "Please Fill The Email";
    }
    else{
        $email = $_POST['email'];}


    if(empty($_POST['password'])){
        $error_msg['password'] = "Please Fill The Password";
    }else{
        $password = $_POST['password'];}


    if(( $email && $password )) { // to check if the email and password are empty or not.
        $email = mysqli_real_escape_string($conn, $_POST['email']); // to escape the characters to database
        $password = mysqli_real_escape_string($conn, $_POST['password']);


        // preparing sql statement to use it in mysqli_query:
        $sql = "SELECT * FROM users WHERE email='$email' && password='$password'";

        // do the query:
        $result = mysqli_query($conn, $sql);


        // How to handle the first row in result:
        $fresult = mysqli_fetch_assoc($result);


        if($fresult){
            $_SESSION['name'] = $fresult['first_name'];
//        echo $_SESSION['name'];
            header('Location: home.php');
        }
        else
            $error_msg['auth'] = "You are not Authenticated";

    }
}

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">


    <style type="text/css">



        form{
            max-width:460px;
            margin:20px auto;
            padding:20px;
        }
    </style>
</head>


<div class="container" style="width: 50%; border: 1px solid black; padding: 20px; margin-top:50px; margin-bottom:50px">
    <h1 style="text-align: center; margin-bottom: 25px"> Sign in</h1>
    <form action="signup.php" method="POST">

        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value=<?php echo htmlspecialchars($email) ?>>
            <p style="color: red; font-size: 10px"><?php echo $error_msg['email'] ?></p>

        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" value="<?php echo htmlspecialchars($password) ?>">
            <p style="color: red; font-size: 10px"><?php echo $error_msg['password'] ?></p>

        </div>
        <div>
            <p style="color: red"> <?php echo $error_msg['auth'] ?></p>
        </div>
        <div style="margin: auto; width: 35%; padding: 25px">
            <input type="submit" name="submit" value="Login!" class="btn btn-danger" style="width: 100%">
        </div>

    </form>
</div>


</html>