<?php
require_once('include/connect_db.php');
require_once('include/helper.php');
// check login
if (!isset($_SESSION['usn'])) {
    header('location:login.php?error=5');
}
if (isset($_GET['NoAudit'])) {
    $pop_data = populate_input_data();
    $auditData = get_audit_data($_GET['NoAudit']);

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
    <link rel="stylesheet" type="text/css" href="css/stepform.css">

</head>
<body id="page-top">
<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->

        <div id="content">
            <?php include 'include/topbar_staf.php'; ?>
            <div id="vue_app">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-header py-3 flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-gray-800 text-center">No Pekerja
                                : <?= $auditData["NO_PEKERJA"] ?></h6>
                            <h6 class="m-0 font-weight-bold text-gray-800 text-center">Nama Staff
                                : <?= $auditData['NAMA'] ?></h6>
                        </div>
                        <div class="card-body">
                            <form action="process.php" method="post">
                                <input type="hidden" name="audit_id" value="<?= $_GET['NoAudit'] ?>">
                                <input type="hidden" name="form_type" value="edit_audit">
                                <h3 class="text-center">Semakan Komputer</h3>
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group row">
                                            <label for="inputLokasi"
                                                   class="col-sm-3 col-md-2 col-form-label">Lokasi</label>
                                            <div class="col-sm-9 col-md-10">
                                                <input type="text" name="lokasi" class="form-control" id="inputLokasi"
                                                       value="<?= $auditData['LOKASI'] ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group row">
                                            <label for="inputLokasi" class="col-sm-3 col-form-label">Jenis
                                                Peralatan</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="jenis_alatan">
                                                    <option value="0">Tiada</option>
                                                    <?php foreach ($pop_data['jenis_alatan'] as $jenis_alatan): ?>
                                                        <?php $hash_value = hash_primary_key($jenis_alatan['PARAM_PK']) ?>
                                                        <?php if ($jenis_alatan['PARAM_PK'] == $auditData['JENIS_ALATAN']): ?>
                                                            <option selected
                                                                    value="<?= $hash_value ?>"><?= $jenis_alatan['NAME_PARAMETER'] ?></option>
                                                        <?php else: ?>
                                                            <option value="<?= $hash_value ?>"><?= $jenis_alatan['NAME_PARAMETER'] ?></option>
                                                        <?php endif; ?>

                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group row">
                                            <label for="inputLokasi"
                                                   class="col-sm-3 col-md-2 col-form-label">Jenama</label>
                                            <div class="col-sm-9 col-md-10">
                                                <select class="form-control" name="jenama_alatan">
                                                    <option value="0">Tiada</option>

                                                    <?php foreach ($pop_data['jenama'] as $jenama): ?>
                                                        <?php $hash_value = hash_primary_key($jenama['PARAM_PK']) ?>
                                                        <?php if ($jenama['PARAM_PK'] == $auditData["JENAMA_ALATAN"]): ?>
                                                            <option selected
                                                                    value="<?= $hash_value ?>"><?= $jenama['NAME_PARAMETER'] ?></option>
                                                        <?php else: ?>
                                                            <option value="<?= $hash_value ?>"><?= $jenama['NAME_PARAMETER'] ?></option>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group row">
                                            <label for="inputPeruntukan"
                                                   class="col-sm-3 col-form-label">Peruntukan </label>
                                            <div class="col-sm-9">
                                                <input type="text" name="peruntukan" class="form-control"
                                                       value="<?= $auditData['PERUNTUKAN'] ?>"
                                                       id="inputPeruntukan">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group row">
                                            <label for="inputPTahun"
                                                   class="col-sm-3 col-md-2 col-form-label">Tahun</label>
                                            <div class="col-sm-9 col-md-10">
                                                <input type="number" name="tahun" class="form-control" id="inputPTahun"
                                                       value="<?= $auditData['TAHUN_BELI'] ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group row">
                                            <label for="inputSiriCpu" class="col-sm-3 col-form-label">No Siri
                                                Cpu</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="siri_cpu" class="form-control"
                                                       id="inputSiriCpu" value="<?= $auditData['SIRI_CPU'] ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group row">
                                            <label for="inputSiriMonitor" class="col-sm-3 col-md-2 col-form-label">No
                                                Siri
                                                Monitor</label>
                                            <div class="col-sm-9 col-md-10">
                                                <input type="text" name="siri_monitor" class="form-control"
                                                       id="inputSiriMonitor" value="<?= $auditData['SIRI_MONITOR'] ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group row">
                                            <label for="inputDaftarHarta" class="col-sm-3 col-form-label">No Daftar
                                                Harta UTM</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="daftar_harta_utm" class="form-control"
                                                       id="inputDaftarHarta"
                                                       value="<?= $auditData['DAFTAR_HARTA_UTM'] ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h3 class="text-center">Spesifikasi Komputer</h3>
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group row">
                                            <label for="inputLokasi"
                                                   class="col-sm-3 col-md-2 col-form-label">Processor </label>
                                            <div class="col-sm-9 col-md-10">
                                                <select class="form-control" name="cpu">
                                                    <option value="0">Tiada</option>
                                                    <?php foreach ($pop_data['cpu'] as $cpu): ?>
                                                        <?php $hash_value = hash_primary_key($cpu['PARAM_PK']) ?>
                                                        <?php if ($cpu["PARAM_PK"] == $auditData["CPU_PROCESSOR"]): ?>
                                                            <option selected
                                                                    value="<?= $hash_value ?>"><?= $cpu['NAME_PARAMETER'] ?></option>
                                                        <?php else: ?>
                                                            <option value="<?= $hash_value ?>"><?= $cpu['NAME_PARAMETER'] ?></option>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group row">
                                            <label for="storage" class="col-sm-3 col-md-4 col-form-label">Hard Disk
                                                (GB)</label>
                                            <div class="col-sm-9 col-md-8">
                                                <input type="number" name="storage" class="form-control"
                                                       id="storage" value="<?= $auditData['STORAGE'] ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group row">
                                            <label for="ram" class="col-sm-3 col-form-label">RAM (GB)</label>
                                            <div class="col-sm-9">
                                                <input type="number" name="ram" class="form-control"
                                                       id="ram" value="<?= $auditData['RAM'] ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group row">
                                            <label for="inputLokasi" class="col-sm-4 col-form-label">Operating
                                                System</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" name="os">
                                                    <option value="0">Tiada</option>
                                                    <?php foreach ($pop_data['os'] as $os): ?>
                                                        <?php $hash_value = hash_primary_key($os['PARAM_PK']) ?>
                                                        <?php if ($os["PARAM_PK"] == $auditData["OS"]): ?>
                                                            <option selected
                                                                    value="<?= $hash_value ?>"><?= $os['NAME_PARAMETER'] ?></option>
                                                        <?php else: ?>
                                                            <option value="<?= $hash_value ?>"><?= $os['NAME_PARAMETER'] ?></option>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>

                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group row">
                                            <label for="graphic" class="col-sm-4 col-form-label">Grpahic Card</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" name="graphic">
                                                    <option value="0">Tiada</option>
                                                    <?php foreach ($pop_data['graphic'] as $graphic): ?>
                                                        <?php $hash_value = hash_primary_key($graphic['PARAM_PK']) ?>
                                                        <?php if ($graphic["PARAM_PK"] == $auditData["GRAPHIC_CARD"]): ?>
                                                            <option selected
                                                                    value="<?= $hash_value ?>"><?= $graphic['NAME_PARAMETER'] ?></option>

                                                        <?php else: ?>
                                                            <option value="<?= $hash_value ?>"><?= $graphic['NAME_PARAMETER'] ?></option>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>

                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group row">
                                                    <label for="serverIp" class="col-sm-3 col-form-label">Server
                                                        IP</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="server" class="form-control"
                                                               placeholder="For Server Only"
                                                               id="serverIp" value="<?= $auditData['SERVER_IP'] ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="skop_tugas_masalah">Skop Tugas / Masalah</label>
                                            <textarea class="form-control" id="skop_tugas_masalah"
                                                      name="skop_tugas_masalah"
                                                      rows="3"><?= $auditData['CATATAN'] ?></textarea>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6">
                                        <p>Tick Jika ada</p>
                                        <div class="custom-control custom-checkbox">
                                            <input <?= $auditData['DVD_ROM'] == 53 ? 'checked' : null ?> type="checkbox"
                                                                                                         class="custom-control-input"
                                                                                                         id="check_dvd"
                                                                                                         name="check_dvd">
                                            <label class="custom-control-label" for="check_dvd">DVD ROM</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="check_sound"
                                                   name="check_sound" <?= $auditData['SOUND'] == 53 ? 'checked' : null ?>>
                                            <label class="custom-control-label" for="check_sound">Sound</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="check_network"
                                                   name="check_network" <?= $auditData['NETWORK_CARD'] == 53 ? 'checked' : null ?>>
                                            <label class="custom-control-label" for="check_network">Network Card</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="check_keyboard"
                                                   name="check_keyboard" <?= $auditData['KEYBOARD_MOUSE'] == 53 ? 'checked' : null ?>>
                                            <label class="custom-control-label" for="check_keyboard">Keyboard
                                                Mouse</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <br>
                                        <button type="submit" class="btn btn-success">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include 'include/footer.php'; ?>
    </div>


    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

</body>
</html>
