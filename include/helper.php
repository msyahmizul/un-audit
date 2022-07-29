<?php
require_once(dirname(__DIR__) . '\vendor\Hashids\Hashids.php');
require_once("connect_db.php");
$hashids = new Hashids\Hashids('$2y$10$C2BYskLYwnLpzZt.cm8hROTZPP43imHQLyFT8mAApr9E59eKT.O7C');

// get staff info
function get_staff_info($no_pekerja)
{
    global $conn_obj;
    $sql = "SELECT * FROM staff_utm.staff_data a WHERE a.NO_PEKERJA = ?";
    $stmt = $conn_obj->prepare($sql);
    $stmt->bind_param("s", $no_pekerja);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $stmt->close();
        return $result->fetch_assoc();
    } else {
        return false;
    }
}


// get status of audit
function get_status_audit($no_pekerja)
{
    global $conn_obj;
    $sql = "SELECT * FROM audit.audit_rekod_audit a INNER JOIN staff_utm.staff_data b ON b.NO_PEKERJA = ? WHERE a.STAFF_FK = b.STAFF_PK";
    $stmt = $conn_obj->prepare($sql);
    $stmt->bind_param("s", $no_pekerja);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $stmt->close();
        return true;
    } else {
        return false;
    }
}

// fetch the audit record
function get_audit_record($no_pekerja)
{
    global $conn_obj;
    $sql = "SELECT a.REKOD_PK,
       c.LOKASI,
       d.NAME_PARAMETER                        AS JENIS_ALATAN,
       DATE_FORMAT(a.DATE_AUDITED, '%d/%m/%Y') AS DATE_AUDITED,
       DATE_FORMAT(a.DATE_AUDITED, '%h:%i:%S %p') AS TIME_AUDITED
FROM audit.audit_rekod_audit a
       INNER JOIN staff_utm.staff_data b ON b.NO_PEKERJA = ?
       INNER JOIN audit.audit_alatan_data c ON c.DATA_PK = a.ALATAN_DATA_FK
       INNER JOIN agihan.parameter d ON d.PARAM_PK = a.JENIS_ALATAN
WHERE a.STAFF_FK = b.STAFF_PK";
    $stmt = $conn_obj->prepare($sql);
    $stmt->bind_param("s", $no_pekerja);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $row;
    } else {
        return false;
    }
}

function get_audit_data_admin_page()
{
    global $conn_obj;
    $sql = "SELECT e.NO_PEKERJA,
       e.NAMA,
       f.NAMA_FAKULTI,
       DATE_FORMAT(a.DATE_AUDITED, '%d/%m/%Y')    AS DATE_AUDITED,
       DATE_FORMAT(a.DATE_AUDITED, '%h:%i:%S %p') AS TIME_AUDITED
FROM audit.audit_rekod_audit a
       LEFT JOIN audit.audit_alatan_data b ON b.DATA_PK = a.ALATAN_DATA_FK
       LEFT JOIN audit.audit_spec_alatan c ON c.SPEC_PK = a.SPEC_FK
       LEFT JOIN agihan.parameter d ON d.PARAM_PK = a.JENIS_ALATAN
       INNER JOIN staff_utm.staff_data e ON e.STAFF_PK = a.STAFF_FK
       INNER JOIN staff_utm.staff_fakulti f ON f.FAKULTI_PK = e.FAKULTI_FK
";
    $result = $conn_obj->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_all(MYSQLI_ASSOC);
        return $row;
    } else {
        return false;
    }
}

function get_processor_data()
{
    global $conn_obj;
    $sql = "
SELECT a.PARAM_PK, a.NAME_PARAMETER
FROM agihan.parameter a
WHERE a.KUMPULAN_FK = 8
";
    $result = $conn_obj->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_all(MYSQLI_ASSOC);
        return $row;
    } else {
        return false;
    }
}

function add_cpu($cpu)
{
    global $conn_obj;
    $sql = "INSERT INTO agihan.parameter(KUMPULAN_FK, NAME_PARAMETER, ACTIVE, USERNAME_CREATED) VALUE (8, ?, TRUE, ?)";
    $stmt = $conn_obj->prepare($sql);
    $stmt->bind_param("ss", $cpu, $_SESSION["usn"]);

    if ($stmt->execute()) {
        $stmt->close();
        return true;
    } else {
        echo $conn_obj->error;
        return false;
    }
}

function get_os_data()
{
    global $conn_obj;
    $sql = "
SELECT a.PARAM_PK, a.NAME_PARAMETER
FROM agihan.parameter a
WHERE a.KUMPULAN_FK = 4
";
    $result = $conn_obj->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_all(MYSQLI_ASSOC);
        return $row;
    } else {
        return false;
    }
}

