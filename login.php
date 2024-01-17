<?php
include("connection.php");
if(isset($_POST['submit'])){
$username= mysqli_real_escape_string($conn,$_POST['user']);
$password =mysqli_real_escape_string($conn,$_POST['pass']);


$sql="select * from users where username='$username' or email='username'";
$result = mysqli_query($conn,$sql);
$row =mysqli_fetch_array($result,MYSQLI_ASSOC);


if($row){
if(password_verify($password,$row["password"])){
$sql="select * from users where username='$username' or email='username'";
$r = mysqli_fetch_array(mysqli_query($conn,$sql));
session_start();
$_SESSION['name'] =$r['username'];
header("location:welcome.php");
}
}

else {
echo '<script>
alert("invalid username or password!!")
window.location.href = "login.php"
</script>';
}
}

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

</head>

<body>
    <?php include"navbar.php";
     ?>
    <div id="form">
        <h1 id=" heading">login form</h1><br>
        <form name="form" action="login.php" method="POST">
            <label>Enter Username/Email</label>
            <input type="text" id="user" name="user" placeholder="Enter Username" required> <br><br>
            <label>Enter Password</label>
            <input type="password" id="pass" name="pass" placeholder="Create Password" required> <br><br>
            <input type="submit" id="btn" value="Login" name="submit" />

        </form>
    </div>
    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>