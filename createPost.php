<?php include('connect.php')?>
<?php session_start();
$status = false;
$user = "";
$errorMessage = "";
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    $status = $_SESSION['loggedin'];
    $user = $_SESSION['username'];
}

if(isset($_POST['addPost']) && isset($_POST['bookTitle'])){
    if(strlen($_POST['bookTitle']) > 3){
        $bookTitle = $_POST['bookTitle'];
        $sql = "INSERT INTO posts (userID, bookTitle) VALUES ((SELECT userID FROM users WHERE username = '$user'), '$bookTitle')";
        if(mysqli_query($conn, $sql)){
            header('Location: index.php');
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        $errorMessage = "Book title must be at least 3 characters long.";
    }
}
?>
<?php include('templates/header.php')?>
<div class="addPost">
    <div class="postCreationBox">
    <p>Add Post</p>
      <form action="createPost.php" method="post">
          <input type="text" name="bookTitle" placeholder="Book Title" class="input" autocomplete="off" required>
          <input type="submit" value="Add Post" name="addPost" class="addBtn">
      </form>
    </div>
    <p class="errorMessage"><?php echo $errorMessage?></p>
</div>

<style>
   .addPost{
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    flex-direction: column;
   }

   .postCreationBox{
    background-color: #40514E;
    width: 380px;
    height: 270px;
    border-radius: 15px;
    display: flex;
    align-items: center;
    flex-direction: column;
   }

   .postCreationBox p{
    font-weight: bold;
    color: #E4F9F5;
    font-size: 30px;
    margin-bottom: 30px;
   }

   .postCreationBox form{
    margin-top: 30px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    gap: 30px;
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

   .addBtn{
    background-color: #30F3CA;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 10px;
    cursor: pointer;
   }
   .errorMessage{
    color: red;
    font-weight: bold;
    margin-top: 20px;
   }
</style>
<?php include('templates/footer.php')?>