function add_os($OS)
{
    global $conn_obj;
    $sql = "INSERT INTO agihan.parameter(KUMPULAN_FK, NAME_PARAMETER, ACTIVE, USERNAME_CREATED) VALUE (4, ?, TRUE, ?)";
    $stmt = $conn_obj->prepare($sql);
    $stmt->bind_param("ss", $OS, $_SESSION["usn"]);

    if ($stmt->execute()) {
        $stmt->close();
        return true;
    } else {
        echo $conn_obj->error;
        return false;
    }
}

function get_ptj_data()
{
    global $conn_obj;
    $sql = "
SELECT a.KOD_FAKULTI, a.NAMA_FAKULTI,a.FAKULTI_PK
from staff_utm.staff_fakulti a
";
    $result = $conn_obj->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_all(MYSQLI_ASSOC);
        return $row;
    } else {
        return false;
    }
}

function add_ptj($kod_ptj, $nama_ptj)
{
    global $conn_obj;
    $sql = "INSERT INTO staff_utm.staff_fakulti (KOD_FAKULTI, NAMA_FAKULTI) VALUE (?, ?)";
    $stmt = $conn_obj->prepare($sql);
    $stmt->bind_param("ss", $kod_ptj, $nama_ptj);

    if ($stmt->execute()) {
        $stmt->close();
        return true;
    } else {
        echo $conn_obj->error;
        return false;
    }
}

function add_user($no_pekerja, $username, $password, $first_name, $last_name, $email, $fakulti_kod)
{
    global $conn_obj;
    $sql = "
INSERT INTO audit.audit_users(USERNAME, PASSWORD, USER_ROLE, NO_PEKERJA, FIRST_NAME, LAST_NAME, EMAIL, FAKULTI)
SELECT ?,
       ?,
       2,
       ?,
       ?,
       ?,
       ?,
       a.KOD_FAKULTI
FROM staff_utm.staff_fakulti a
WHERE a.FAKULTI_PK = ?
";

    $unhashed_fakulti = unhash_key($fakulti_kod);
    $stmt = $conn_obj->prepare($sql);
    $stmt->bind_param("ssssssi", $username, $password, $no_pekerja, $first_name, $last_name, $email, $unhashed_fakulti);
    echo $conn_obj->error;
    echo $stmt->error;

    if ($stmt->execute()) {
        echo $conn_obj->error;
        echo $stmt->error;
        $stmt->close();
        return true;
    } else {
        echo $conn_obj->error;
        echo $stmt->error;
        return false;
    }
}


// populate from parameter
function populate_input_data()
{
    global $conn_obj;
    $cpu = $conn_obj->query("SELECT a.NAME_PARAMETER, a.PARAM_PK FROM agihan.parameter a WHERE a.KUMPULAN_FK = 8")->fetch_all(MYSQLI_ASSOC);
    $jenis_alatan = $conn_obj->query("SELECT a.NAME_PARAMETER, a.PARAM_PK FROM agihan.parameter a WHERE a.KUMPULAN_FK = 7")->fetch_all(MYSQLI_ASSOC);
    $jenama = $conn_obj->query("SELECT a.NAME_PARAMETER, a.PARAM_PK FROM agihan.parameter a WHERE a.KUMPULAN_FK = 5")->fetch_all(MYSQLI_ASSOC);
    $OS = $conn_obj->query("SELECT a.NAME_PARAMETER, a.PARAM_PK FROM agihan.parameter a WHERE a.KUMPULAN_FK = 4")->fetch_all(MYSQLI_ASSOC);
    $graphic = $conn_obj->query("SELECT a.NAME_PARAMETER, a.PARAM_PK FROM agihan.parameter a WHERE a.KUMPULAN_FK = 9")->fetch_all(MYSQLI_ASSOC);

    $populated_data = array("cpu" => $cpu, "jenis_alatan" => $jenis_alatan, "jenama" => $jenama, 'os' => $OS, "graphic" => $graphic);
    return $populated_data;
}

// poppulate fakulti data
function populate_fakulti_data()
{
    global $conn_obj;
    $fakulti = $conn_obj->query("SELECT a.FAKULTI_PK,a.KOD_FAKULTI,a.NAMA_FAKULTI FROM staff_utm.staff_fakulti a ")->fetch_all(MYSQLI_ASSOC);
    $populate_data = array("fakulti" => $fakulti);
    return $populate_data;
}

