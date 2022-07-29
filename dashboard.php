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

          <style type="text/css">
            tr#tiada td
            {
              background-color: #f1a9a0;
            }
          </style>

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
                    <h1 class="h3 mb-2 text-gray-800">Audit</h1>
                    <a href="admin/print_pdfAll.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" style="float: right;" target="_blank"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
         
              <a href="dashboard.php?filter=desktop pc" class="btn btn-info btn-icon-split" style="font-size: 12px;">
                    <span class="icon text-white-50">
                      <i class="fas fa-arrow-right"></i>
                    </span>
                    <span class="text">DESKTOP PC</span>
              </a>

              <a href="dashboard.php?filter=laptop" class="btn btn-info btn-icon-split" style="font-size: 12px;">
                    <span class="icon text-white-50">
                      <i class="fas fa-arrow-right"></i>
                    </span>
                    <span class="text">LAPTOP</span>
              </a>

              <a href="dashboard.php?filter=server pc" class="btn btn-info btn-icon-split" style="font-size: 12px;">
                    <span class="icon text-white-50">
                      <i class="fas fa-arrow-right"></i>
                    </span>
                    <span class="text">SERVER PC</span>
              </a>

              <a href="dashboard.php" class="btn btn-info btn-icon-split" style="font-size: 12px;">
                    <span class="icon text-white-50">
                      <i class="fas fa-arrow-right"></i>
                    </span>
                    <span class="text">ALL</span>
              </a>

              <br><br>

          <!--content-->
          <div class="col">

                     <div class="card shadow mb-4">
                        <div class="card-header py-3">
                          <h6 class="m-0 font-weight-bold text-gray-800">Rekod</h6>
                        </div>
                        <div class="card-body">
                          <div class="table-responsive">
                            <table class="table-bordered" id="dataTable" width="100%" style="margin-bottom: 20px;">
                              
                              <thead>
                                <tr class="bg-gray-200">
                                 <th style="width: 5%;">No</th>
                                  <th>Staff ID</th>
                                  <th style="width: 25%;">Nama Staff</th>
                                  <th style="width: 25%;">Fakulti</th>
                                  <th>Tarikh</th>
                                  <th>Masa</th>
                                  <th style="width: 10%;">Action</th>
                                </tr>
                              </thead>

                              <tfoot>
                                <tr class="bg-gray-200">
                                  <th>No</th>
                                 <th>Staff ID</th>
                                  <th>Nama Staff</th>
                                  <th>Fakulti</th>
                                  <th>Tarikh</th>
                                  <th>Masa</th>
                                  <th>Action</th>
                                </tr>
                              </tfoot>

                              <tbody>
                                <?php

                                include("include/connect_db.php");

                                $year=date("Y");

                                if (isset($_GET['filter'])) {
                                  $filter=$_GET['filter'];

                                   $sql = "SELECT * ,date(timestamp),time(timestamp),year(timestamp) FROM audit_pc_staff  INNER JOIN senarai_staff ON audit_pc_staff.no_pekerja_fk = senarai_staff.no_pekerja WHERE audit_pc_staff.jenis_alatan LIKE '%$filter%' AND year(`timestamp`)='$year' ORDER BY `audit_pc_staff`.`timestamp` ASC ";


                                }else{                          

                                $sql = "SELECT * ,date(timestamp),time(timestamp),year(timestamp) FROM audit_pc_staff  INNER JOIN senarai_staff ON audit_pc_staff.no_pekerja_fk = senarai_staff.no_pekerja WHERE year(`timestamp`)='$year'  ORDER BY `audit_pc_staff`.`timestamp` ASC ";
                              }

                                $result = mysqli_query($conn, $sql); //rs.open sql,con
                                  $rownumber = 0;
                                while ($row = mysqli_fetch_array($result))
                                      { 
                                        $rownumber = $rownumber+1;
                                        if ($row['jenis_alatan']=='TIADA') {
                                           $id_css='tiada';
                                        }
                                        else
                                        {
                                          $id_css='';
                                        }
                                ?>
                              
                                <tr class="text-gray-900" id="<?php echo $id_css; ?>">
                                  <td><?php echo $rownumber; ?></td>
                                  <td><?php echo $row['no_pekerja_fk']; ?></td>
                                  <td><?php echo $row['nama']; ?></td>
                                  <td><?php echo $row['FAKULTI']; ?></td>
                                  <td><?php

                                  $date = $row['date(timestamp)']; 
                                  echo date('d-M-Y', strtotime($date));
                                  ?>
                                    
                                  </td>
                                  <td><?php

                                  $time = $row['time(timestamp)']; 
                                  echo date('g:i a', strtotime($time));
                                  ?></td>
                                  <td style="padding-left: 1%">
                                    <a href="displayaudit.php?NoAudit=<?php echo $row['bil_audit']; ?>" style="text-decoration: none;">
                                      <i class="far fa-eye" style="color: black"></i> 
                                    </a> &nbsp;
                                    <a href="downloadpdf.php?download=<?php echo $row['bil_audit']; ?>" style="text-decoration: none;" target="_blank">
                                      <i class="far fa-file-pdf" style="color: black"></i>
                                    </a> &nbsp;
                                    <!--<a href="#" style="text-decoration: none;">
                                      <i class="far fa-trash-alt" style="color: black"></i> 
                                    </a> &nbsp;-->
                                  </td>
                                </tr>

                              <?php } ?>
                              </tbody>
                            </table>
                          </div>
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
