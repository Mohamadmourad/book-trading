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
    <footer>
    <?php if(!$status){ ?>
        <a href="login.php" class="createPostBtn"><img src="icons/plus.svg" class="plusIcon"></a>
        <?php } else { ?>
        <a href="createPost.php" class="createPostBtn"><img src="icons/plus.svg" class="plusIcon"></a>
        <?php } ?> 
    </footer>
</body>
</html>