function populate_filter_jenis_alatan_data()
{
    global $conn_obj;
    $filter_jenis_alatan = $conn_obj->query("SELECT a.NAME_PARAMETER, a.PARAM_PK FROM agihan.parameter a WHERE a.KUMPULAN_FK = 7")->fetch_all(MYSQLI_ASSOC);
    $populate_data = array("filter_jenis_alatan" => $filter_jenis_alatan);
    return $populate_data;
}

// input_data to spec table
function input_spec_table($cpu_id, $storage, $ram, $graphic, $sound, $network, $keyboard, $server, $dvd_rom, $os_id, $jenama_alatan)
{
    global $conn_obj;
    $sql = "
INSERT INTO audit.audit_spec_alatan(CPU_PROCESSOR, STORAGE, RAM, GRAPHIC_CARD, SOUND, NETWORK_CARD, KEYBOARD_MOUSE,
                                    SERVER_IP, DVD_ROM, OS, JENAMA_ALATAN)
SELECT a.PARAM_PK,
       ?,
       ?,
       b.PARAM_PK,
       c.PARAM_PK,
       d.PARAM_PK,
       e.PARAM_PK,
       ?,
       f.PARAM_PK,
       g.PARAM_PK,
       h.PARAM_PK
FROM agihan.parameter a
       LEFT JOIN agihan.parameter b ON b.PARAM_PK = ?
       LEFT JOIN agihan.parameter c ON c.PARAM_PK = ?
       LEFT JOIN  agihan.parameter d ON d.PARAM_PK = ?
       LEFT JOIN  agihan.parameter e ON e.PARAM_PK = ?
       LEFT JOIN  agihan.parameter f ON f.PARAM_PK = ?
       LEFT JOIN  agihan.parameter g ON g.PARAM_PK = ?
       LEFT JOIN  agihan.parameter h ON h.PARAM_PK = ?
WHERE a.PARAM_PK = ?";
    $stmt = $conn_obj->prepare($sql);
    $unhash_graphic = $graphic != 0 ? unhash_key($graphic) : null;
    $unhash_os = $os_id != 0 ? unhash_key($os_id) : null;
    $unhash_jenama_alatan = $jenama_alatan != 0 ? unhash_key($jenama_alatan) : null;
    $unhash_cpu = $cpu_id != 0 ? unhash_key($cpu_id) : null;

    $check_sound = $sound ? 53 : 54;
    $check_network = $network ? 53 : 54;
    $check_keyboard = $keyboard ? 53 : 54;
    $check_dvd = $dvd_rom ? 53 : 54;

    $stmt->bind_param("sssiiiiiiii",
        $storage, $ram, $server, $unhash_graphic, $check_sound,
        $check_network, $check_keyboard, $check_dvd,
        $unhash_os, $unhash_jenama_alatan, $unhash_cpu);
    if ($stmt->execute()) {
        $stmt->close();
        return $conn_obj->insert_id;
    } else {
        return false;
    }

}

// input_data to alatan data table
function input_alatan_data($lokasi, $siri_cpu, $siri_monitor, $daftar_harta_utm, $peruntukan, $tahun_beli)
{
    global $conn_obj;
    $sql = "
INSERT INTO audit.audit_alatan_data(LOKASI, SIRI_CPU, SIRI_MONITOR, DAFTAR_HARTA_UTM, PERUNTUKAN, TAHUN_BELI)
  VALUE (?, ?, ?, ?, ?, ?)";
    $stmt = $conn_obj->prepare($sql);
    $stmt->bind_param("ssssss", $lokasi, $siri_cpu, $siri_monitor, $daftar_harta_utm, $peruntukan, $tahun_beli);
    if ($stmt->execute()) {
        $stmt->close();
        return $conn_obj->insert_id;
    } else {
        return false;
    }
}


