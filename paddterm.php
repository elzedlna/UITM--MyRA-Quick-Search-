<?php
session_start();
include("connection.php");
include("functions.php");
date_default_timezone_set("Asia/Kuala_Lumpur");
if(isset($_POST['submit'])) {
    $term_order = $_POST['term_order'];
    $term_m = $_POST['term_malay'];
    $term_e = $_POST['term_english'];
    $term_desc = $_POST['term_desc'];
    $Cdate = getTimestamp();
    $Update = getTimestamp();
    $subsection_no = $_POST['subsection_no'];
    $user_id = $_SESSION['USER_ID'];
    $token = generateToken(10);

    $sql = "INSERT INTO term(term_order, term_malay, term_english, term_desc, date_created, subsection_no, USER_ID, ttoken) VALUES('".$term_order."','".$term_m."','".$term_e."','".$term_desc."','".$Cdate."','".$subsection_no."','".$user_id."','".$token."')";

    if ($conn->query($sql) === TRUE) {
        echo "<script type= 'text/javascript'>alert('New record successfully saved');</script> ";
        header("Location: terms.php");
    } else {
        echo "<script type= 'text/javascript'>alert('Record unsuccessfully saved);</script> ";
    }
} else {
    header("Location: terms.php");
}
?>