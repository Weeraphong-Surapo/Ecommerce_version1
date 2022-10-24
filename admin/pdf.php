
<?php
require('fpdf.php');

class PDF extends FPDF{
	function Header(){
		$this->AddFont('angsa', '', 'angsa.php');
		$this->SetFont('angsa', '', 36);
		$this->cell(185, 15, iconv('UTF-8', 'TIS-620', 'รายการสินค้า'),0,1,'C');
		$this->cell(70, 15, iconv('UTF-8', 'TIS-620', 'ชื่อสินค้า'),0,0,'C');
		$this->cell(40, 15, iconv('UTF-8', 'TIS-620', 'จำนวน'),0,0,'C');
		$this->cell(50, 15, iconv('UTF-8', 'TIS-620', 'ราคา'),0,0,'C');
		$this->cell(30, 15, iconv('UTF-8', 'TIS-620', 'ค่าส่ง'),0,1,'C');
		$y = $this->GetY();
		$this->Line(10,25,199,25); // top
		$this->Line(10,25,10,285); // Left
		$this->Line(199,25,199,285); // Right
		$this->Line(10,285,199,285); // bottom
		$this->Line(10,$y,199,$y); // border header


		$this->Line(80,25,80,285); // เส้นเข้นกลาง
		$this->Line(120,25,120,285);
		$this->Line(170,25,170,285);

	}
}

define('FPDF_FONTPATH', 'font/');

$pdf = new PDF();
$pdf->AddPage();
$pdf->AddFont('angsa', '', 'angsa.php');
$pdf->SetFont('angsa', '', 36);

define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASS", "root");
define("DB_NAME", "shop");

$con = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
$query = $con->query("SELECT * FROM tb_order WHERE order_id = '$_GET[id]'");
if (mysqli_num_rows($query) >= 1) {
	$total = 0;
	while ($rows = $query->fetch_assoc()) {
		$total += ($rows['price'] * $rows['qty']) + $rows['delivery'];
		$pdf->Cell(70, 20, iconv('UTF-8', 'TIS-620', $rows["product"]),0,0,'C');
		$pdf->Cell(40, 15,$rows['qty'],0,0,'C');
		$y = $pdf->GetY();
		$pdf->MultiCell(50, 15,number_format($rows['price']),0,'C');
		$y1 = $pdf->GetY();
		$pdf->SetY($y);
		$pdf->Cell(160,20,'');
		$pdf->Cell(30, 15,$rows['delivery'],0,1,'C');
		$pdf->Line(10,$y1+2,199,$y1+2);
	}
	$pdf->Output();
} else {
	echo "ไม่มีสินค้า";
}
?>