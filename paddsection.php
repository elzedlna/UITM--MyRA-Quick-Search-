<?php
include("connection.php");
include("functions.php");
date_default_timezone_set("Asia/Kuala_Lumpur");

$section_order = $_POST['section_order'];
$section_m = $_POST['section_malay'];
$section_e = $_POST['section_english'];
$section_desc = $_POST['section_desc'];
$Cdate = getTimestamp();
$Update =getTimestamp();
$token = generateToken(10);
$user_id = session_id();

$sql = "INSERT INTO section(section_no, section_order, section_malay, section_english, section_desc, date_created, date_updated, USER_ID, token)VALUES(null,' $section_order ', '$section_m',' $section_e', '$section_desc', '$Cdate', null, '$user_id',' $token')";

if ($conn->query($sql) === TRUE) {
    echo "<script type= 'text/javascript'>alert('New record successfully saved');</script> ";
    header("Location: sections.php");
} else {
    echo "<script type= 'text/javascript'>alert('Record unsuccessfully saved);</script> ";
}


?>