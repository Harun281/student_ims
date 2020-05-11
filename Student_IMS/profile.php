<?php

//start session
session_start();
//restrict to those loggen in only
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){
header("location: login.php");
exit;
}
require_once ("db.php");

//set variables
$dob = $_POST['dob'];
$email_s = $_POST['email_s'];
$email_p = $_POST['email_p'];
$mobile_s = $_POST['mobile_s'];
$mobile_p = $_POST['mobile_p'];
$county = $_POST['county'];
$id = $_SESSION['id'];

if(isset($_POST['update'])){
    //checking dob
    if(!empty($dob)){
        $dob = validate_data($dob);
        $sql1 = "UPDATE studentdetails SET DoB = '$dob' WHERE Adm = '$id'";
        $result1 = mysqli_query($conn, $sql1);
    }
    //check student email
    if(!empty($email_s)){
        $email_s = validate_data($email_s);
        $sql2 = "UPDATE studentdetails SET EmailAddress = '$email_s' WHERE Adm = '$id'";
        $result2 = mysqli_query($conn, $sql2);
        $sql3 = "UPDATE users SET Email = '$email_s' WHERE AdmNo = '$id'"; //making sure that the two tables are updated
        $result3 = mysqli_query($conn, $sql3);
    }
    //check student mobile
    if(!empty($mobile_s)){
        $mobile_s = validate_data($mobile_s);
        $sql4 = "UPDATE studentdetails SET Mobile = '$mobile_s' WHERE Adm = '$id'";
        $result4 = mysqli_query($conn, $sql4);
        $sql5 = "UPDATE users SET Mobile = '$mobile_s' WHERE AdmNO = '$id'";
        $result5 = mysqli_query($conn, $sql5);
    }
    //check county
    if(!empty($county)){
        $county = validate_data($county);
        $sql6 = "UPDATE studentdetails SET County = '$county' WHERE Adm = '$id'";
        $result6 = mysqli_query($conn, $sql5);
    }

    //Updating parents details

    //check student email
    /*if(!empty($email_p)){
        $email_p = validate_data($email_p);
        $sql6 = "UPDATE parents SET Email= '$email_p' WHERE StudentAdm = '$id'";
        $result6 = mysqli_query($conn, $sql6);
    }
    //check student mobile
    if(!empty($mobile_s)){
        $mobile_s = validate_data($mobile_s);
        $sql4 = "UPDATE studentdetails SET Mobile = '$mobile_s' WHERE Adm = '$id'";
        $result4 = mysqli_query($conn, $sql4);
    }*/




    //throw errors
    if($result1 && $result2 && $result3 && $result4 && $result5 && $result6){
        echo '<script>alert("Profile updated successfully\n Your email changed! You will be directed to login "); window.location = "logout.php" </script>';
        }elseif($result2 && $result3 && $result4 && $result5){
            echo '<script>alert("Profile updated successfully except Date of birth"); window.location = "index.php" </script>';  
        }elseif($result4 && $result5){
            echo '<script>alert("Profile updated successfully except DOB and Email"); window.location = "index.php" </script>';  
        }elseif($result5){
            echo '<script>alert("You updated your County only"); window.location = "index.php" </script>';  
        }elseif($result1){
            echo '<script>alert("You updated your Dob only"); window.location = "index.php" </script>';  
        }elseif($result2 && $result3){
            echo '<script>alert("You updated your Email only.\n Your email changed! You will be directed to login "); window.location = "logout.php" </script>';  
        }elseif($result4){
            echo '<script>alert("You updated your Mobile only"); window.location = "index.php" </script>';  
        }else{
            echo '<script>alert("Empty or errors in inputs"); window.location = "index.php" </script>';  
        }
    
    
    

}
mysqli_close($conn);


//function to filter out data
function validate_data($data){
    $data = htmlspecialchars($data);
    $data = trim($data);
    $data = stripslashes($data);
    return $data;

}

?>
