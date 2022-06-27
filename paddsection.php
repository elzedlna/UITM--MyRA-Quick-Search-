<?php
session_start();
include("connection.php");
include("functions.php");
date_default_timezone_set("Asia/Kuala_Lumpur");
if(isset($_POST['submit'])) {
    $section_order = $_POST['section_order'];
    $section_m = $_POST['section_malay'];
    $section_e = $_POST['section_english'];
    $section_desc = $_POST['section_desc'];
    $Cdate = getTimestamp();
    $Update = getTimestamp();
    $token = generateToken(10);
    $user_id = $_SESSION['USER_ID'];

    $sql = "INSERT INTO section(section_order, section_malay, section_english, section_desc, USER_ID, stoken)VALUES('".$section_order."','".$section_m."','".$section_e."','".$section_desc."','".$user_id."','".$token."')";
    
    $sql2 = "SELECT * FROM section WHERE stoken = '$token'";
    $result2 = mysqli_query($conn,$sql2);
    $row = mysqli_fetch_assoc($result2);
    
    $sql3 = "INSERT INTO section_history (section_no, USER_ID, sec_process) VALUES ('".$row['section_no']."', '".$user_id."', 'ADD')";
    $result3 = mysqli_query($conn,$sql3);

    if ($conn->query($sql) === TRUE) {
        echo "<script type= 'text/javascript'>alert('New record successfully saved');</script> ";
        header("Location: sections.php");
    } else {
        echo "<script type= 'text/javascript'>alert('Record unsuccessfully saved);</script> ";
    }
} else {
    header("Location: sections.php");
}
?>