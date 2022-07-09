<?php
session_start();
if(!isset($_SESSION['userlogged']) || $_SESSION['userlogged'] !=1) {
  header("Location: login.php");
}
if($_SESSION['USER_ROLE'] != 2) {
  header("Location: home.php?noaccess");
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
  </div>-->

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
              <li class="breadcrumb-item active">Subsections</li>
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
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Sub-Sections</h3>
                <a href="addsubsection.php"><button type="submit" class="card-title btn btn-warning float-right">Add Sub-Section</button></a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Section</th>
                    <th>Sub-Section Order</th>
                    <th>Sub-Section (Malay)</th>
                    <th>Sub-Section (English)</th>
                    <th>Date Created</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    $conn = mysqli_connect("localhost", "root", "", "myra");
                    if($conn-> connect_error){
                        die("Connection failed::". $conn-> connect_error);
                    }

                    $sql = "SELECT sb.USER_ID, sb.subsection_no, s.section_order, s.section_malay, sb.subsection_order, sb.subsection_malay, sb.subsection_english, sb.date_created, sb.sbtoken FROM subsection sb JOIN section s ON s.section_no = sb.section_no WHERE s.date_deleted IS NULL AND sb.date_deleted IS NULL ORDER BY s.section_no, sb.subsection_order ASC";
                    $result = $conn->query($sql);
                    $counter = 1;
                    // $sql1 = "SELECT count(section_no) FROM subsection WHERE section_no =
                    if($result-> num_rows > 0){
                        while ($row = $result-> fetch_assoc()){
                          ?>
                          
                          <tr>
                            <td><?php echo $counter++; ?></td>
                            <td><?php echo $row['section_order']." - ".$row['section_malay']; ?></td>
                            <td><?php echo $row['subsection_order']; ?></td>
                            <td><?php echo $row['subsection_malay']; ?></td>
                            <td><?php echo $row['subsection_english']; ?></td>
                            <td><?php echo $row['date_created']; ?></td>
                            <td>
                              <div class="btn-group">
                                  <button type="button" name="view" id="view" onclick="window.location.href='viewsubsection.php?id=<?php echo $row['sbtoken']; ?>'" class="btn btn-primary btnn-block btn-sm fas fa-eye"></button>
                                  <?php if($row['USER_ID'] == $_SESSION['USER_ID']) { ?>
                                  <button type="button" name="edit" id="edit" onclick="window.location.href='editsubsection.php?id=<?php echo $row['sbtoken']; ?>'" class="btn btn-secondary btnn-block btn-sm fas fa-edit"></button>
                                  <button type="button" name="delete" id="delete" onclick="window.location.href='deletesubsection.php?id=<?php echo $row['sbtoken']; ?>'" class="btn btn-danger btnn-block btn-sm fas fa-trash-can"></button>
                                  <?php } ?>
                              </div>
                            </td>
                          </tr>
                          <?php
                        }
                    }
                    ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>#</th>
                    <th>Section</th>
                    <th>Sub-Section Order</th>
                    <th>Sub-Section (Malay)</th>
                    <th>Sub-Section (English)</th>
                    <th>Date Created</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <div class="card-footer">
                
              </div>
              <!-- /.card-body -->
            </div>
            
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

<!-- modal -->
<div class="modal fade" id="subadded">
    <div class="modal-dialog">
        <div class="modal-content bg-success">
            <div class="modal-header">
                <h4 class="modal-title">Success!</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>New sub-section has been successfully added!</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
  </div>

  <div class="modal fade" id="subedited">
    <div class="modal-dialog">
        <div class="modal-content bg-secondary">
            <div class="modal-header">
                <h4 class="modal-title">Success!</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Sub-Section has been successfully updated!</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
  </div>

  <div class="modal fade" id="subdeleted">
    <div class="modal-dialog">
        <div class="modal-content bg-danger">
            <div class="modal-header">
                <h4 class="modal-title">Success!</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Sub-Section has been successfully deleted!</p>
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
                <p>No sub-sections were added.</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
  </div>

  <div class="modal fade" id="restricted">
    <div class="modal-dialog">
        <div class="modal-content bg-danger">
            <div class="modal-header">
                <h4 class="modal-title">Something went wrong...</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Wrong sub-section.</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
  </div>
  <!-- /modal  -->
  <?php include('scripts.php');?>

<!-- page script -->
<!-- modal -->
<?php if (isset($_GET['empty'])){ ?>
    <script type="text/javascript">
    $(document).ready(function(){
        $("#nodata").modal("show");
    });
    </script>
<?php } ?>
<?php if (isset($_GET['exists'])){ ?>
    <script type="text/javascript">
    $(document).ready(function(){
        $("#subexists").modal("show");
    });
    </script>
<?php } ?>
<?php if (isset($_GET['added'])){ ?>
    <script type="text/javascript">
    $(document).ready(function(){
        $("#subadded").modal("show");
    });
    </script>
<?php } ?>
<?php if (isset($_GET['edited'])){ ?>
    <script type="text/javascript">
    $(document).ready(function(){
        $("#subedited").modal("show");
    });
    </script>
<?php } ?>
<?php if (isset($_GET['deleted'])){ ?>
    <script type="text/javascript">
    $(document).ready(function(){
        $("#subdeleted").modal("show");
    });
    </script>
<?php } ?>
<?php if (isset($_GET['restrict'])){ ?>
    <script type="text/javascript">
    $(document).ready(function(){
        $("#restricted").modal("show");
    });
    </script>
<?php } ?>
<!-- /modal  -->

<!-- Page specific script -->
<script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>
</body>
</html>
