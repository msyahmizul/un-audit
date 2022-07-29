<?php
require_once('include/helper.php');
require_once('include/connect_db.php');
//print("<pre>" . print_r($_POST, true) . "</pre>");
$status = input_audit_table($_POST["no_pekerja"], $_POST["jenis_alatan"], $_POST["skop_tugas_masalah"]);
echo $_SESSION['usn'];
if ($status) {
    header("location: rekod_audit.php?nostaf=" . $_POST["no_pekerja"]);
    syslog(LOG_INFO, "Add audit no Pekerja : " . $_POST["no_pekerja"] . " , User : " . $_SESSION['usn']);


} else {

    header("location: rekod_audit.php?nostaf=" . $_POST["no_pekerja"] . "&error");

}
