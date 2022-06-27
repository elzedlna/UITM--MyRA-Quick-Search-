<?php
session_start();
include("connection.php");
include("functions.php");
date_default_timezone_set("Asia/Kuala_Lumpur");
if(isset($_POST['submit'])) {
  $subsection_m = $_POST['subsection_malay'];
  $subsection_e = $_POST['subsection_english'];
  $subsection_desc = $_POST['subsection_desc'];
  $Update = getTimestamp();
  $token = $_GET['id'];
  $user_id = $_SESSION['USER_ID'];
  
  $sql = "UPDATE subsection SET subsection_malay = '".$subsection_m."', subsection_english = '".$subsection_e."', subsection_desc = '".$subsection_desc."', date_updated = '".$Update."' WHERE sbtoken = '".$token."'";

  $sql2 = "SELECT * FROM subsection WHERE sbtoken = '$token'";
  $result2 = mysqli_query($conn,$sql2);
  $row = mysqli_fetch_assoc($result2);
  
  $sql3 = "INSERT INTO subsection_history (subsection_no, USER_ID, subs_process) VALUES ('".$row['subsection_no']."', '".$user_id."', 'EDIT')";
  $result3 = mysqli_query($conn,$sql3);


  if ($conn->query($sql) === TRUE) {
      echo "<script type= 'text/javascript'>alert('Record updated successfully');</script> ";
      header("Location: subsections.php");
  } else {
      echo "<script type= 'text/javascript'>alert('Update unsuccessful);</script> ";
  }
} else {
  header("Location: subsections.php");
}
?>
