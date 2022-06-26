<?php
session_start();
include("connection.php");
include("functions.php");
date_default_timezone_set("Asia/Kuala_Lumpur");
if(isset($_POST['submit'])) {
    $term_m = $_POST['term_malay'];
    $term_e = $_POST['term_english'];
    $term_desc = $_POST['term_desc'];
    $Update = getTimestamp();
    $token = $_GET['id'];

    $sql = "UPDATE term SET term_malay = '".$term_m."', term_english = '".$term_e."', term_desc = '".$term_desc."', date_updated = '".$Update."' WHERE ttoken = '".$token."'";

    if ($conn->query($sql) === TRUE) {
        echo "<script type= 'text/javascript'>alert('Record updated successfully');</script> ";
        header("Location: terms.php");
    } else {
        echo "<script type= 'text/javascript'>alert('Update unsuccessful);</script> ";
    }
} else {
    header("Location: terms.php");
}
?>