// input_data to audit table
function input_audit_table($no_pekerja, $jenis_alatan, $catatan)
{
    global $conn_obj;
    $jenis_alatan_unhash = $jenis_alatan != 0 ? unhash_key($jenis_alatan) : null;


    $sql = "
    INSERT INTO audit.audit_rekod_audit(STAFF_FK, JENIS_ALATAN, SPEC_FK, ALATAN_DATA_FK, STAFF_SEMAKAN,
                                    CATATAN)
SELECT a.STAFF_PK, b.PARAM_PK, ?, ?, c.USER_ID, ?
FROM staff_utm.staff_data a
       INNER JOIN agihan.parameter b ON b.PARAM_PK = ? AND b.KUMPULAN_FK = 7
       INNER JOIN audit.audit_users c ON c.USERNAME = ?
WHERE a.NO_PEKERJA = ?
    ";
    //function input_spec_table($cpu_id, $storage, $ram, $graphic, $sound, $network, $keyboard, $server, $dvd_rom, $os_id, $jenama_alatan)
    $speck_fk = input_spec_table($_POST["cpu"], $_POST["storage"], $_POST["ram"],
        $_POST["graphic"], isset($_POST["check_sound"]), isset($_POST["check_network"]), isset($_POST["check_keyboard"]), !empty($_POST["server"]) ? $_POST["server"] : null, isset($_POST["check_dvd"]),
        $_POST["os"], $_POST["jenama_alatan"]);
    //function input_alatan_data($lokasi, $siri_cpu, $siri_monitor, $daftar_harta_utm, $peruntukan, $tahun_beli)
    $alatan_fk = input_alatan_data($_POST["lokasi"], $_POST["siri_cpu"], $_POST["siri_monitor"], $_POST["daftar_harta_utm"], $_POST["peruntukan"], $_POST["tahun"]);

    $stmt = $conn_obj->prepare($sql);
    $stmt->bind_param("iisisi", $speck_fk, $alatan_fk, $catatan, $jenis_alatan_unhash, $_SESSION['usn'], $no_pekerja);

    if ($stmt->execute()) {
        $stmt->close();

        return true;
    } else {

        return false;
    }
}

function update_audit_table($no_pekerja, $jenis_alatan, $catatan)
{

}


function add_staff($no_pekerja, $kod_gred_jawatan, $nama, $nama_jawatan, $email, $fakulti_pk)
{
    global $conn_obj;
    $sql = "
    INSERT INTO staff_utm.staff_data (NO_PEKERJA, KOD_GRED_JAWATAN, NAMA, NAMA_JAWATAN, EMAIL, FAKULTI_FK)
SELECT ?, ?, ?, ?, ?, a.FAKULTI_PK
FROM staff_utm.staff_fakulti a
    INNER JOIN audit.audit_users b ON b.USERNAME = ?
WHERE a.FAKULTI_PK = ?
    ";

    $stmt = $conn_obj->prepare($sql);
    $unhash_fakulti = unhash_key($fakulti_pk);
    $stmt->bind_param("sssssi", $no_pekerja, $kod_gred_jawatan,
        $nama, $nama_jawatan, $email, $unhash_fakulti);

    if ($stmt->execute()) {
        $stmt->close();
        return true;
    } else {
        echo $conn_obj->error;
        return false;
    }
}

// get audit data
function get_audit_data($rekod_id)
{
    global $conn_obj;
    $sql = "
    SELECT b.LOKASI,
       a.JENIS_ALATAN,
       c.JENAMA_ALATAN,
       b.PERUNTUKAN,
       b.TAHUN_BELI,
       b.SIRI_CPU,
       b.SIRI_MONITOR,
       b.DAFTAR_HARTA_UTM,
       c.CPU_PROCESSOR,
       c.STORAGE,
       c.RAM,
       c.OS,
       c.GRAPHIC_CARD,
       c.SERVER_IP,
       c.DVD_ROM,
       c.SOUND,
       c.NETWORK_CARD,
       c.KEYBOARD_MOUSE,
       e.NO_PEKERJA,
       e.NAMA,
    a.CATATAN
FROM audit.audit_rekod_audit a
       LEFT JOIN audit.audit_alatan_data b ON b.DATA_PK = a.ALATAN_DATA_FK
       LEFT JOIN audit.audit_spec_alatan c ON c.SPEC_PK = a.SPEC_FK
       LEFT JOIN agihan.parameter d ON d.PARAM_PK = a.JENIS_ALATAN
       INNER JOIN staff_utm.staff_data e ON e.STAFF_PK = a.STAFF_FK
WHERE a.REKOD_PK = ?
    ";
    $unhash_rekod_id = unhash_key($rekod_id);
    $stmt = $conn_obj->prepare($sql);
    $stmt->bind_param("i", $unhash_rekod_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $stmt->close();
        return $result->fetch_assoc();
    } else {
        return false;
    }
}

function get_user_staff()
{
    global $conn_obj;
    $sql = "
SELECT a.USERNAME, a.EMAIL, a.NO_PEKERJA, a.FIRST_NAME, a.LAST_NAME, b.NAMA_FAKULTI AS FAKULTI
FROM audit.audit_users a
       INNER JOIN staff_utm.staff_fakulti b ON b.FAKULTI_PK = a.FAKULTI
";
    $stmt = $conn_obj->prepare($sql);

    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $stmt->close();
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return false;
    }
}


// Hash the primary key
function hash_primary_key($id)
{
    global $hashids;
    return $hashids->encode($id);
}


// get the value from hash of primary key
function unhash_key($hash_string)
{
    global $hashids;
    return $hashids->decode($hash_string)[0];
}