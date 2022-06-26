<?php
session_start();
include("connection.php");
include("functions.php");
date_default_timezone_set("Asia/Kuala_Lumpur");
if(isset($_POST['submit'])) {
    $section_m = $_POST['section_malay'];
    $section_e = $_POST['section_english'];
    $section_desc = $_POST['section_desc'];
    $Update = getTimestamp();
    $token = $_GET['id'];

    $sql = "UPDATE section SET section_malay = '".$section_m."', section_english = '".$section_e."', section_desc = '".$section_desc."', date_updated = '".$Update."' WHERE stoken = '".$token."'";

    if ($conn->query($sql) === TRUE) {
        echo "<script type= 'text/javascript'>alert('Record successfully updated');</script> ";
        header("Location: sections.php");
    } else {
        echo "<script type= 'text/javascript'>alert('Update unsuccessful);</script> ";
    }
} else {
    header("Location: sections.php");
}
?>