<?php 
 $status = false;
 $user = "";
 if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
     $status = $_SESSION['loggedin'];
     $user = $_SESSION['username'];
 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="app.css" rel="stylesheet" type="text/css">
    <title>Book Trading</title>
</head>
<body>
    <header>
        <a href="index.php" class="fullTitle"><img src="icons/book.svg" class="logo">Book Trading</a>
        <?php if(!$status){ ?>
        <div class="loginButtons">
        <a href="login.php" class="loginBtn">Login</a>   
        <a href="signup.php" class="createBtn">Create Account</a> 
        </div>
        <?php } else { ?>
            <a href="profile.php" class="profilePicLink"><img src="icons/profilePic.svg" class="profilePic"></a>
        <?php } ?> 
    </header>
</body>
</html>