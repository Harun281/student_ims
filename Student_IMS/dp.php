

<?php
    session_start();

    // Check if the user is already logged in, if no then redirect him to log in page
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: login.php");
        exit;
    }

require_once ("db.php");
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        //echo "File is an image - " . $check["mime"] . ".";
        //echo "<script>alert('File is an image - " . $check["mime"] . ".'); window.location='index.php'</script>";
        $uploadOk = 1;
    } else {
        echo "<script>alert('File selected is not an image'); window.location='index.php'</script>";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "<script>alert('Sorry.file already exists'); window.location='index.php'</script>";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 1000000) {
    echo "<script>alert('sorry. file too large. Should be < 1mb'); window.location='index.php'</script>";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.'); window.location='index.php'</script>";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "<script>alert('Sorry, your file was not uploaded.'); window.location='index.php'</script>";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

        $id = ($_SESSION["id"]);
        $sql = "UPDATE studentdetails SET imagename = '$target_file' WHERE Adm = '$id'";
        $result = mysqli_query($conn, $sql);
        if($result){
        //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        echo "<script>alert('Profile picture updated successfully'); window.location='index.php'</script>";
        }
    } else {
        echo "<script>alert('Sorry, there was an error uploading your file.'); window.location='index.php'</script>";
    }
}
mysqli_close($conn);
?>
