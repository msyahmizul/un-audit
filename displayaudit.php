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
          <h1 class="h3 mb-2 text-gray-800"><a href="dashboard.php" style="text-decoration: none;" class="text-gray-800">Audit</a> / Rekod Audit</h1>
          
          <!--content-->
          <div class="col">

                     <div class="card shadow mb-4">
                        <div class="card-header py-3">
                          <h6 class="m-0 font-weight-bold text-gray-800">Rekod</h6>
                        </div>
                        <div class="card-body">

                          <center><u><h5>MAKLUMAT SEMAKAN KONDISI KOMPUTER</h5></u>
                          <table width="100%">
                            <?php
                            $Audit=$_GET['NoAudit'];

                            $sql = "SELECT * ,date(timestamp),time(timestamp) FROM audit_pc_staff  INNER JOIN senarai_staff ON audit_pc_staff.no_pekerja_fk = senarai_staff.no_pekerja WHERE bil_audit='$Audit'  ORDER BY `audit_pc_staff`.`timestamp` ASC ";
                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_array($result)
                            ?>
                            <tr>
                              <td>No . Staff : <u style="text-decoration-style: dotted;"><?php echo $row['no_pekerja_fk']; ?></u></td>
                              <td>Nama Staff : <u style="text-decoration-style: dotted;"><?php echo $row['nama']; ?></u></td>
                            </tr>
                            <tr>
                              <td>Kod PTJ : <u style="text-decoration-style: dotted;"><?php echo $row['kod_ptj']; ?></u></td>
                              <td>Jenis Alatan : <u style="text-decoration-style: dotted;"><?php echo $row['jenis_alatan']; ?></u></td>
                            </tr>
                            <tr>
                              <td colspan="2">Lokasi : <u style="text-decoration-style: dotted;"><?php echo $row['lokasi']; ?></u></td>
                            </tr>
                            <tr>
                              <td>No. Siri CPU: <u style="text-decoration-style: dotted;"><?php echo $row['siri_cpu']; ?></u></td>
                              <td>No. Siri Monitor : <u style="text-decoration-style: dotted;"><?php echo $row['siri_monitor']; ?></u></td>
                            </tr>
                            <tr>
                              <td>No. Daftar Harta UTM : <u style="text-decoration-style: dotted;"><?php echo $row['daftar_harta_utm']; ?></u></td>
                              <td>Peruntukan : <u style="text-decoration-style: dotted;"><?php echo $row['peruntukan']; ?></u></td>
                            </tr>
                            <tr>
                              <td>Jenama / Model Komputer : <u style="text-decoration-style: dotted;"><?php echo $row['jenama_komputer']; ?></u></td>
                              <td>Tahun Beli : <u style="text-decoration-style: dotted;"><?php echo $row['tahun_beli']; ?></u></td>
                            </tr>

                          </table>

                          <hr>
                         </center>

                         <h6><b>Status Spesifikasi CPU :-</b></h6>

                         <table width="100%" border="1">

                           <tr>
                             <td width="5%"><center>1 .</center></td>
                             <td>Processor :</td>
                             <td><?php echo $row['processor_cpu'] ?></td>
                             <td width="5%"><center>5 .</center></td>
                             <td>Graphic Card/Display :</td>
                             <td width="6%"><?php echo $row['graphic_card'] ?></td>
                             <td width="5%"><center>9 .</center></td>
                             <td>No I.P(Server) :</td>
                             <td width="15%"><?php echo $row['server_ip'] ?></td>
                           </tr>

                           <tr>
                             <td><center>2 .</center></td>
                             <td>Hard Disk Storage :</td>
                             <td><?php echo $row['hard_disk_storage'] ?></td>
                             <td><center>3 .</center></td>
                             <td>Sound :</td>
                             <td><?php echo $row['sound'] ?></td>
                             <td><center>10 .</center></td>
                             <td>Operating System :</td>
                             <td><?php echo $row['os'] ?></td>
                           </tr>

                           <tr>
                             <td><center>3 .</center></td>
                             <td>Memory RAM :</td>
                             <td><?php echo $row['memory_ram'] ?></td>
                             <td><center>7 .</center></td>
                             <td>Network Card (NIC) :</td>
                             <td><?php echo $row['network_card'] ?></td>
                           </tr>

                           <tr>
                             <td><center>4 .</center></td>
                             <td>DVD-ROM :</td>
                             <td><?php echo $row['dvd_rom'] ?></td>
                             <td><center>8 .</center></td>
                             <td>Keyboard/Mouse :</td>
                             <td><?php echo $row['keyboard_mouse'] ?></td>
                           </tr>
                         </table>
                         <br>
                         Tujuan / Tugasan : <?php echo $row['skop_tugas'] ?>

                         <br><br>
                         <i><p style="font-size: 11px;float: right;">Disemak oleh <?php echo $row['staff_semakan'] ?><br>
                          Tarikh : <?php

                                  $date = $row['date(timestamp)']; 
                                  echo date('d-M-Y', strtotime($date));
                                  ?><br>
                                Masa : <?php

                                  $time = $row['time(timestamp)']; 
                                  echo date('g:i a', strtotime($time));
                                  ?></p>

                         </i>

                        </div>
                      </div>

          </div>
        <!-- /.container-fluid -->
          </div>
          <!-- End of Main Content -->
        </div>
        <!-- End of Content Wrapper -->
    <?php include'include/footer.php';?>
      </div>
  <!-- End of Page Wrapper -->

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>

</body>
</html>
