<?php
session_start();
if(!isset($_SESSION['userlogged']) || $_SESSION['userlogged'] !=1) {
  header("Location: login.php");
}
if($_SESSION['USER_ROLE'] != 1) {
  header("Location: home.php");
}

$conn = mysqli_connect("localhost", "root", "", "myra");
if($conn-> connect_error){
    die("Connection failed::". $conn-> connect_error);
}

$utoken = mysqli_real_escape_string($conn,$_GET['id']);
$sql = "SELECT * FROM user u JOIN user_assigned ua ON u.USER_ID = ua.USER_ID JOIN user_role ur ON ua.role_no = ur.role_no JOIN user_access uc ON ua.access_no = uc.access_no WHERE ua.utoken = '".$utoken."'";
$result = $conn->query($sql);
$row = mysqli_fetch_assoc($result);
if($row) {
  $USER_ID = $row['USER_ID'];
  $USER_NAME = $row['USER_NAME'];
  $role_name = $row['role_name'];
  $access_status = $row['access_status'];
} else {
  header("Location: users.php?restrict");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MyRA Quick Search</title>
  <?php include('stylelinks.php')?>

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div> -->

  <!-- Navbar -->
  <?php include('navbar.php');?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
      <img src="myralogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">MyRA Quick Search</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <a href="" class="d-block">Hi, <?php if(isset($_SESSION['USER_NAME'])) { echo $_SESSION['USER_NAME']; } ?></a>
          <a href="" class="d-block">ROLE: <?php if(isset($_SESSION['USER_ROLENAME'])) { echo $_SESSION['USER_ROLENAME']; } ?></a>
        </div>
      </div>
      <!-- SidebarSearch Form -->
      <!-- Sidebar Menu -->
      <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <?php include('menu.php'); ?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">MyRA Quick Search</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="home.php">Home</a></li>
              <li class="breadcrumb-item active">Users</li>
              <li class="breadcrumb-item active">View User</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
  <!-- /.content-wrapper -->
   <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">User Details</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="padduser.php" method="post">
                <div class="card-body">
                  <div class="form-group">
                    <label for="USER_ID">Staff ID</label>
                    <output class="form-control" id="USER_ID" name="USER_ID" style="width:10em" ><?php echo $USER_ID; ?></output>
                  </div>
                  <div class="form-group">
                    <label for="USER_NAME">Staff Name</label>
                    <output class="form-control" id="USER_NAME" name="USER_NAME"><?php echo $USER_NAME; ?></output>
                  </div>
                  <div class="form-group">
                    <label for="role_no">Role</label>
                    <output class="form-control" id="role_no" name="role_no" style="width:15em" ><?php echo $role_name; ?></output>
                  </div>
                  <div class="form-group">
                    <label for="access_no">Access</label>
                    <output class="form-control" id="access_no" name="access_no" style="width:15em" ><?php echo $access_status; ?></output>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button  id="back" class="btn btn-default">Back</button>
                  <script type="text/javascript">document.getElementById("back").onclick = function(){location.href = "users.php";};</script>
                </div>
              </form>
            </div>
            <!-- /.card -->
            
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



  <!-- footer -->
  <?php include('version.php'); ?>
  <!-- / footer  -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<?php include('scripts.php');?>
<script>
  $(function () {
    // Summernote
    $('#summernote').summernote('disable');  })
</script>
</body>
</html>
