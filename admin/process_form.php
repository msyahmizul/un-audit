<?php
require_once(dirname(__DIR__) . '\include\helper.php');
if (!isset($_SESSION['usn'])) {
    header('location:login.php?error=5');
}

//  redirect to home no direct access of file
if ($_SERVER['REQUEST_METHOD'] === 'GET' || !isset($_POST["form_type"])) {
    header('location:index.php');
}

// add CPU
if ($_POST["form_type"] == "processor") {
    $status = add_cpu($_POST["processor"]);
    if ($status) {
        header('location:processor.php');
    } else {

        header('location:processor.php?error');
    }
}

// Add OS
if ($_POST["form_type"] == "os") {
    $status = add_os($_POST["os"]);
    if ($status) {
        header('location:os.php');
    } else {

        header('location:os.php?error');
    }

}

// Add PTj

if ($_POST["form_type"] == "ptj") {
    $status = add_ptj($_POST["kod_ptj"], $_POST["nama_ptj"]);
    if ($status) {
        header('location:ptj.php');
    } else {

        header('location:ptj.php?error');
    }


}

if ($_POST["form_type"] == "add_user") {
    var_dump($_POST);
    $secure_password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $status = add_user($_POST["no_pekerja"], $_POST["username"], $secure_password, $_POST["first_name"], $_POST["last_name"], $_POST["email"], $_POST["fakulti"]);
    echo $status;
    if ($status) {
        header('location:user.php');
    } else {

        header('location:user.php?error');
    }


}

//header('location:index.php');