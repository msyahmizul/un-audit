<?php
require_once('include/helper.php');
// check login
if (!isset($_SESSION['usn'])) {
    header('location:login.php?error=5');
}

if (isset($_GET["no_pekerja"])) {
    $result = get_staff_info($_GET["no_pekerja"]);
    if ($result) {
        $status_audit = get_status_audit($_GET["no_pekerja"]);
    }

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
            <?php require_once('include/topbar_staf.php'); ?>
            <!-- Begin Page Content -->
            <div class="container-fluid" style="height: 410px;">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Audit PC</h1>
                </div>

                <!-- Content -->

                <div class="d-flex justify-content-center">
                    <div class="col-xl-4 col-lg-5">
                        <?php if (isset($_GET["success_message"])): ?>
                            <?php if ($_GET["success_message"] == 1): ?>
                                <div class="alert alert-primary" role="alert">
                                    Add Staff Success
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                        <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->
                            <div class="card-header py-3 flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Staff ID</h6><br>

                                <form action="index.php" method="get" type="">
                                    <input type="text" name="no_pekerja" placeholder="No Pekerja"
                                           class="form-control form-control-user" style="margin-bottom: 10px;">
                                    <input type="submit" value="CHECK"
                                           class="btn btn-primary btn-user btn-block">
                                </form>
                            </div>
                            <div class="card-body">
                                <?php if (isset($result)): ?>
                                    <?php if ($result) : ?>
                                        <?php if ($status_audit): ?>
                                            <div class="d-flex justify-content-center">
                                                <div class="alert alert-info" role="alert">
                                                    Staff sudah diaudit
                                                </div>

                                            </div>
                                        <?php endif; ?>
                                        <div class="d-flex justify-content-center">
                                            Nama Staff : <?= $result["NAMA"] ?>
                                        </div>
                                        <br>
                                        <div class="d-flex justify-content-center">
                                            <a class="btn" href="audit_pc.php?nostaf=<?= $result['NO_PEKERJA'] ?>"
                                               style=background-color:#7befb2;color:black;>
                                                <span class=text>Audit</span></a>

                                            &nbsp;&nbsp;&nbsp;

                                            <a class="btn" href="rekod_audit.php?nostaf=<?= $result['NO_PEKERJA'] ?>"
                                               style=background-color:#ffffcc;color:black;>
                                                <span class=text>Rekod Audit</span></a>
                                        </div>
                                    <?php else: ?>
                                        <div class="d-flex justify-content-center">
                                            <p>Tiada Maklumat Pekerja</p>
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <a class="btn" href="add_staf.php"
                                               style=background-color:#f4b350;color:black;>
                                                <span class=text>Add Staff</span></a>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>

                            <!-- Card Body -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once('include/footer.php'); ?>
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
