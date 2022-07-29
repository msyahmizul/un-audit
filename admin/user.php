<?php
require_once(dirname(__DIR__) . '\include\helper.php');
if (!isset($_SESSION['usn'])) {
    header('location:../login.php?error=5');
}

if ($_SESSION["role"] == 2) {
    header('location:../index.php');
}

$pop_data = get_ptj_data();
$pop_user_staff = get_user_staff();
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
    <link rel="stylesheet" type="text/css" href="../css/stepform.css">
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
                <h1 class="h3 mb-4 text-gray-800">User</h1>

                <!--content-->
                <div class="row">
                    <div class="col-12">
                        <div class="card shadow mb-12">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-gray-800">Rekod</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table-bordered" id="dataTable" width="100%"
                                           style="margin-bottom: 20px;">
                                        <thead>
                                        <tr class="bg-gray-200">
                                            <th style="width: 20%;">Num</th>
                                            <th>Username</th>
                                            <th>No Pekerja</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Fakulti</th>
                                            <th style="width: 20%;">Action</th>
                                        </tr>
                                        </thead>
                                        <tfoot>
                                        <tr class="bg-gray-200">
                                            <th>Num</th>
                                            <th>Username</th>
                                            <th>No Pekerja</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Fakulti</th>
                                            <th>Action</th>
                                        </tr>
                                        </tfoot>

                                        <tbody>
                                        <?php foreach ($pop_user_staff as $index => $staff): ?>
                                            <tr>
                                                <td><?= $index + 1 ?></td>
                                                <td><?= $staff['USERNAME'] ?></td>
                                                <td><?= $staff['NO_PEKERJA'] ?></td>
                                                <td><?= $staff['FIRST_NAME'] .' '. $staff['LAST_NAME'] ?></td>
                                                <td><?= $staff['EMAIL'] ?></td>
                                                <td><?= $staff['FAKULTI'] ?></td>
                                                <td>
                                                    <?php //TODO : Add edit & delete function?>
                                                    <a onclick="alert('Are you sure to delete this data ?')"
                                                    href="#">
                                                    <i class="far fa-trash-alt"></i>
                                                    </a>
                                                    &nbsp;
                                                    <!--<a onclick="alert('')"-->
                                                    <!--href="#">-->
                                                    <!--<i class="far fa-edit"></i>-->
                                                    <!--</a>-->
                                                </td>


                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-12">
                        <br>
                    </div>
                    <div class="col-12">


                        <div class="card shadow">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-gray-800">Daftar User</h6>
                            </div>
                            <div class="card-body">
                                <form action="process_form.php" method="POST">
                                    <div class="form-group row">
                                        <label for="no_pekerja"
                                               class="col-sm-2 col-md-4 col-form-label">No Pekerja</label>
                                        <div class="col-sm-10 col-md-8">
                                            <input type="text" name="no_pekerja" class="form-control" id="no_pekerja"
                                                   required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputLokasi"
                                               class="col-sm-3 col-md-4 col-form-label">Username</label>
                                        <div class="col-sm-9 col-md-8">
                                            <input type="text" name="username" class="form-control" id="inputLokasi"
                                                   required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputLokasi"
                                               class="col-sm-3 col-md-4 col-form-label">Password</label>
                                        <div class="col-sm-9 col-md-8">
                                            <input type="password" name="password" class="form-control" id="inputLokasi"
                                                   required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputLokasi"
                                               class="col-sm-3 col-md-4 col-form-label">First Name</label>
                                        <div class="col-sm-9 col-md-8">
                                            <input type="text" name="first_name" class="form-control" id="inputLokasi"
                                                   required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputLokasi"
                                               class="col-sm-3 col-md-4 col-form-label">Last Name</label>
                                        <div class="col-sm-9 col-md-8">
                                            <input type="text" name="last_name" class="form-control" id="inputLokasi"
                                                   required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputLokasi"
                                               class="col-sm-3 col-md-4 col-form-label">Email</label>
                                        <div class="col-sm-9 col-md-8">
                                            <input type="email" name="email" class="form-control" id="inputLokasi"
                                                   required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputLokasi" class="col-sm-3 col-form-label">Fakulti</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="fakulti" required>
                                                <?php foreach ($pop_data as $fakulti): ?>
                                                    <?php $hash_value = hash_primary_key($fakulti['FAKULTI_PK']) ?>
                                                    <option value="<?= $hash_value ?>"><?= $fakulti['KOD_FAKULTI'] ?>
                                                        - <?= $fakulti['NAMA_FAKULTI'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <button type="submit" name="form_type" value="add_user"
                                            class="btn btn-success">Submit
                                    </button>
                                </form>
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
