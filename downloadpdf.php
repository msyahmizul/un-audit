<?php 

require('fpdf/fpdf.php');
include('include/connect_db.php');
$id=$_GET['download'];
$sql = "SELECT *,date(timestamp) FROM audit_pc_staff INNER JOIN senarai_staff ON audit_pc_staff.no_pekerja_fk = senarai_staff.no_pekerja WHERE bil_audit='$id';";
$query = mysqli_query($conn, $sql);
$pdf = new FPDF('p', 'mm', 'A4');
$pdf->SetTitle('Audit Report');
while ($audit = mysqli_fetch_array($query))
{
	
	$pdf->AddPage();
	
	
	$pdf->Image('UTMLOGO.png',30,10,-1000);//Logo
	$pdf->SetFont('Arial','B',11);//Font
	$pdf->Cell(115);
	$pdf->SetFont('Arial','B',18);
	$pdf->Cell(50, 15, 'CICT      '.$audit['bil_audit'],1,1);
	$pdf->Cell(189,5,'',0,1);
	
	$pdf->SetFont('Arial','BU', 16);
	$pdf->Cell(189,10,'Maklumat Semakan Kondisi Komputer - Oleh CICT '.date("Y"),0,1,'C');
	$pdf->SetFont('Arial','', 14);
	$pdf->Cell(15);
	$pdf->Cell(75, 10, 'No. Staf : '.$audit['no_pekerja_fk'], 0, 0);
	$pdf->Cell(15);
	$pdf->Cell(79, 10, 'Jenis Alatan : '.$audit['jenis_alatan'], 0, 1,'L');
	$pdf->Cell(15);
	$pdf->Cell(140, 10, 'Nama Staf : '.$audit['nama'], 0, 1, 'L');
	$pdf->Cell(15);
	$pdf->Cell(189, 10, 'Lokasi : '.$audit['kod_ptj'].'-'.$audit['lokasi'], 0, 1);
	$pdf->Cell(15);
	$pdf->Cell(80, 10, 'No. Siri CPU : '.$audit['siri_cpu'], 0, 0);
	$pdf->Cell(90, 10, 'No. Siri Monitor : '.$audit['siri_monitor'], 0, 1);
	$pdf->Cell(15);
	$pdf->Cell(105,10,'No. Daftar Harta UTM : '.$audit['daftar_harta_utm'],0,0);
	$pdf->Cell(69,10,'Jenama : '.$audit['jenama_komputer'],0,1);
	$pdf->Cell(15);
	$pdf->Cell(120,10,'Peruntukan : '.$audit['peruntukan'],0,0);
	$pdf->Cell(59,10,'Tahun Beli : '.$audit['tahun_beli'],0,1);
	
	$pdf->SetFont('Arial','B',16);
	$pdf->Cell(10);
	$pdf->Cell(90,10,'Status Spesifikasi CPU :-',0,1);
	
	$pdf->SetFont('Arial','B',13);
	$pdf->SetFillColor(211,211,211);
	
	$pdf->Cell(189,3,'',0,1);
	$pdf->Cell(10);
	$pdf->Cell(15,7,'Bil',1,0,'C');
	$pdf->Cell(30,7,'Item',1,0,'C');
	$pdf->Cell(40,7,'Spesifikasi',1,0,'C');
	$pdf->Cell(15,7,'Bil',1,0,'C');
	$pdf->Cell(30,7,'',1,0);
	$pdf->Cell(40,7,'Spesifikasi',1,1,'C');
	
	$pdf->SetFillColor(255,255,255, .4);
	$pdf->SetFont('Arial','',12);
	
	$pdf->Cell(10);
	$pdf->Cell(15,10,'1',1,0,'C');
	$pdf->Cell(30,10,'Processor',1,0,'L');
	$pdf->SetFont('Arial','',11);
	$pdf->Cell(40,10,$audit['processor_cpu'],1,0,'L');
	$pdf->Cell(15,10,'7',1,0,'C');
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(30,10,'Network Card',1,0,'L');
	$pdf->SetFont('Arial','',11);
	$pdf->Cell(40,10,$audit['network_card'],1,1,'L');
	
	$pdf->Cell(10);
	$pdf->Cell(15,10,'2',1,0,'C');
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(30,10,'HDD Storage',1,0,'L');
	$pdf->SetFont('Arial','',11);
	$pdf->Cell(40,10,$audit['hard_disk_storage'],1,0,'L');
	$pdf->Cell(15,10,'8',1,0,'C');
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(30,10,'Keyboard',1,0,'L');
	$pdf->SetFont('Arial','',11);
	$pdf->Cell(40,10,$audit['keyboard_mouse'],1,1,'L');
	
	$pdf->Cell(10);
	$pdf->Cell(15,10,'3',1,0,'C');
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(30,10,'Memory RAM',1,0,'L');
	$pdf->SetFont('Arial','',11);
	$pdf->Cell(40,10,$audit['memory_ram'],1,0,'L');
	$pdf->Cell(15,10,'9',1,0,'C');
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(30,10,'Mouse',1,0,'L');
	$pdf->SetFont('Arial','',11);
	$pdf->Cell(40,10,$audit['keyboard_mouse'],1,1,'L');
	
	$pdf->Cell(10);
	$pdf->Cell(15,10,'4',1,0,'C');
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(30,10,'DVD-ROM',1,0,'L');
	$pdf->SetFont('Arial','',11);
	$pdf->Cell(40,10,$audit['dvd_rom'],1,0,'L');
	$pdf->Cell(15,10,'10',1,0,'C');
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(30,10,'DNS (server)',1,0,'L');
	$pdf->Cell(40,10,'',1,1,'L');
	
	$pdf->Cell(10);
	$pdf->Cell(15,10,'5',1,0,'C');
	$pdf->Cell(30,10,'Graphic Card',1,0,'L');
	$pdf->SetFont('Arial','',11);
	$pdf->Cell(40,10,$audit['graphic_card'],1,0,'L');
	$pdf->Cell(15,10,'11',1,0,'C');
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(30,10,'No IP(server)',1,0,'L');
	$pdf->SetFont('Arial','',11);
	$pdf->Cell(40,10,$audit['server_ip'],1,1,'L');
	
	$pdf->Cell(10);
	$pdf->Cell(15,10,'6',1,0,'C');
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(30,10,'Sound',1,0,'L');
	$pdf->SetFont('Arial','',11);
	$pdf->Cell(40,10,$audit['sound'],1,0,'L');
	$pdf->Cell(15,10,'12',1,0,'C');
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(30,10,'OS/Windows',1,0,'L');
	$pdf->SetFont('Arial','',11);
	$pdf->Cell(40,10,$audit['os'],1,1,'L');
	
	$pdf->Cell(189,5,'',0,1);
	$pdf->SetFont('Arial','B',14);
	$pdf->Cell(10);
	$pdf->Cell(50,10,'Tujuan/Skop Tugas :-   ',0,0,'L');
	$pdf->SetFont('Arial','',12);
	$pdf->MultiCell(124,10,'   '.$audit['skop_tugas'],0,1);
	
	$pdf->Cell(189,5,'',0,1);
	
	$pdf->SetFont('Arial','',13);
	$pdf->Cell(10);
	$pdf->Cell(45,10,'Disemak oleh :-',0,0);
	$pdf->Cell(60,10,'',0,0);
	$pdf->Cell(45,10,'Disemak oleh :-',0,1);
	$pdf->Cell(10);
	$pdf->Cell(60,20,'.....................................',0,0);
	$pdf->Cell(45,10,'',0,0);
	$pdf->Cell(60,20,'.....................................',0,1);
	$pdf->Cell(10);
	$pdf->Cell(1,10,'(',0,0);
	$pdf->Cell(64,10,$audit['staff_semakan'],0,0,'C');
	$pdf->Cell(1,10,')',0,0);
	$pdf->Cell(40,10,'',0,0);
	$pdf->Cell(65,10,'(',0,0,'L');
	$pdf->Cell(1,10,')',0,1);
	$pdf->Cell(10);
	$pdf->Cell(20,10,'Jawatan: ',0,0);
	$pdf->Cell(85,10,'',0,0);
	$pdf->Cell(20,10,'Jawatan: ',0,1);
	$pdf->Cell(10);
	$pdf->Cell(105,10,'Tarikh: '.date('d-M-Y', strtotime($audit['date(timestamp)'])),0,0);
	$pdf->Cell(60,10,'Tarikh: ',0,1);
	
}
$pdf->Output();
?>