<?php
include('include/connect_db.php');

$ptj=$_POST['ptj'];
$lokasi=$_POST['lokasi'];
$peralatan=$_POST['peralatan'];
$jenama=$_POST['jenama'];
$peruntukan=$_POST['peruntukan'];
$tahun=$_POST['tahun'];
$cpu=$_POST['cpu'];
$monitor=$_POST['monitor'];
$daftarharta=$_POST['daftarharta'];
$processor=$_POST['processor'];
$processor2=$_POST['processor2'];
$dvd=$_POST['dvd'];
$card=$_POST['card'];
$harddisk=$_POST['harddisk'];
$sound=$_POST['sound'];
$ram=$_POST['ram'];
$network=$_POST['network'];
$os=$_POST['os'];
$os2=$_POST['os2'];
$km=$_POST['km'];
$tugas=$_POST['tugas'];
$server=$_POST['server'];
$bil_audit=$_POST['bil_audit'];

$audit_pc_staff="UPDATE audit_pc_staff SET kod_ptj='$ptj',jenis_alatan='$peralatan',lokasi='$lokasi',siri_cpu='$cpu',siri_monitor='$monitor',daftar_harta_utm='$daftarharta',peruntukan='$peruntukan',jenama_komputer='$jenama',tahun_beli='$tahun',processor_cpu='$processor $processor2',hard_disk_storage='$harddisk',memory_ram='$ram',dvd_rom='$dvd',graphic_card='$card',sound='$sound',network_card='$network',keyboard_mouse='$km',server_ip='$server',os='$os $os2',skop_tugas='$tugas' WHERE bil_audit='$bil_audit';";

$keputusan = mysqli_query($conn, $audit_pc_staff);

	if ($keputusan) {
		header("location: index.php");
		}
		else
		{
            die('Unable to insert data:' . mysqli_error($conn));
		}

?>