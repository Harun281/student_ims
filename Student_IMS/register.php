<?php
    require_once("db.php");
    $Adm = $Email = $Password = $ConfirmPassword = "";
    $Admerr =$Emailerr = $Passworderr = $ConfirmPassworderr ="";

if($_SERVER["REQUEST_METHOD"] == "POST"){    
    
    if(empty($_POST["Adm"])){
        $Admerr="";
    }else{
        $Adm = test_input($_POST["Adm"]);

        if(! preg_match('/^[0-9]+$/', $Adm)){
            $Admerr = "Admission should be digits not exceeding 6";
        }else{
            //The student must be registered by admin befre registering an accont
            $sql ="SELECT Adm FROM StudentDetails WHERE Adm = '$Adm'";
            $result = mysqli_query($conn,$sql);
            if(mysqli_num_rows($result) != 1){
                $Admerr = "Student not found. Check your Admission Number";
            }else{
                //Avoid same student openining more than one account
                $query ="SELECT AdmNo FROM Users WHERE AdmNo = '$Adm'";
                $row = mysqli_query($conn,$query);
                if(mysqli_num_rows($row) == 1){
                    $Admerr = "Admission Number exists in user accounts. Log in!";
                }
            }
           
        }
    }

    if(empty($_POST["email"])){
        $Emailerr = "";
    }else{
        $Email = test_input($_POST["email"]);
        if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
            $Emailerr = "Invalid email format";
        }else{
            $query ="SELECT Email FROM Users WHERE Email = '$Email'";
            $row = mysqli_query($conn,$query);
            if(mysqli_num_rows($row) == 1){
                $Emailerr = "Emaill Account already Exist! Log In.";
            }
        }
    }


    //Validate Password
    if(empty($_POST["password"])){
        $Passworderr = "";
    }else{
        $Password = test_input($_POST["password"]);
        if(strlen($Password) < 6){
            $Passworderr = "Password must have atleast 6 characters.";
        }
    }
    //Validate Confirm password
    if(empty($_POST["confirmPassword"])){
        $ConfirmPassworderr = "";
    }else{
        $confirmPassword = test_input($_POST["confirmPassword"]);
        }
    //Ensuring that password and confirm password matches
    if(empty($Passworderr) && ($Password != $confirmPassword)){
        $ConfirmPassworderr = "Password did not match";
        }else{
            $Password = md5($Password);
        }
    
    if( empty($Admerr) && empty($$Emailerr) && empty($Passworderr) && empty($ConfirmPassworderr)){

        $query= "INSERT INTO Users (AdmNo, Email, Password)
            VALUES('$Adm', '$Email', '$Password')";
        $result = mysqli_query($conn,$query);
        if($result){
            $sql = "UPDATE studentdetails SET EmailAddress = '$Email' WHERE Adm = '$Adm'";
            $result1 = mysqli_query($conn,$sql);
            header("location:login.php");     
        }else{
            echo '<script>
            alert ("Ooops! Something went wrong. Please try again later.")
            </script>';
            }
    mysqli_close($conn);
    }


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
        <title>Register || Portal</title>
  
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
        <h3>Student Portal Register</h3>
        <p class="help">Note: You must be a student at ABC to Register</p>
        <p class="help"><b>*Required</b></p>
        <form class="container" method="post" action="" >
    
            <label for="email">Admission Number<b>*</b></label>
            <input type="number" placeholder="Enter Adm NO in Given During admission. e.g 5678" name="Adm" value="<?php echo $Adm ?>" required>
            <span class="help-block"><?php echo $Admerr; ?></span><br>

            <label for="email">Email<b>*</b></label>
            <input type="email" placeholder="e.g abc@gmail.com" name="email" value="<?php echo $Email ?>" required>
            <span class="help-block"><?php echo $Emailerr; ?></span><br>

            <label for="password">Password<b>*</b></label>
            <input type="password" placeholder="Enter Password. Should be 6 or more characters" name="password" required>
            <span class="help-block"><?php echo $Passworderr; ?></span><br>

            <label for="confirmPassword">Confirm Password<b>*</b></label>
            <input type="password" placeholder="Confirm Password" name="confirmPassword" required>
            <span class="help-block"><?php echo $ConfirmPassworderr; ?></span>
            <hr>
            <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>

            <button type="submit" class="btn btn-success registerbtn" >Register</button>
        </form>
        <div class="container signin">
            <p>Already have an account?</p><br><a href="login.php"><button class="btn btn-primary bt-lg">Login Here</button></a><hr>
        </div><hr>
        <div style="margin-bottom: 6%" class="container signin">
            <p>Having problem registering? </p><br>
            <a href="#"><button class="btn btn-info">Email ICT</button></a> or <a type="tel" href="#"><button class="btn btn-info">Call ICT</button></a>

        </div>

    </div>
</body>
</html>