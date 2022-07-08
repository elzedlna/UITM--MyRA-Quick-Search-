<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MyRA Quick Search</title>
  <?php include('stylelinks.php')?>

</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
      <li class="nav-item d-none d-sm-inline-block">
        <a href="login.php" class="nav-link">Log in</a>
      </li>
    </ul>
</nav>
  <!-- /.navbar -->
<div>
  <div class="wrapper">
    <!-- Main content -->
    <section class="content" style="margin-top:10%">
        <div class="container-fluid">
            <h2 class="text-center display-4">MyRA QuickSearch</h2>
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <form action="simple-results.html">
                        <div class="input-group">
                            <input type="search" class="form-control form-control-lg" placeholder="Type your keywords here">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-lg btn-default">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
  </div>
</div>
<div class="modal fade" id="logout">
  <div class="modal-dialog">
    <div class="modal-content bg-secondary">
      <div class="modal-header">
        <h4 class="modal-title">Logout</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>You have successfully logged out.</p>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php include('scripts.php');?>

<!-- page script -->
<?php if (isset($_GET['logout'])){ ?>
    <script type="text/javascript">
    $(document).ready(function(){
        $("#logout").modal("show");
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
