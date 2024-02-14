<?php include('connect.php')?>
<?php 
session_start();
$status = false;
$user = "";
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    $status = $_SESSION['loggedin'];
    $user = $_SESSION['username'];
}
    $sql = "SELECT * FROM users WHERE username = '$user'";
    $result = mysqli_query($conn, $sql);
    $userInfo = mysqli_fetch_assoc($result);

    $bookSql = "SELECT * FROM posts WHERE userID = " . $userInfo['userID'] . " ORDER BY CreatedDate DESC";
    $res = mysqli_query($conn, $bookSql);
    $bookCollection = mysqli_fetch_all($res, MYSQLI_ASSOC);
    mysqli_close($conn);
?>
<div class="logout"><?php include('templates/logout.php')?></div>
<div class="goBack" id="goBack"><button>Go Back</button></div>
<div class="userInfo">
    <div class="pic">
      <img src="icons/profilePic.svg" class="profilePicProfile">
   </div>
   <div class="realInfo">
    <div class="username">Username: <?php echo $userInfo['username']?></p></div>
    <div class="email">Email: <?php echo $userInfo['email']?></div>
    <div class="phoneNum">Phone Num: <?php echo $userInfo['phoneNum']?></div>
    <div class="Location">Location:<?php echo $userInfo['location']?></div>
    <div class="dateJoined">Member Since <?php echo explode(" ", $userInfo['CreatedDate'])[0]?></div>
  </div>
</div>
<div class="booksSection">
    <P>Your Trading Posts</P>
    <div class="books">
        <?php foreach($bookCollection as $book) { ?>
            <div class="bookPost">
                <div class="infoAboutBook">
                    <div class="bookName">Book Title: <?php echo $book['bookTitle']?></div>
                    <div class="postDate">Posted On: <?php echo $book['CreatedDate']?></div>
                </div>
                <div class="deletBook">
                    <form method="post" action="">
                        <input type="hidden" name="postID" value="<?php echo $book['postID']; ?>">
                        <input type="submit" value="Delete" class="deleteBtn" name="delete">
                    </form>
                </div>
            </div>
        <?php } ?>

        <?php 
        if(isset($_POST['delete'])){
            header("Location: {$_SERVER['PHP_SELF']}");
            include('connect.php');
            $postID = $_POST['postID'];
            $sql = "DELETE FROM posts WHERE postID = '$postID'"; 
            mysqli_query($conn, $sql);
            mysqli_close($conn);
        }
        ?>
    </div>
</div>

    </div>
</div>
<style>
    body{
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .profilePicProfile{
        width: 100px;
    }
    .userInfo{
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-top: 70px;
        background-color: #40514E;
        width: 380px;
        height: 320px;
        border-radius: 30px;
        padding-top: 25px;
    }
    .realInfo{
        margin-top: 20px;
        color: #E4F9F5;
        display: flex;
        flex-direction: column;
        gap: 10px;
        cursor: default;
    }

   .dateJoined{
    text-align: center;
   }

   .booksSection{
    width: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    margin-bottom: 150px;
    cursor: default;
   }

   .booksSection p{
    font-size: 30px;
    color: #40514E;
    font-weight: bold;
   }

   .books{
    background-color: #40514E;
    width: 90%;
    min-height: 300px;
    border-radius: 15px;
   }

   .bookPost{
    border: solid 1px;
    display: flex;
    gap: 20px;
    justify-content: space-between;
    height: 50px;
    color: #E4F9F5;
    gap: 10px;
    padding: 10px;
   }

   .deletBook{
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
   }

   .deleteBtn{
    cursor: pointer;
    background: none;
    border: none;
    font-weight: bold;
    font-size: 17px;
    color: #F73333;
   }

   .logout{
    position: absolute;
    right: 0;
    padding: 20px;
   }

   .goBack{
    position: absolute;
    left: 0;
    padding: 20px;
   }

   .goBack button{
    background-color: #1FCEA3;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    text-decoration: none;
   }

</style>
<script>
    document.getElementById('goBack').addEventListener('click', () => {
        window.location.href = "index.php";
    })
</script>
<?php include('templates/footer.php')?>