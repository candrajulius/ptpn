<?php
require('../pdf/fpdf.php');
include("../lib/database.php");
include("../lib/config.php");
//Create new pdf file
$pdf=new FPDF();

//Disable automatic page break
$pdf->SetAutoPageBreak(false);

//Add first page
$pdf->AddPage();

//set initial y axis position per page
$y_axis_initial = 10;
$y_axis = "28";
$row_height ="0";


$pdf->SetFillColor(255,255,255,0);
$pdf->SetFont('Arial','B',20);
$pdf->SetY($y_axis_initial);
$pdf->SetX(70);
$pdf->Cell(30,8,'DATA KARYAWAN',0,0,'L',1);

//print column titles
$pdf->SetFillColor(80,37,222);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($y_axis_initial+10);
$pdf->SetX(8);
$pdf->Cell(30,8,'NRP',1,0,'L',1);
$pdf->Cell(40,8,'Nama',1,0,'L',1);
$pdf->Cell(11,8,'SMBK',1,0,'L',1);
$pdf->Cell(11,8,'MC',1,0,'L',1);
$pdf->Cell(11,8,'CLI',1,0,'L',1);
$pdf->Cell(20,8,'Pendidikan',1,0,'L',1);
$pdf->Cell(20,8,'Sertifikat',1,0,'L',1);
$pdf->Cell(20,8,'Karir',1,0,'L',1);
$pdf->Cell(20,8,'Punishment',1,0,'L',1);
$pdf->Cell(12,8,'Jumlah',1,0,'L',1);

$y_axis = $y_axis + $row_height;

//Select the Products you want to show in your PDF file
$result=mysqli_query($connection,"SELECT * FROM karyawan ORDER BY id DESC");

//initialize counter
$i = 0;

//Set maximum rows per page
$max = 25;

//Set Row Height
$row_height = 6;

while($row = mysqli_fetch_array($result))
{
    //If the current row is the last one, create new page and print column title
    if ($i == $max)
    {
        $pdf->AddPage();

        //print column titles for the current page
            $pdf->SetY($y_axis_initial);
            $pdf->SetX(8);
            $pdf->Cell(30,8,'NRP',1,0,'L',1);
            $pdf->Cell(40,8,'Nama',1,0,'L',1);
            $pdf->Cell(11,8,'SMBK',1,0,'L',1);
            $pdf->Cell(11,8,'MC',1,0,'L',1);
            $pdf->Cell(11,8,'CLI',1,0,'L',1);
            $pdf->Cell(20,8,'Pendidikan',1,0,'L',1);
            $pdf->Cell(20,8,'Sertifikat',1,0,'L',1);
            $pdf->Cell(20,8,'Karir',1,0,'L',1);
            $pdf->Cell(20,8,'Punishment',1,0,'L',1);
            $pdf->Cell(12,8,'Jumlah',1,0,'L',1);
        
        //Go to next row
        $y_axis = $y_axis + $row_height;
        
        //Set $i variable to 0 (first row)
        $i = 0;
    }

    $nrp = $row['nrp'];
    $nama = $row['nama_karyawan'];
    $smbk = $row['smbk'];
    $mc = $row['mapping_competency'];
    $cli = $row['cli'];
    $pendidikan = $row['pendidikan'];
    $sertifikat = $row['sertifikat'];
    $perjalanan_karir = $row['perjalanan_karir'];
    $punishment = $row['punishment'];
    $jumlah = $row['jumlah'];

    $pdf->SetFont('Arial','',8);
    $pdf->SetY($y_axis);
    $pdf->SetX(8);
    $pdf->Cell(30,6,$nrp,1,0,'L',0);
    $pdf->Cell(40,6,$nama,1,0,'L',0);
    $pdf->Cell(11,6,$smbk,1,0,'L',0);
    $pdf->Cell(11,6,$mc,1,0,'L',0);
    $pdf->Cell(11,6,$cli,1,0,'L',0);
    $pdf->Cell(20,6,$pendidikan,1,0,'L',0);
    $pdf->Cell(20,6,$sertifikat,1,0,'L',0);
    $pdf->Cell(20,6,$perjalanan_karir,1,0,'L',0);
    $pdf->Cell(20,6,$punishment,1,0,'L',0);
    $pdf->Cell(12,6,$jumlah,1,0,'L',0);

    //Go to next row
    $y_axis = $y_axis + $row_height;
    $i = $i + 1;
}

mysqli_close($connection);

//Send file
$pdf->Output();
?>