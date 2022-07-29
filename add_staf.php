<?php
require_once('include/connect_db.php');
require_once('include/helper.php');
// check login
if (!isset($_SESSION['usn'])) {
    header('location:login.php?error=5');
}
$pop_data = populate_fakulti_data();
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
    <link rel="stylesheet" type="text/css" href="css/stepform.css">
</head>

<body id="page-top">
<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->

        <div id="content">
            <?php require_once('include/topbar_staf.php'); ?>

            <div class="container-fluid"
            ">
            <div class="card">
                <div class="card-header py-3 flex-row align-items-center justify-content-between">
                    <h3 class="m-0 font-weight-bold text-gray-800 text-center">Add Staff</h3>
                </div>
                <div class="card-body">
                    <form action="process.php" method="post" onsubmit="return runForm()">
                        <input type="hidden" name="form_type" value="add_staff">
                        <div class="row">

                            <div class="col-sm-12 col-md-6">
                                <div class="form-group row">
                                    <label for="no_pekerja"
                                           class="col-sm-2 col-md-2 col-form-label">No Pekerja</label>
                                    <div class="col-sm-10 col-md-10">
                                        <input type="text" name="no_pekerja" class="form-control" id="no_pekerja" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6">
                                <div class="form-group row">
                                    <label for="kod_gred_jawaran"
                                           class="col-sm-5 col-md-3 col-form-label">Kod Gred Jawatan</label>
                                    <div class="col-sm-7 col-md-9">
                                        <input type="number" name="kod_gred_jawatan" class="form-control"
                                               id="kod_gred_jawatan" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6">
                                <div class="form-group row">
                                    <label for="nama_staff"
                                           class="col-sm-3 col-md-2 col-form-label">Nama</label>
                                    <div class="col-sm-9 col-md-10">
                                        <input type="text" name="nama_staff" class="form-control" id="nama_staff" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6">
                                <div class="form-group row">
                                    <label for="email"
                                           class="col-sm-3 col-md-3 col-form-label">Email</label>
                                    <div class="col-sm-9 col-md-9">
                                        <input type="email" name="email" class="form-control" id="email" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6">
                                <div class="form-group row">
                                    <label for="nama_jawatan"
                                           class="col-sm-3 col-md-2 col-form-label">Nama Jawatan</label>
                                    <div class="col-sm-9 col-md-10">
                                        <input type="text" name="nama_jawatan" class="form-control" id="nama_jawatan" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6">
                                <div class="form-group row">
                                    <label for="inputLokasi" class="col-sm-3 col-form-label">Fakulti</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="fakulti" required>
                                            <option value="0">Select One</option>
                                            <?php foreach ($pop_data['fakulti'] as $fakulti): ?>
                                                <?php $hash_value = hash_primary_key($fakulti['FAKULTI_PK']) ?>
                                                <option value="<?= $hash_value ?>"><?= $fakulti['KOD_FAKULTI'] ?>
                                                    - <?= $fakulti['NAMA_FAKULTI'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-12">
                                &nbsp;&nbsp;<button type="submit" class="btn btn-success">Submit</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    <?php require_once('include/footer.php'); ?>
</div>
<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Vue js and Vuetify -->
<script>
    function runForm() {
        // alert("Test");
        return true;
    }
</script>

</body>
</html>
