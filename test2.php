<?php

// include_once("./admin/inc/functions/config.php");


// $password = "0000";
// // echo encrypt($password);

// $hash = "";
// var_dump(decrypt($hash, $password));

// require("./fpdf/fpdf.php");

// class PDF extends FPDF
// {
//   public function Header()
//   {
//     // Logo
//     $this->Image('logo.png', 10, 6, 30);
//     // Arial bold 15
//     $this->SetFont('Arial', 'B', 15);
//     // Move to the right
//     $this->Cell(80);
//     // Title
//     $this->Cell(30, 10, 'Title', 1, 0, 'C');
//     // Line break
//     $this->Ln(20);
//   }

//   public function Footer()
//   {
//     // Position at 1.5 cm from bottom
//     $this->SetY(-15);
//     // Arial italic 8
//     $this->SetFont('Arial', 'I', 8);
//     // Page number
//     $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
//   }
// }

// $pdf = new PDF();
// // $pdf->AliasNbPages();
// $pdf->AddPage();
// $pdf->SetFont('Times','',12);
// for($i=1;$i<=40;$i++)
//     $pdf->Cell(0,50,'Printing line number '.$i,0,1);
// $pdf->Output("I");

print_r(glob("*"));

?>