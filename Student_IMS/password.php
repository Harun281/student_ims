<?php 
include ("db.php");


if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location:login.php");
    exit;
}
//declare variables
$dbpassword = $PasswordConfirm = $oldPassword = $newpassword = $newpasswordconfirm = "";
//$error = array();
$error1 = $error2 = $error3 = "";

//select password from db
$id = ($_SESSION["id"]);
$sql ="SELECT Password FROM Users WHERE AdmNo = '$id'";
$result = mysqli_query($conn,$sql);
if(mysqli_num_rows($result) == 1){
    while($row = mysqli_fetch_assoc($result)){
        $dbpassword = $row["Password"];

    }
}

//process password change
if($_SERVER["REQUEST_METHOD"] == "POST"){
    //compare current and password input
    if(empty($_POST["OldPassword"])){
        //$error[0] = "";
        $error1 = "";

    }else{
        $oldPassword = test_input($_POST["OldPassword"]);
        $oldPassword = md5($oldPassword);
        if($oldPassword != $dbpassword){
            $error1 = "Password Mismatch!";
        }
    }
    //make sure new password meets criteria
    if(empty($_POST["NewPassword"])){
        //$error[1] = "";
        $error2 = "";
    }else{
        $newpassword = test_input($_POST["NewPassword"]);
        if(strlen($newpassword) < 6){
            //$error[1] = "Password must be more than 6 charcters";
            $error2 = "Password must be more than 6 charcters";
        }  

    }

    //make sure new password matches
    if(empty($_POST["NewPasswordConfirm"])){
        //$error[2] = "";
        $error3 = "";
    }else{
        $newpasswordconfirm = test_input($_POST["NewPasswordConfirm"]);
        if($newpassword != $newpasswordconfirm){
            //$error[2] = "New Password did not match";
            $error3 = "New Password did not match";
        }else{
            $newpassword = md5($newpassword);
        }
    }

    //update the database
    if(empty($error1) && empty($error2) && empty($error3)){
        $query ="UPDATE Users SET Password = '$newpassword' WHERE AdmNo = '$id'";
        $result = mysqli_query($conn,$query);
        if($result){
            //echo '<script> alert("Password Updated successfully") </script>';
            echo '<script>alert("Password Successfully Updated!!!\n\n You will be directed to login page"); window.location = "logout.php"</script>';
            /*echo '  <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Success!</strong> This alert box could indicate a successful or positive action.
          </div>';
          echo '<script> window.location = "logout.php"</script>';*/

          
        }else{
        
           // header("location:index.php");
        }
    }else{
        echo '<script> confirm("check for error in inputs!") </script>';

    }

    
}


function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
    }

?>

    <div class="modal-dialog">
       <div class="modal-content">
           <div class="modal-header">
            <h4 class="modal-title">Change Password </h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>

           </div>
           <div class="modal-body">
            <form action="" method="post">
            <labeL for="password">Old Password</labeL>
            <input type="password" placeholder="Enter Current Password" name="OldPassword" required>
            <span class="help-block"><?php  echo $error1; ?></span><br>

            <labeL for="password">New Password</labeL>
            <input type="password" placeholder="Enter New Password" name="NewPassword" required>
            <span class="help-block"><?php  echo $error2; ?></span><br>

            <labeL for="password">Confirm New Password</labeL>
            <input type="password" placeholder="Confirm New Password" name="NewPasswordConfirm" required>
            <span class="help-block"><?php  echo $error3; ?></span><hr>
            
            <div class="modal-footer">
                <button type="submit" id="change" name="change" class="btn btn-success">Change</button>
                <button type="button" class="btn btn-warning" data-dismiss="modal" >Cancel</button>
            </div>
            </form>
           
          

           </div>
       </div> 
    </div>

<!--   <script>  
 $(document).ready(function(){  
      $('#change').click(function(){  
           var oldpass = $('#oldpass').val();  
           var newpass = $('#newpass').val();
           var newpassconf = $('#newpassconf').val();   
           if(oldpass != '' && newpass != '' && newpassconf != '')  
           {  
                $.ajax({  
                     url:"PHP_SELF",  
                     method:"POST",  
                     data: {username:username, password:password},  
                     success:function(data)  
                     {  
                          //alert(data);  
                          if(data == 'No')  
                          {  
                               alert("Wrong Data");  
                          }  
                          else  
                          {  
                               $('#loginModal').hide();  
                               location.reload();  
                          }  
                     }  
                });  
           }  
           else  
           {  
                alert("Both Fields are required");  
           }  
      });  
      $('#logout').click(function(){  
           var action = "logout";  
           $.ajax({  
                url:"action.php",  
                method:"POST",  
                data:{action:action},  
                success:function()  
                {  
                     location.reload();  
                }  
           });  
      });  
 });  
 </script>

        
