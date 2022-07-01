<?php
session_start();
include("connection.php");
include("functions.php");
date_default_timezone_set("Asia/Kuala_Lumpur");
if(isset($_POST['submit'])) {
    $role_no = $_POST['role_no'];
    $access_no = $_POST['access_no'];
    $update = getTimestamp();
    $token = $_GET['id'];
    try {
        $sql = "UPDATE user_assigned SET role_no = '".$role_no."', access_no = '".$access_no."', assigned_updated = '".$update."' WHERE utoken = '".$token."'";
        $result = mysqli_query($conn,$sql);

        if ($result == TRUE) {
            echo "<script type= 'text/javascript'>alert('Record successfully updated');window.location='users.php';</script> ";
        } else {
            echo "<script type= 'text/javascript'>alert('Update unsuccessful);</script> ";
        }
    } catch (Exception $e) { echo "Error!: ". $e->getMessage(). "<br>"; die();}  
} else {
    header("Location: users.php");
}
?>