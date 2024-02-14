<?php include('connect.php')?>
<?php 
if(isset($_POST['created'])){
    $createUsername = $_POST['createUsername'];
    $createPassword = $_POST['createPassword'];
    $createPhoneNum = $_POST['createPhoneNum'];
    $createEmail = $_POST['createEmail'];
    $locations = $_POST['locations'];
    
    $sqlCheck = "SELECT COUNT(*) AS num FROM users WHERE username = '$createUsername'";
    $result = mysqli_query($conn, $sqlCheck);
    $row = mysqli_fetch_assoc($result);
    if ($row['num'] > 0) {
    $errorMessage = "Username already exists. Please choose a different username.";//if username already exits
    } 
    else if(strlen($createPassword) < 8){
        $errorMessage = "Password must be at least 8 characters long.";//if password is less than 8 characters
    }
    else if(!preg_match('/^[0-9]{8}$/', $createPhoneNum)){
        $errorMessage = "Phone number must be 8 digits long.";//if phone number is not 8 digits long
    }
    else if(!filter_var($createEmail, FILTER_VALIDATE_EMAIL)){
        $errorMessage = "Invalid email address.";//if email is invalid
    }
    else if(empty($createUsername) || empty($createPassword) || empty($createPhoneNum) || empty($createEmail) || empty($locations)){
        $errorMessage = "Please fill in all fields.";//if any field is empty
        
    }
    else {
    $currentDate = date("Y-m-d");
     $sqlInsert = "INSERT INTO users (username, password, phoneNum, email, location, CreatedDate) VALUES ('$createUsername', '$createPassword', '$createPhoneNum', '$createEmail', '$locations','$currentDate')";//adding data

    if(mysqli_query($conn, $sqlInsert)){
        header('Location: index.php');
    } else {
        $errorMessage = "Error: " . mysqli_error($conn);
    }
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
    <title>Create Account</title>
</head>
<body>
<div class="createAcc">
<p>Create Account</p>
<form action="signup.php" method="post">
    <input type="text" name="createUsername" placeholder="Username" class="input" autocomplete="off"
    value="<?php if(isset($_POST['createUsername'])) echo $_POST['createUsername']?>" required >

    <input type="password" name="createPassword" placeholder="Password" class="input" autocomplete="off" 
    value="<?php if(isset($_POST['createPassword'])) echo $_POST['createPassword']?>" required>

    <input type="text" name="createPhoneNum" placeholder="Phone Number" class="input" autocomplete="off" 
    value="<?php if(isset($_POST['createPhoneNum'])) echo $_POST['createPhoneNum']?>" required>

    <input type="email" name="createEmail" placeholder="email" class="input" autocomplete="off"
    value="<?php if(isset($_POST['createEmail'])) echo $_POST['createEmail']?>" required>

    <select id="locations" name="locations" class="location">
            <option value="Beirut">Beirut</option>
            <option value="Tripoli">Tripoli</option>
            <option value="Tyre">Tyre</option>
            <option value="Baabda">Baabda</option>
            <option value="Jounieh">Jounieh</option>
            <option value="Zahle">Zahle</option>
            <option value="Batroun">Batroun</option>
            <option value="Baalbek">Baalbek</option>
            <option value="Anjar">Anjar</option>
            <option value="Bekaa Valley">Bekaa Valley</option>
            <option value="Chouf Mountains">Chouf Mountains</option>
        </select>
    <input type="submit" value="Create Account" name="created" class="createBtn">
</form>
<a href="login.php" class="loginLink">Login</a>
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
    .createAcc {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-top: 100px;
        background-color: #40514E;
        width: 380px;
        height: 430px;
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

    .createBtn{
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
    .createBtn:hover{
        background-color: #E4F9F5;
        color: #30F3CA;
    }
    .location{
        background: none;
        border: none;
        border-bottom: solid 2px #E4F9F5;
        color: #30F3CA;
        padding: 5px 0;
        font-weight: bold;
    }
    .location:focus{
        outline: none;
    }
    .location::placeholder{
        color: #E4F9F5;
    }
    .location option{
        color: #30F3CA;
        background-color: #40514E;
    }

    .creationErr{
        color: red;
        font-weight: bold;
        font-size: 13px;
    }

    .loginLink{
        color: #30F3CA;
        text-decoration: none;
        font-weight: bold;
        margin-top: 15px;
        position: relative;
        right: 140px;
        text-decoration: underline;
    }
    
</style>
</body>
</html>