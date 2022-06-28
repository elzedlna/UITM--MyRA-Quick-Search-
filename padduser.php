<?php
session_start();
include("connection.php");
include("functions.php");
date_default_timezone_set("Asia/Kuala_Lumpur");
if(isset($_POST['submit'])) {
    // $USER_NAME = $_POST['USER_NAME'];
    $USER_ID = $_POST['USER_ID'];
    $role_no = $_POST['role_no'];
    $access_no = $_POST['access_no'];
    $assigned_date = getTimestamp();
    // $Update = getTimestamp();
    // $token = generateToken(10);
    // $user_id = $_SESSION['USER_ID'];

    $sql = "INSERT INTO user_assigned (USER_ID, role_no, access_no, assigned_date) VALUES('".$USER_ID."','".$role_no."','".$access_no."','".$assigned_date."')";
    $result = mysqli_query($conn,$sql);

    if ($result == TRUE) {
        echo "<script type= 'text/javascript'>alert('New record successfully saved');window.location='users.php';</script> ";
    } else {
        echo "<script type= 'text/javascript'>alert('Record unsuccessfully saved);</script> ";
    }
} else {
    header("Location: users.php");
}
?>