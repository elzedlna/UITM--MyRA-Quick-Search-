<?php
session_start();
include("connection.php");
include("functions.php");
date_default_timezone_set("Asia/Kuala_Lumpur");

$section_order = $_POST['section_order'];
$section_m = $_POST['section_malay'];
$section_e = $_POST['section_english'];
$section_desc = $_POST['section_desc'];
$Cdate = getTimestamp();
$Update = getTimestamp();
$token = generateToken(10);
$user_id = $_SESSION['USER_ID'];

$sql = "INSERT INTO section(section_order, section_malay, section_english, section_desc, USER_ID, token)VALUES('".$section_order."','".$section_m."','".$section_e."','".$section_desc."','".$user_id."','".$token."')";

if ($conn->query($sql) === TRUE) {
    echo "<script type= 'text/javascript'>alert('New record successfully saved');</script> ";
    header("Location: sections.php");
} else {
    echo "<script type= 'text/javascript'>alert('Record unsuccessfully saved);</script> ";
}
?>