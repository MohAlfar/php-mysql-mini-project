



<?php

$conn = mysqli_connect('localhost', 'my_db', '123456', 'my_db');

// this if to check if it connects successfully.
if (!$conn) {
    echo 'error in connection: ' . mysqli_connect_error();
}
else{
    echo "connected successfully";
}


$first_name = $last_name = $username = $email = $password =  "";
$error_msg = array('first_name' => '', 'last_name' => '', 'username' => '', 'email' => '', 'password' => '');
if(isset($_POST['submit'])) {
    if(empty($_POST['first_name'])){
        $error_msg['first_name'] = "Please Fill The First Name";
    }
    else{
        $first_name = $_POST['first_name'];}


    if(empty($_POST['last_name'])){
        $error_msg['last_name'] = "Please Fill The Last Name";
    }
    else{
        $last_name = $_POST['last_name'];}


    if(empty($_POST['username'])){
        $error_msg['username'] = "Please Fill The Username";
    }
    else{
        $username = $_POST['username'];}


    if(empty($_POST['email'])){
        $error_msg['email'] = "Please Fill The Email";
    }
    else{
        $email = $_POST['email'];}


    if(empty($_POST['password'])){
        $error_msg['password'] = "Please Fill The Password";
    }else{
        $password = $_POST['password'];}


    if(($first_name && $last_name && $email && $password && $username)) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
        $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);


//        echo $_POST['first_name'] . "<br/>";
//        echo $_POST['last_name'] . "<br/>";
//        echo $_POST['username'] . "<br/>";
//        echo $_POST['email'] . "<br/>";
//        echo $_POST['password'] . "<br/>";

        $sql = "INSERT INTO users(first_name,last_name,username,password,email) VALUES('$first_name','$last_name','$username','$password','$email')";
        if(mysqli_query($conn, $sql)){
            $email="";
            $first_name="";
            // success
            header('Location: signup.php');
        } else {
            echo 'query error: '. mysqli_error($conn);
        }
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
    <h1 style="text-align: center; margin-bottom: 25px"> Signup</h1>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
        <div>
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" value=<?php echo htmlspecialchars($first_name)?>>
            <p style="color: red; font-size: 10px"><?php echo $error_msg['first_name'] ?></p>
        </div>
        <div>
            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" value=<?php echo htmlspecialchars($last_name) ?>>
            <p style="color: red; font-size: 10px"><?php echo $error_msg['last_name'] ?></p>
        </div>
        <div>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value=<?php echo htmlspecialchars($username) ?>>
            <p style="color: red; font-size: 10px"><?php echo $error_msg['username'] ?></p>

        </div>
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
        <div style="margin: auto; width: 35%; padding: 25px">
            <input type="submit" name="submit" value="SignUp!" class="btn btn-danger" style="width: 100%">
        </div>
    </form>
</div>


</html>








<?php

?>

