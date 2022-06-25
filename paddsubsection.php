<?php
session_start();
include("connection.php");
include("functions.php");
date_default_timezone_set("Asia/Kuala_Lumpur");

$section_no = $_POST['section_no'];
$subsection_order = $_POST['subsection_order'];
$subsection_m = $_POST['subsection_malay'];
$subsection_e = $_POST['subsection_english'];
$subsection_desc = $_POST['subsection_desc'];
$Cdate = getTimestamp();
// $section_no = getSectionNo($conn,$section_order);
$user_id = $_SESSION['USER_ID'];
$token = generateToken(10);

$sql = "INSERT INTO subsection(subsection_order,subsection_malay, subsection_english, subsection_desc, date_created, section_no, USER_ID, token) VALUES('".$subsection_order."','".$subsection_m."','".$subsection_e."','".$subsection_desc."','".$Cdate."','".$section_no."','".$user_id."','".$token."')";

if ($conn->query($sql) === TRUE) {
    echo "<script type= 'text/javascript'>alert('New record successfully saved');</script> ";
    header("Location: subsections.php");
} else {
    echo "<script type= 'text/javascript'>alert('Record unsuccessfully saved);</script> ";
}

?>
<?php
/*   
  // Connect to database 
  $con = mysqli_connect("localhost","root","","ispgroupproject");
    
  // mysqli_connect("servername","username","password","database_name")
 
  // Get all the categories from category table
  $sql = "SELECT * FROM `sections`";
  $all_sections = mysqli_query($con,$sql);
 
  // The following code checks if the submit button is clicked 
  // and inserts the data in the database accordingly
  if(isset($_POST['submit']))
  {
      // Store the Category ID in a "id" variable
      $id = mysqli_real_escape_string($con,$_POST['sectionsID']); 
       
      // Creating an insert query using SQL syntax and
      // storing it in a variable.
      $sql_insert = "INSERT INTO subsections (subsectionsNo, subsections_title_malay, subsections_title_eng, subsections_gen_note, sectionsID) VALUES ('".$_POST["subsectionsNo"]."','".$_POST["subsections_title_malay"]."','".$_POST["subsections_title_eng"]."','".$_POST["subsections_gen_note"]."',$id)";
      
         
        // The following code attempts to execute the SQL query
        // if the query executes with no errors 
        // a javascript alert message is displayed
        // which says the data is inserted successfully
        if(mysqli_query($con,$sql_insert))
        {
          echo "<script type= 'text/javascript'>alert('New record successfully saved');</script> ";
        }
        else
        {
          echo "<script type= 'text/javascript'>alert('Record unsuccessfully saved);</script> ";
        }
  } */
?>