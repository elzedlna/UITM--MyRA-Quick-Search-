<?php
session_start();
if(!isset($_SESSION['userlogged']) || $_SESSION['userlogged'] !=1) {
  header("Location: login.php");
}
if($_SESSION['USER_ROLE'] != 2) {
  header("Location: home.php");
}

$conn = mysqli_connect("localhost", "root", "", "myra");
if($conn-> connect_error){
    die("Connection failed::". $conn-> connect_error);
}

$token = mysqli_real_escape_string($conn,$_GET['id']);
$sql = "SELECT * FROM section WHERE stoken = '".$token."'";
$result = $conn->query($sql);
$row = mysqli_fetch_assoc($result);
if($row) {
  $section_order = $row['section_order'];
  $section_malay = $row['section_malay'];
  $section_desc = $row['section_desc'];
  $section_english = $row['section_english'];
} else {
  header("Location: sections.php?restrict");
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
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit Section</li>
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
            <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Edit Section</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="peditsection.php?id=<?php echo $token?>" method="post">
                <div class="card-body">
                  <div class="form-group">
                    <label for="section_order">Section Order</label>
                    <input type="text" class="form-control" style="width:4em" id="section_malay" name="section_malay" value="<?php echo $section_order; ?>" disabled>
                  </div>
                  <div class="form-group">
                    <label for="section_malay">Section (Malay)</label>
                    <input type="text" class="form-control" id="section_malay" name="section_malay" value="<?php echo $section_malay; ?>">
                  </div>
                  <div class="form-group">
                    <label for="section_english">Section (English)</label>
                    <input type="text" class="form-control" id="section_english" name="section_english" value="<?php echo $section_english; ?>">
                  </div>
                  <div class="form-group">
                    <label for="section_desc">Section Description</label>
                    <textarea class="form-control" rows="5" id="summernote" name="section_desc" style="resize:none"><?php echo $section_desc; ?></textarea>
                  </div>
                </div>
                <!-- /.card-body -->
                <!-- <script type="text/javascript">document.getElementById("back").onclick = function(){location.href = "sections.php";};</script> -->

                <div class="card-footer">
                  <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal-primary">Submit</button>
                  <button id="cancel" class="btn btn-default" >Cancel</button>
                </div>

                <div class="modal fade" id="modal-primary">
                  <div class="modal-dialog">
                    <div class="modal-content bg-secondary">
                      <div class="modal-header">
                        <h4 class="modal-title">Edit Section</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p>Do you want to proceed?</p>
                      </div>
                      <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                        <button type="submit" id="submit" name="submit" class="btn btn-outline-light">Submit</button>
                      </div>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
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



  <footer class="main-footer">
    <!--
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>-->
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- modal -->

<div class="modal fade" id="error">
  <div class="modal-dialog">
      <div class="modal-content bg-danger">
          <div class="modal-header">
              <h4 class="modal-title">Error</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <p>Update was unsuccessful.</p>
          </div>
          <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
          </div>
      </div>
  </div>
</div>

<div class="modal fade" id="nodata">
    <div class="modal-dialog">
        <div class="modal-content bg-danger">
            <div class="modal-header">
                <h4 class="modal-title">Something went wrong...</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Section titles are empty.</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
  </div>

<!-- /modal -->


<?php include('scripts.php');?>

<!-- page script -->

<?php if (isset($_GET['editfail'])){ ?>
    <script type="text/javascript">
    $(document).ready(function(){
        $("#error").modal("show");
    });
    </script>
<?php } ?>
<?php if (isset($_GET['empty'])){ ?>
    <script type="text/javascript">
    $(document).ready(function(){
        $("#nodata").modal("show");
    });
    </script>
<?php } ?>

</body>
</html>
