<?php
session_start();
if (!isset($_SESSION['name'])){
    header("location:welcome.php");
}
?>
<?php
include("connection.php");
if(isset($_POST['submit'])){
    $username= mysqli_real_escape_string($conn,$_POST['user']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $password =mysqli_real_escape_string($conn,$_POST['pass']);
    $cpassword =mysqli_real_escape_string($conn,$_POST['cpass']);
    
    $sql="select * from users where username='$username'";
    $result = mysqli_query($conn,$sql);
    $count_user = mysqli_num_rows($result);

    
    $sql="select * from users where email='$email'";
    $result = mysqli_query($conn,$sql);
    $count_email= mysqli_num_rows($result);
    

    if($count_user ==0 & $count_email==0){
        if($password==$cpassword){
            $hash =password_hash($password,PASSWORD_DEFAULT);
            $sql ="INSERT INTO users(username,email,password)VALUES('$username', '$email', '$hash')";
            $result =mysqli_query($conn,$sql);
            if($result){
                header("location:login.php");
            }

		}
        
else { 
            echo '<script>
        alert("passwords do not match")
        window.location.href = "signup.php"
        </script>';
        }
        
    }
    else{
  echo '<script>
        alert("user already exists")
        window.location.href = "index.php"
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
        <h1 id=" heading">signup form</h1><br>
        <form name="form" action="signup.php" method="POST">
            <label>Enter Username</label>
            <input type="text" id="user" name="user" placeholder="Enter Username" required> <br><br>
            <label>Enter Email</label>
            <input type="email" id="email" name="email" placeholder="Enter Email" required> <br><br>
            <label>Enter Password</label>
            <input type="password" id="pass" name="pass" placeholder="Create Password" required> <br><br>
            <label>Confirm Password</label>
            <input type="password" id="cpass" name="cpass" placeholder="Confirm Password" required> <br><br>
            <input type="submit" id="btn" value="SignUp" name="submit" />
        </form>
    </div>
    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>