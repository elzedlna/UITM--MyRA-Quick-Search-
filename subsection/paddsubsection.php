<?php
include("connection.php");
include("functions.php");
date_default_timezone_set("Asia/Kuala_Lumpur");

$section_order = $_POST['section_order'];
$subsection_m = $_POST['subsection_malay'];
$subsection_e = $_POST['subsection_english'];
$subsection_desc = $_POST['subsection_desc'];
$Cdate = getTimestamp();
$Update =getTimestamp();
// $section_no = getSectionNo($conn,$section_order);
$section_no = 1;
$token = generateToken(10);
$user_id = session_id();

$sql = "INSERT INTO subsection(subsection_no, subsection_malay, subsection_english, subsection_desc, date_created, date_updated, section_no, USER_ID, token) VALUES(null,'$subsection_m','$subsection_e','$subsection_desc','$Cdate',null,'$section_no','$user_id','$token')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

/* function getSectionNo($conn, $section_order) {
    $data = ["section_order" => $section_order];
    $sql = "SELECT section_no FROM section WHERE section_order = :section_order";
    $stmt = $conn->prepare($sql);
    $stmt->execute($data);
    $section = $stmt->fetch(PDO::FETCH_ASSOC);
    echo $section;
} */
?>