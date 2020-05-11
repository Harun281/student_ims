<?php
    session_start();
 
    // Check if the user is already logged in, if yes then redirect him to welcome page
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        header("location: index.php");
        exit;
    }
     
    // Include config file
    require_once "db.php";
    $Email = $Password = $adm = $Mobile = "";
    $Emailerr = $Passworderr = $EmailConfirm = $AdmConfirm = $PasswordConfirm = $mobileConfirm = "";

    

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        if(empty($_POST["email"])){
            $Emailerr= "";
        }else{
            $Email = test_input($_POST["email"]);
            $adm = test_input($_POST['email']);
            $Mobile = test_input($_POST['email']);
        }

        
        $sql = "SELECT AdmNo, Email,Mobile, Password FROM Users WHERE Email = '$Email' ";//OR AdmNo = '$adm' OR Mobile = '$Mobile'
        $result = mysqli_query($conn,$sql);
        if(mysqli_num_rows($result) == 1){
            while($row = mysqli_fetch_assoc($result)){
                $EmailConfirm = $row["Email"];
                $PasswordConfirm = $row["Password"];
                $AdmConfirm = $row["AdmNo"];
                $mobileConfirm = $row["Mobile"];


            }
        }else{
            echo '<script> alert("Somethign went wrong try again later")</script>';
        }

        if($Email != $EmailConfirm) {    //|| $adm != $AdmConfirm || $Mobile != $mobileConfirm)
        $Emailerr = "Invalid Login Creditials";
        }


        if(empty($_POST["password"])){
            $Pasworderr ="";
        }else{
            $Password = test_input($_POST["password"]);
            $Password = md5($Password);
           // $Password_hashed = password_hash($Password, PASSWORD_DEFAULT);
            if(empty($Emailerr) && $Password != $PasswordConfirm){
                $Passworderr = "Incorrect Password";
            }
        }

        /*If error free log in*/
        if(empty($Emailerr) && empty($Passworderr)){
            
            session_start();
            $_SESSION["loggedin"] = true;
            $_SESSION["id"] = $AdmConfirm;
            $_SESSION["email"] = $EmailConfirm;
            header("location:index.php");
        }

        mysqli_close($conn);



    }


    function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login || Portal</title>
  
        <link rel="stylesheet" href="styles.css?<?php echo time(); ?>">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
<body class="regbody">
    <div class="registerForm">
        <h2>ABC BOYS High School</h2>
        <img src="images/download.jpg">
        <h3>Student Portal | Login</h3>
        <p class="help"><b>*Required</b></p>
        <div class="container"  >

            <form method="post" action="">
                <label for="email">Email / Adm No / Mobile<b>*</b></label>
                <input type="text" placeholder="Enter Email / Adm No / Mobile Number" name="email" value="<?php echo $Email ?>" required>
                <span class="help-block"><?php echo"$Emailerr"; ?></span><br>

                <label for="password">Password<b>*</b></label>
                <input type="password" placeholder="Enter Password" name="password" required>
                <span class="help-block"><?php echo"$Passworderr"; ?></span>

                <hr>

                <button type="submit" class="registerbtn">Login</button>
            </form>
        
        <div class="container signin">
        <a href="#"><button class="btn btn-danger">Forgot Password?</button></a><hr>
            <p>Don't have an account?</p><br> <a href="register.php"><button class="btn btn-primary btn-lg">Sign UP</button></a>
        </div><hr>
        <div style="margin-bottom: 6%" class="container signin">
            <p>Having problem Login? </p><br>
            <a href="#"><button class="btn btn-info">Email ICT</button></a> or <a type="tel" href="#"><button class="btn btn-info">Call ICT</button></a>

        </div>
            
            
        </div>

    </div>

</body>
</html>
