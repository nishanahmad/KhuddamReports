<?php
use setasign\Fpdi\Fpdi;

require_once('vendor/setasign/fpdf/fpdf.php');
require_once('vendor/setasign/fpdi/src/autoload.php');
require '../connect.php';
require '../monthMap.php';

$reportId = $_GET['id'];

$block1Query = mysqli_query($con,"SELECT * FROM block1 WHERE report_id = $reportId") or die(mysqli_error($con));
$block1= mysqli_fetch_array($block1Query,MYSQLI_ASSOC);	
$block2Query = mysqli_query($con,"SELECT * FROM block2 WHERE report_id = $reportId") or die(mysqli_error($con));
$block2= mysqli_fetch_array($block2Query,MYSQLI_ASSOC);	

// initiate FPDI
$pdf = new Fpdi();

// get the page count
$pageCount = $pdf->setSourceFile('report.pdf');
// iterate through all pages
for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) 
{
    // import a page
    $templateId = $pdf->importPage($pageNo);

    $pdf->AddPage();
    // use the imported page and adjust the page size
    $pdf->useTemplate($templateId, ['adjustPageSize' => true]);

	if($pageNo == 1)
	{
		// BLOCK 1
		$pdf->SetFont('Helvetica');
		$pdf->SetFontSize(9);
		$pdf->SetXY(42, 39);
		$pdf->Write(8, $block1['c1']);
		
		$pdf->SetXY(66, 39);
		$pdf->SetFontSize(8);
		$pdf->Write(8, date('d-m-Y',strtotime($block1['c2'])));			
		
		$pdf->SetXY(122, 39);
		$pdf->SetFontSize(9);
		$pdf->Write(8, $block1['c3']);
		
		$pdf->SetXY(182, 39);
		$pdf->SetFontSize(8);
		$pdf->Write(8, date('d-m-Y',strtotime($block1['c4'])));			
		
		$pdf->SetXY(40, 49);
		$pdf->SetFontSize(9);
		$pdf->Write(8, $block1['c5']);

		$pdf->SetXY(82, 49);
		$pdf->SetFontSize(9);
		$pdf->Write(8, $block1['c6']);
		
		$pdf->SetXY(130, 49);
		$pdf->SetFontSize(9);
		$pdf->Write(8, $block1['c7']);
		
		$pdf->SetXY(193, 49);
		$pdf->SetFontSize(9);
		$pdf->Write(8, $block1['c8']);
		
		$pdf->SetXY(58, 58);
		$pdf->SetFontSize(9);
		$pdf->Write(8, $block1['c9']);
		
		$pdf->SetXY(85, 58);
		$pdf->SetFontSize(9);
		$pdf->Write(8, getMonth($block1['c10']));
		
		$pdf->SetXY(126, 58);
		$pdf->SetFontSize(9);
		$pdf->Write(8, $block1['c11']);
		
		$pdf->SetXY(166, 58);
		$pdf->SetFontSize(9);
		$pdf->Write(8, $block1['c12']);

		$pdf->SetXY(35, 68);
		$pdf->SetFontSize(9);
		$pdf->Write(8, $block1['c13']);
		
		$pdf->SetXY(160, 68);
		$pdf->SetFontSize(9);
		$pdf->Write(8, $block1['c14']);

		//BLOCK 2	
		$pdf->SetXY(100, 79);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block2['c1']);
		
		if($block2['c2'] != null)
			$block2['c2'] = date('d-m-Y',strtotime($block2['c2']));
		
		$pdf->SetXY(60, 88);
		$pdf->SetFontSize(8);
		$pdf->Write(8, $block2['c2']);
		
		$pdf->SetXY(193, 88);
		$pdf->SetFontSize(8);
		$pdf->Write(8, $block2['c3']);

		$pdf->SetXY(88, 97);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block2['c4']);
		
		$pdf->SetXY(178, 97);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block2['c5']);

		$pdf->SetXY(178, 107);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block2['c6']);

		if($block2['c7'] != null)
			$block2['c7'] = date('d-m-Y',strtotime($block2['c7']));
		
		$pdf->SetXY(178, 112);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block2['c7']);
		
		$pdf->SetXY(178, 122);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block2['c8']);
		
		//BLOCK 3
		$pdf->SetXY(108, 138);
		$pdf->SetFontSize(10);
		$pdf->Write(8, 'Nishan Ahmed');								
		
		$pdf->SetXY(82, 147);
		$pdf->SetFontSize(10);
		$pdf->Write(8, 'Yes');										
		
		$pdf->SetXY(82, 153);
		$pdf->SetFontSize(10);
		$pdf->Write(8, '09-03-2019');												
		
		$pdf->SetXY(180, 148);
		$pdf->SetFontSize(10);
		$pdf->Write(8, 'Yes');
		
		$pdf->SetXY(85, 162);
		$pdf->SetFontSize(10);
		$pdf->Write(8, '1');										

		$pdf->SetXY(180, 162);
		$pdf->SetFontSize(10);
		$pdf->Write(8, '2');												
		
	}
}

// Output the new PDF
$pdf->Output();            
