<?php
require_once('include/connect_db.php');
//process login
var_dump($_POST);
if (isset($_POST["username"]) && $_POST["username"] != '' && isset($_POST["password"]) && $_POST["password"] != '') {
    $sql = "SELECT a.USERNAME ,b.PARAM_PK AS USER_ROLE,a.PASSWORD,a.FIRST_NAME
            FROM audit.audit_users a
            INNER JOIN agihan.parameter b ON b.PARAM_PK = a.USER_ROLE AND b.KUMPULAN_FK = 1
            WHERE a.USERNAME = ? AND a.DATE_DELETED IS NULL";
    $stmt = $conn_obj->prepare("SELECT * FROM audit.audit_users a WHERE a.USERNAME = ?");

    $stmt->bind_param("s", $_POST["username"]);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (password_verify($_POST["password"], $row["PASSWORD"])) {
            $_SESSION["usn"] = $row["USERNAME"];
            $_SESSION["first_name"] = $row["FIRST_NAME"];
            $_SESSION["role"] = $row["USER_ROLE"];
            $conn_obj->query("UPDATE audit.audit_users a SET a.DATE_LAST_LOGIN= CURRENT_TIMESTAMP WHERE a.USERNAME = '" . $_SESSION["usn"] . "'");
            $stmt->close();
            header('location:index.php');
        } else {
            // unknown error
            $stmt->close();
            header('location:login.php?error=4');
        }
    } else {
        // user not found
        $stmt->close();
        header('location:login.php?error=3');
    }
} else {
    // invalid methods
    header('location:login.php?error=2');

}
