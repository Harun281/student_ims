<?php
    session_start();

    // Check if the user is already logged in, if no then redirect him to log in page
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: login.php");
        exit;
    }

    //take data from student table
    require_once "db.php";
    $fname =$mname =$lname = $id = $dob = $phone = $county = $email = $image = "";

    $id = ($_SESSION["id"]);
    $sql = "SELECT * FROM studentdetails WHERE Adm = '$id'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) == 1){
        while($row = mysqli_fetch_assoc($result)){
            $fname = $row['FirstName'] ;
            $mname = $row['MidleName'] ;
            $lname = $row['LastName'] ;
            $dob = $row['DoB'] ;
            $phone = $row['Mobile'] ;
            $county = $row['County'] ;
            $email = $row['EmailAddress'] ;
            $image = $row['imagename'];

            
        }
    }
    mysqli_close($conn);

?>


<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <title>Student Portal</title>
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

        <link href='https://fonts.googleapis.com/css?family=Rubik Mono One' rel='stylesheet'> 
    
        <!-- My JQuery script-->
        <script src="myJQuery.js" ></script>
        

</head>
<body>
<div class="indexbody">
        <div class="sidenav" id="side">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
            <a href="index.php" id="home"><i class="fa fa-fw fa-home"></i>Dashboard</a>
            <a href="#" id="fees"><i class="fa fa-dollar"></i>Fees</a>
                    <p id="drp1">
                        <a href="#">Fee Statement</a>
                        <a href="#">Fee Structure</a>
                        <a href="#">Fee balance</a>
                    </p>
            <a href="#" id="exam"><i class='fa fa-clone'></i>Exams Results</a>
                    <p id="drp2">
                        <a href="#">Form 1</a>
                        <a href="#">Form 2</a>
                        <a href="#">Form 3</a>
                        <a href="#">Form 4</a>
                        <a href="#">Compiled</a>
                    </p>
            <a href="#" id="academics"><i class='fa fa-certificate'></i>Academics</a>
                    <p id="drp3">
                        <a href="#">Exam Timetable</a>
                        <a href="#">Past Papers</a>
                        <a href="#">Class Timetable</a>
                    </p>
            <a href="#"><i class="fa fa-american-sign-language-interpreting"></i>FAQs</a>
            <a href="#"><i class="fa fa-fw fa-envelope"></i>Contacts</a>
            <a href="#" id="psw" data-toggle="modal" data-target="#myModal" onclick="closeNav()"><i class='fa fa-cog'></i>Reset Password</a>
            
            
        </div>
        
        <!-- Navigation Bar-->
    <div class="header">
        <div class="menu">
            <button class="openbtn" onclick="openNav()">☰</button>
        </div>
        <div class="welcome">
            <p><b>ABC Boys'</b></P><hr>
            <P><b>Students' Portal</b></P>

        </div>
        <div class="logout">
            <button><a href="logout.php"><i class="fa fa-fw fa-user"></i>Log Out</a></button>

        </div>
    </div>
        <!-- End of Navigation Bar-->

        <!-- Start of Notices-->
    <div class="notices">
        <div class="term">
            <h3>Term Updates</h3>
            <p>Current Term: Term 1 2020</p>
            <p>Term Start: 01 January 2020</p>
            <p>Term End: 01 April 2020</p>
            <p>Exam Start: 18 March 2020</p>

        </div>
        <div class="fees">
            <h3>Fees Payment</h3>
            <p>Term Fees: Ksh. 18 700.00</p>
            <p>Term Paid: Ksh. 18 700.00</p>
            <p>Term Balance: Ksh. 18 700.00</p>
            <p>Fee A/C Number: 110110110110110 KCB bank, Meru Branch</p>

        </div>
        <div class="downloads">
            <h3>Student  Downloads</h3>  
            <a href="#">Fee Structure</a><br>
            <a href="#">2019 KCSE Results</a><br>
            <a href="#">Closing Update</a><br>
            <a href="#">Timetable</a><br>

        </div>
    </div>


        <!-- main section-->
    <div class="mainSection">
        <div class="profile">
            <?php
                if($image == ""){
                    $image = "uploads/default.png";
                }
            ?>    
            <img id="img" src="<?php echo $image; ?>"  ><hr> <span style="align-self: center">
                <button class="btn btn-info btn-sm" id="dpChange" >Update Profile Picture</button><hr>
                <form action="dp.php" method="post" class="dpChange" enctype="multipart/form-data" >
                <input type="file" name="fileToUpload" id="fileToUpload" >
                <button type="submit" name="submit" value="update" class="btn btn-success">Update</button>

            </form>
            </span><br>
            
            
                <button class="btn btn-info bt-lg profileItems">Personal Information</button><hr>
                <p class="profileItems"> Name: <?php echo $fname; echo " "; echo $mname; echo " "; echo $lname; ?></p>
                <p class="profileItems"> Adm NO: <?php echo ($_SESSION['id']); ?></p>
            <div class="edit">
                <p class="profileItems"> DoB: <?php echo $dob; ?></p>
                <p class="profileItems"> Email: <?php echo $email; ?></p>
                <p class="profileItems"> Mobile: <?php echo $phone; ?></p>
                <p class="profileItems"> Parent Email: <?php  ?></p>
                <p class="profileItems"> Parent Mobile: <?php  ?></p>
                <p class="profileItems"> County: <?php echo $county; ?></p>
                <button  id="edit" class="btn btn-info btn-sm">Update Personal Info</button>
            </div>
            <div class="editform">
                <hr><button class="btn btn-primary bt-lg" >Edit Profile</button><hr>
            <form action="profile.php" method="POST" name="profile" onsubmit="return validate();">
                
                <label>Date of Birth<span class="tab"><input type="date" id="dob" name="dob" placeholder="<?php echo $dob; ?>"></label><br>
                <label>Email Address<span class="tab"><input type="email" id="email_s" name="email_s" placeholder="<?php echo $email; ?>"></label><br>
                <label>Mobile Number<span class="tab"><input type="tel" id="mobile_s" name="mobile_s" placeholder="<?php echo $phone; ?>"></label><br>
                <label>Parent Email<span class="tab"><input type="email" id="email_p" name="email_p" placeholder="<?php echo ""; ?>"></label><br>
                <label>Parent Mobile<span class="tab"><input type="tel" id="mobile_p" name="mobile_p" placeholder="<?php echo ""; ?>"></label><br>
                <label>County<span class="tab"><input type="text" id="county" name="county" placeholder="<?php echo $county; ?>"><hr></label><br>
                <p id="errors"></p>
                <button type="submit" class="btn btn-success" name="update" value="submit">Update</button>
                
            </form> 
            <button style="float: right;" id="editCancel" class="btn btn-warning">Cancel Edit</button>
            </div>

        </div>
        <div class="news">
            <h3>Student Notice Board</h3><hr>
            <h4>Parent Meeting</h4>
            <p><b>Parents meeting schedured on 03 March 2019. 
                Though the administration has put all efforts to make sure that every parent id up to date, 
                you are required to communicate and remind them. See  more</b></p><hr>
            <h4>Parent Meeting</h4>
            <p><b>Parents meeting schedured on 03 March 2019. 
            Though the administration has put all efforts to make sure that every parent id up to date, 
            you are required to communicate and remind them. See  more</b></p><hr>
            <h4>Parent Meeting</h4>
            <p><b>Parents meeting schedured on 03 March 2019. 
            Though the administration has put all efforts to make sure that every parent id up to date, 
            you are required to communicate and remind them. See  more</b></p>
            <button><a href="#">See Older Notices</a></button>

        </div>
    </div>

    <!--Footer section-->
    <div class="footer">
        <p>Designed by High Tech Inc.&trade;</p>
        <p> ABC Boys' High, &copy <?php echo date("Y");?></p>

    </div>
</div>

        <div class="modal fade" id="myModal" role="dialog">
            <?php require_once ("password.php") ?>
        </div>



        <!--js section-->

        <script src="myJS.js" ></script>

</body>
</html>