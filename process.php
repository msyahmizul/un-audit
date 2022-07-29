<?php
require_once('include/connect_db.php');
require_once('include/helper.php');
if (!isset($_SESSION['usn'])) {
    header('location:login.php?error=5');
}

//  redirect to home no direct access of file
if ($_SERVER['REQUEST_METHOD'] === 'GET' || !isset($_POST["form_type"])) {
    header('location:index.php');
}

// add staff form
if ($_POST["form_type"] == 'add_staff') {
    //print("<pre>" . print_r($_POST, true) . "</pre>");
    $status = add_staff($_POST["no_pekerja"], $_POST["kod_gred_jawatan"], $_POST["nama_staff"], $_POST["nama_jawatan"], $_POST["email"], $_POST["fakulti"]);
    if ($status) {
        header('location:index.php?success_message=1');
    } else {
        header('location:index.php');
    }
}

// edit staff form
if ($_POST["form_type"] == "edit_audit") {
    print("<pre>" . print_r($_POST, true) . "</pre>");
}

header('location:index.php');