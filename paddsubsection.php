<?php
session_start();
include("connection.php");
include("functions.php");
date_default_timezone_set("Asia/Kuala_Lumpur");
if(isset($_POST['submit'])) {
  $section_no = $_POST['section_no'];
  $subsection_order = $_POST['subsection_order'];
  $subsection_m = $_POST['subsection_malay'];
  $subsection_e = $_POST['subsection_english'];
  $subsection_desc = $_POST['subsection_desc'];
  $Cdate = getTimestamp();
  // $section_no = getSectionNo($conn,$section_order);
  $user_id = $_SESSION['USER_ID'];
  $token = generateToken(10);

  $sql = "INSERT INTO subsection(subsection_order,subsection_malay, subsection_english, subsection_desc, date_created, section_no, USER_ID, sbtoken) VALUES('".$subsection_order."','".$subsection_m."','".$subsection_e."','".$subsection_desc."','".$Cdate."','".$section_no."','".$user_id."','".$token."')";

  if ($conn->query($sql) === TRUE) {
      echo "<script type= 'text/javascript'>alert('New record successfully saved');</script> ";
      header("Location: subsections.php");
  } else {
      echo "<script type= 'text/javascript'>alert('Record unsuccessfully saved);</script> ";
  }
} else {
  header("Location: subsections.php");
}
?>
