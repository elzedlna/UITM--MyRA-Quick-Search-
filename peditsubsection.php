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

  $sql = "UPDATE subsection SET subsection_malay = '".$subsection_m."', subsection_english = '".$subsection_e."', subsection_desc = '".$subsection_desc."', date_updated = '".$Update."' WHERE sbtoken = '".$token."'";

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
