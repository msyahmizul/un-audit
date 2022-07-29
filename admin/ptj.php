<?php
require_once(dirname(__DIR__) . '\include\helper.php');
if (!isset($_SESSION['usn'])) {
    header('location:../login.php?error=5');
}

if ($_SESSION["role"] == 2) {
    header('location:../index.php');
}

$ptj_data = get_ptj_data();
?>
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
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="icon" type="image/png" href="../images/UTMLOGO.png"/>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
          rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/stepform.css">
</head>
<body id="page-top">
<!-- Page Wrapper -->
<div id="wrapper">
    <!-- SIDEBAR-->
    <?php require_once dirname(__DIR__) . '\include\sidebar.php'; ?>
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
            <?php require_once dirname(__DIR__) . '\include\topbar.php'; ?>
            <!-- Begin Page Content -->

            <div class="container-fluid">

                <!-- Page Heading -->
                <h1 class="h3 mb-4 text-gray-800">PTJ</h1>

                <!--content-->
                <div class="row">

                    <div class="col-lg-4">

                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-gray-800">Daftar PTJ</h6>
                            </div>
                            <div class="card-body">
                                <form id="regForm" action="process_form.php" method="POST">
                                    <div class="form-group row">
                                        <label for="inputLokasi"
                                               class="col-sm-3 col-md-2 col-form-label">Kod PTJ</label>
                                        <div class="col-sm-9 col-md-10">
                                            <input type="text" name="kod_ptj" class="form-control" id="inputLokasi"
                                                  required >
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputLokasi"
                                               class="col-sm-3 col-md-2 col-form-label">Nama PTJ</label>
                                        <div class="col-sm-9 col-md-10">
                                            <input type="text" name="nama_ptj" class="form-control" id="inputLokasi" required>
                                        </div>
                                    </div>

                                    <button type="submit" name="form_type" value="ptj"
                                            class="btn btn-success">Submit
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">

                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-gray-800">Rekod</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table-bordered" id="dataTable" width="100%"
                                           style="margin-bottom: 20px;">
                                        <thead>
                                        <tr class="bg-gray-200">
                                            <th style="width: 15%;">Kod PTJ</th>
                                            <th>PTJ</th>
                                            <th style="width: 10%;">Action</th>
                                        </tr>
                                        </thead>

                                        <tfoot>
                                        <tr class="bg-gray-200">
                                            <th>Kod PTJ</th>
                                            <th>PTJ</th>
                                            <th>Action</th>
                                        </tr>
                                        </tfoot>

                                        <tbody>
                                        <?php foreach ($ptj_data as $ptj): ?>
                                            <tr>
                                                <td><?= $ptj["KOD_FAKULTI"] ?></td>
                                                <td><?= $ptj["NAMA_FAKULTI"] ?></td>

                                                <td>
                                                    <a onclick="alert('Are you sure to delete this data ?')"
                                                       href="process.php?deleteptj=<?php echo $row['kod_ptj']; ?>">
                                                        <i class="far fa-trash-alt" style="color: black"></i>
                                                    </a>
                                                </td>

                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
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
        <?php require_once dirname(__DIR__) . '\include\footer.php'; ?>
    </div>
    <!-- End of Page Wrapper -->

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/datatables-demo.js"></script>

</body>
</html>
