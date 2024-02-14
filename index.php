<?php include('connect.php')?>
<?php 
session_start();
$status = false;
$user = [];
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    $status = $_SESSION['loggedin'];
    $user = $_SESSION['username'];
}

$location = "Beirut";
if (isset($_POST['searchLocation'])) {
    $location = $_POST['locationSearch'];
}

$postsSql = "SELECT * FROM posts JOIN users on posts.userID = users.userID WHERE location = '$location' ORDER BY posts.createdDate DESC";
$result = mysqli_query($conn, $postsSql);
$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_close($conn);

function getUserByID($userID){
    include('connect.php');
    $sql = "SELECT * FROM users WHERE userID = $userID";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);
    mysqli_close($conn);
    return $user;
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
<?php include('templates/header.php')?>
<main class="main">
<div class="loctionSearch">
<form action="" method="post">
    <select id="locations" name="locationSearch" class="locationSearch">
        <option value="Beirut" <?php if ($location == "Beirut") echo "selected"; ?>>Beirut</option>
        <option value="Tripoli" <?php if ($location == "Tripoli") echo "selected"; ?>>Tripoli</option>
        <option value="Tyre" <?php if ($location == "Tyre") echo "selected"; ?>>Tyre</option>
        <option value="Baabda" <?php if ($location == "Baabda") echo "selected"; ?>>Baabda</option>
        <option value="Jounieh" <?php if ($location == "Jounieh") echo "selected"; ?>>Jounieh</option>
        <option value="Zahle" <?php if ($location == "Zahle") echo "selected"; ?>>Zahle</option>
        <option value="Batroun" <?php if ($location == "Batroun") echo "selected"; ?>>Batroun</option>
        <option value="Baalbek" <?php if ($location == "Baalbek") echo "selected"; ?>>Baalbek</option>
        <option value="Anjar" <?php if ($location == "Anjar") echo "selected"; ?>>Anjar</option>
        <option value="Bekaa Valley" <?php if ($location == "Bekaa Valley") echo "selected"; ?>>Bekaa Valley</option>
        <option value="Chouf Mountains" <?php if ($location == "Chouf Mountains") echo "selected"; ?>>Chouf Mountains</option>
    </select>
    <input type="submit" name="searchLocation" class="searchBtn" value="search">
</form>

</div>
<div class ='postArea'>
<?php 
if(mysqli_num_rows($result) > 0){//if we have posts
 foreach($posts as $post){ $postUser = getUserByID($post['userID']);   ?>
           
            <div class='post'>
              <div class='postTop'>
                <img src='icons/book2.svg' class='postIcon'>
              </div>
               <div class='postInfo'>
                <div class='bookTitle'><p>Book Title:</p> <?php echo $post['bookTitle']?></div>
                <div class='username'><p>user:</p> <?php echo $postUser['username']?></div>
                <div class='location'><p>location:</p> <?php echo $postUser['location']?></div>
                <div class='phone'><p>Phone Num:</p> <?php echo $postUser['phoneNum']?></div>
              </div>
            </div>
          
          <?php
 }
}
else{
    echo "<div class ='postAreaEmpty'><p>No Posts in $location yet</p></div>";
}
?>
</div>
</main>
<?php include('templates/footer.php')?>
</body>
</html>