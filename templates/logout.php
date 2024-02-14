<?php 
if(isset($_POST['logout'])){
    session_start();
    session_unset();
    session_destroy();
    header("Location: index.php");
}
?>

<form action="" method="post">
    <input type="submit" value="Logout" name="logout" class="logoutBtn">
</form>

<style>
.logoutBtn {
    background-color: #ff3333;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    text-decoration: none;
}

.logoutBtn:hover {
    background-color: #cc0000;
}
</style>