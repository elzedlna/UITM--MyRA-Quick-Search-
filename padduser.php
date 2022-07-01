<?php
session_start();
include("connection.php");
include("functions.php");
date_default_timezone_set("Asia/Kuala_Lumpur");
if(isset($_POST['submit'])) {
    $USER_ID = $_SESSION['id'];
    $role_no = $_POST['role_no'];
    $access_no = $_POST['access_no'];
    $assigned_date = getTimestamp();
    $token = generateToken(10);

    function checkUser($conn,$USER_ID) {
        $found = false;
        $sql = "SELECT USER_ID FROM user_assigned WHERE USER_ID = '".$USER_ID."'";
        $qry = mysqli_query($conn,$sql);
        $row = mysqli_num_rows($qry);
    
        if($row > 0) {
          $found = true;
        }
        return $found;
    }

    try {
        if(checkUser($conn,$USER_ID) == TRUE) {
            echo "<script type= 'text/javascript'>alert('User already exists.');window.location='adduser.php';</script> ";
        } else {
            if(isset($_SESSION['id']) && $_SESSION['id'] != NULL) {
                $sql = "INSERT INTO user_assigned (USER_ID, role_no, access_no, assigned_date, utoken) VALUES('".$USER_ID."','".$role_no."','".$access_no."','".$assigned_date."','".$token."')";
                $result = mysqli_query($conn,$sql);

                if ($result == TRUE) {
                    echo "<script type= 'text/javascript'>alert('New user successfully assigned.');window.location='users.php';</script> ";
                } else {
                    echo "<script type= 'text/javascript'>alert('Role assign was unsuccessful.');</script> ";
                }

                $_SESSION['id'] = "";
                $_SESSION['name'] = "";
            }
        }
    } catch (Exception $e) { echo "Error!: ". $e->getMessage(). "<br>"; die();}

    
} else {
    header("Location: users.php");
}
?>