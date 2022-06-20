<?php
include("connection.php");
include("functions.php");
date_default_timezone_set("Asia/Kuala_Lumpur");

$section_order = 'A';
$section_m = $_POST['section_malay'];
$section_e = $_POST['section_english'];
$section_desc = $_POST['section_desc'];
$Cdate = getTimestamp();
$Update =getTimestamp();
$token = generateToken(10);
$user_id = session_id();

$sql = "INSERT INTO section(section_no, section_order, section_malay, section_english, section_desc, date_created, date_updated, USER_ID, token)VALUES(null,' $section_order ', '$section_m',' $section_e', '$section_desc', '$Cdate', null, '$user_id',' $token')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
?>