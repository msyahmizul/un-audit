<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Administrator</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link rel="icon" type="image/png" href="images/UTMLOGO.png"/>
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/stepform.css">
</head>

          <?php
          session_start();
          if(!isset($_SESSION['pwd']) && !isset($_SESSION['usn']))
          {
            header('location:login_admin.php');
          }
          ?>

<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">
<!-- SIDEBAR-->   
<?php include'include/sidebar.php';?>
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
      <div id="content">
        <?php include'include/topbar.php';?>
        <!-- Begin Page Content -->

         <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Setting</h1>

          <!--content-->
                <?php
                include 'include/connect_db.php';
                        $name=$_SESSION['usn'];

                $query = "SELECT * FROM admin WHERE admin_id='$name'";
                $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
                $row = mysqli_fetch_array($result) or die(mysqli_error($conn));
                ?>

          <div class="card shadow mb-4">
            <div class="card-body">
              <h4 class="mb-4 text-gray-800">Profile Setting</h4>

<form id="regForm" action="process.php" style="width: 70%;" method="POST">
  <!-- One "tab" for each step in the form: -->
  <div>
    Admin ID:
    <p><input oninput="this.className = ''" name="adminid" value="<?php echo $row['admin_ID']?>" style="border: none;border-bottom: 1px solid grey;"></p>
    Password:
    <p><input type="password" oninput="this.className = ''" name="pass" value="<?php echo $row['admin_password']?>" onmousedown="this.type='text'" onmouseup="this.type='password'" onmousemove="this.type='password'" style="border: none;border-bottom: 1px solid grey;"></p>
    Name:
    <p><input oninput="this.className = ''" name="admin" value="<?php echo $row['admin_nama']?>" style="border: none;border-bottom: 1px solid grey;"></p>  
    <input type="hidden" name="id" value="<?php echo $row['admin_ID']?>">
    </div>
  <div style="overflow:auto;">
    <div>
      <input type="submit" name="updateadmin" value="Update Profile" class="btn btn-danger">
    </div>
  </div>

</form>

            </div>
          </div>

        </div>

        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content --><?php include'include/footer.php';?>
    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>
</html>
