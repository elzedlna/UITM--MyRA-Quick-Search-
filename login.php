<!DOCTYPE html>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include("connection.php");
include("functions.php");
if(isset($_POST['login'])) {
  $USER_ID = mysqli_real_escape_string($conn,$_POST['USER_ID']);
  $USER_PASSWORD = mysqli_real_escape_string($conn,$_POST['USER_PASSWORD']);
  
  // i-staff portal api
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt_array($curl, array(
    CURLOPT_PORT => "444",
    CURLOPT_URL => "https://integrasi.uitm.edu.my:444/stars/login/json/".$USER_ID,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "{\n\t\"password\": \"".$USER_PASSWORD."\"\n}",
    CURLOPT_HTTPHEADER => array(
      "cache-control: no-cache",
      "postman-token: a5f640ca-aedf-6572-f4ef-b6ae06cad9eb",
      "token: eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyIjoiY2xhc3Nib29raW5nIn0._dTe9KRNSHSBMybfC4Gs6Brv6vO2HxQ8CWp9lOtI0hk"
    ),
  ));
  
  $response = curl_exec($curl);
  $err = curl_error($curl);
  
  curl_close($curl);
  
  $json = json_decode($response, TRUE);
  
  if($json['status'] == "true")
  {
       $sql3 = "SELECT * FROM user_assigned ua JOIN user u ON ua.USER_ID = u.USER_ID JOIN user_role ur ON ua.role_no = ur.role_no WHERE u.USER_ID = '".$USER_ID."' AND ua.access_no=1";
      echo $sql3;
      $qry3 = mysqli_query($conn,$sql3);
      $row3 = mysqli_num_rows($qry3);
      if($row3 > 0)
      {
          $re2 = mysqli_fetch_assoc($qry3);
          session_start();
          $_SESSION['USER_ID'] = $USER_ID;
          $_SESSION['USER_NAME'] = $re2['USER_NAME'];
          $_SESSION['USER_ROLE'] = $re2['role_no'];
          $_SESSION['USER_ROLENAME'] = $re2['role_name'];
          header("Location: home.php");
      } 
  } else if($json['status'] == "false") {
    //header("Location: login.php?error");
    echo "tak ok";
  }
  // end i-staff portal api 
}
?>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MyRA Quick Search</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <!--<link rel="stylesheet" type="text/css" href="style.css">-->
  <!-- <script src="https://kit.fontawesome.com/e138785ca7.js" crossorigin="anonymous"></script> -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="search.php"><b>MyRA</b> Quick Search</a>
  </div>
  
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in using your <strong>UiTM i-Staff Portal</strong> to begin the session.</p>
      <div style="text-align: center; margin-bottom:10px">
        <img src="myralogo.png" alt="Myra Logo" class="brand-image img-circle elevation-3;" style="opacity: .9; width: 150px;" >
      </div>
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <div class="input-group-mb-3">
          <input type="text" name="USER_ID" class="form-control" placeholder="Staff ID" required>
        </div>
        <div class="input-group-mb-3" style="margin-top:10px" id="show_hide_user_password">
          <input type="password" name="USER_PASSWORD" class="form-control" placeholder="Password" required>
        </div>
        <div class="col-5" style="margin-top:10px">
          <button type="submit" name="login" class="btn btn-primary">Sign in</button>
        </div>
      </form>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
<div class="modal fade" id="modal-error">
  <div class="modal-dialog">
    <div class="modal-header">
      <h4 class="modal-title">Warning</h4>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <p>Unable to log into the system. Please check your Staff No and user_password.</p>
    </div>
    <div class="modal-footer justify-content-between">
      <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
    </div>
  </div>
  <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->


<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- page script -->
<?php if (isset($_GET['error'])){ ?>
    <script type="text/javascript">
    $(document).ready(function(){
        $("#modal-error").modal("show");
    });
    </script>
<?php } ?>
<?php if (isset($_GET['warning'])){ ?>
    <script type="text/javascript">
    $(document).ready(function(){
        $("#modal-warning").modal("show");
    });
    </script>
<?php } ?>
<script>
$(document).ready(function() {
    $("#show_hide_user_password a").on('click', function(event) {
        event.preventDefault();
        if($('#show_hide_user_password input').attr("type") == "text"){
            $('#show_hide_user_password input').attr('type', 'user_password');
            $('#show_hide_user_password i').addClass( "fa-eye" );
            $('#show_hide_user_password i').removeClass( "fa-eye-slash" );
        }else if($('#show_hide_user_password input').attr("type") == "user_password"){
            $('#show_hide_user_password input').attr('type', 'text');
            $('#show_hide_user_password i').removeClass( "fa-eye" );
            $('#show_hide_user_password i').addClass( "fa-eye-slash" );
        }
    });
});    
</script>
</body>
</html>
