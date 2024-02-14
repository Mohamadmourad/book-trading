<?php include('connect.php')?>
<?php 
session_start();
if(isset($_POST['login'])){
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header('Location: index.php');
    } else {
        $errorMessage = "Invalid username or password";
    }
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="app.css" rel="stylesheet" type="text/css" />
    <title>Login</title>
</head>
<body>
<div class="login">
<p>Login</p>
<form action="login.php" method="post">
    <input type="text" name="username" placeholder="Username" class="input" autocomplete="off"
    value="<?php if(isset($_POST['username'])) echo $_POST['username']?>" required>
    <input type="password" name="password" placeholder="Password" class="input" autocomplete="off" required>
    <input type="submit" value="login" name="login" class="loggedBtn">
</form>
<a href="signup.php" class="createAccLink">Create Account</a>
</div>
<?php
        if(isset($errorMessage)) {
            echo '<p class="creationErr">' . $errorMessage . '</p>';
        }
?>
<style>
    body{
        background-color: #E4F9F5;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
    .login {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-top: 100px;
        background-color: #40514E;
        width: 380px;
        height: 320px;
        border-radius: 30px;
        padding-top: 25px;
    }
    form{
        display: flex;
        flex-direction: column;
        width: 300px;
        gap: 15px;
    }
    p{
        font-size: 30px;
        color: white;
       font-weight: bold;
    }
    .input{
        background: none;
        border: none;
        border-bottom: solid 2px #E4F9F5;
        color: #30F3CA;
        padding: 5px 0;
        font-weight: bold;
    }

    .input:focus{
        outline: none;
    }
    .input::placeholder{
        color: #E4F9F5;
    }

    .loggedBtn{
        background-color: #30F3CA;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 10px;
        font-weight: bold;
        cursor: pointer;
        margin-top: 15px;
        width: 150px;
        position: relative;
        left: 150px;
        height: 45px;
    }
    .loggedBtn:hover{
        background-color: #E4F9F5;
        color: #30F3CA;
    }

    .creationErr{
        color: red;
        font-weight: bold;
        font-size: 13px;
    }
    .createAccLink{
        color: #30F3CA;
        text-decoration: none;
        font-weight: bold;
        margin-top: 30px;
        position: relative;
        right: 100px;
        text-decoration: underline;
    }
</style>
</body>
</html>