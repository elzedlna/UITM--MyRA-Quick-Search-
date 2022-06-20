<?php
include("connection.php");
include("functions.php");
date_default_timezone_set("Asia/Kuala_Lumpur");

$term_m = $_POST['term_malay'];
$term_e = $_POST['term_english'];
$term_desc = $_POST['term_desc'];
$Cdate = getTimestamp();
$Update = getTimestamp();
$subsection_no = $_POST['subsection_no'];
$user_id = session_id();
$token = generateToken(10);

$sql = "INSERT INTO term(term_no, term_malay, term_english, term_desc, date_created, date_updated, subsection_no, USER_ID, token) VALUES(null,'$term_m','$term_e','$term_desc','$Cdate',null,'$subsection_no','$user_id','$token')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>