<?php
// check login
require_once('include/helper.php');
if (!isset($_SESSION['usn'])) {
    header('location:login.php?error=5');
}
if (isset($_GET['nostaf'])) {
    $result_staff = get_audit_record($_GET['nostaf']);
    $staff_data = get_staff_info($_GET['nostaf']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Audit System</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="icon" type="image/png" href="images/UTMLOGO.png"/>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
          rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body id="page-top">
<!-- Page Wrapper -->
<div id="wrapper">
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
            <?php include 'include/topbar_staf.php'; ?>
            <!-- Begin Page Content -->
            <div class="container-fluid" style="height: 410px;">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Audit PC</h1>
                </div>
                <div class="d-flex justify-content-center">
                    <div class="col-lg-8">
                        <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->
                            <div class="d-flex justify-content-center">
                                <div class="card-header py-3 flex-row align-items-center justify-content-between">
                                    <?php if (isset($staff_data) && $staff_data): ?>
                                        <h6 class="m-0 font-weight-bold text-gray-800 text-center">No Pekerja
                                            : <?= $staff_data["NO_PEKERJA"]; ?></h6>
                                        <h6 class="m-0 font-weight-bold text-gray-800 text-center">Nama Staff
                                            : <?= $staff_data["NAMA"]; ?>
                                        </h6>
                                    <?php else: ?>
                                        <div class="alert alert-primary" role="alert">
                                            Staff id missing
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="d-flex justify-content-center">
                                        <table class="table-bordered" id="dataTable" width="80%"
                                               style="margin-bottom: 20px;font-size: 13px;">
                                            <thead>
                                            <tr class="bg-gray-200">
                                                <th style="width: 5%;">No</th>
                                                <th style="width: 25%;">Lokasi</th>
                                                <th>Jenis Alatan</th>
                                                <th>Tarikh</th>
                                                <th>Masa</th>
                                                <th style="width: 10%;">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php if (isset($result_staff) && $result_staff): ?>
                                                <?php foreach ($result_staff as $key => $row): ?>
                                                    <?php $hashedKey = hash_primary_key($row['REKOD_PK']); ?>
                                                    <tr>
                                                        <td><?= $key + 1 ?></td>
                                                        <td><?= $row['LOKASI'] ?></td>
                                                        <td><?= $row['JENIS_ALATAN'] ?></td>
                                                        <td><?= $row['DATE_AUDITED'] ?></td>
                                                        <td><?= $row['TIME_AUDITED'] ?></td>
                                                        <td>
                                                            <a href="edit_rekod.php?NoAudit=<?= $hashedKey ?>"
                                                               style="text-decoration: none;">
                                                                <i class="far fa-edit" style="color: black"></i>
                                                            </a>&nbsp;
                                                            <a href="process.php?deleteRecord=<?= $hashedKey ?>"
                                                               style="text-decoration: none;">
                                                                <i class="far fa-trash-alt" style="color: black"></i>
                                                            </a>

                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <?php if (isset($_GET['nostaf'])): ?>
                                        <a class="btn" href="audit_pc.php?nostaf=<?= $_GET['nostaf'] ?>"
                                           style="background-color:#7befb2;color:black;float: right;">
                                            <span class=text>Audit</span></a>
                                    <?php endif; ?>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>


                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
        </div>
        <!-- End of Content Wrapper -->
        <?php include 'include/footer.php'; ?>
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
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>
</html>
