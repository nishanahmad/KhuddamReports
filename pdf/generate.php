<?php
use setasign\Fpdi\Fpdi;

require_once('vendor/setasign/fpdf/fpdf.php');
require_once('vendor/setasign/fpdi/src/autoload.php');
require '../connect.php';
require '../monthMap.php';

$reportId = $_GET['id'];

$reportQuery = mysqli_query($con,"SELECT * FROM reports WHERE id = $reportId") or die(mysqli_error($con));
$report= mysqli_fetch_array($reportQuery,MYSQLI_ASSOC);	
$block1Query = mysqli_query($con,"SELECT * FROM block1 WHERE report_id = $reportId") or die(mysqli_error($con));
$block1= mysqli_fetch_array($block1Query,MYSQLI_ASSOC);	
$block2Query = mysqli_query($con,"SELECT * FROM block2 WHERE report_id = $reportId") or die(mysqli_error($con));
$block2= mysqli_fetch_array($block2Query,MYSQLI_ASSOC);
$block3Query = mysqli_query($con,"SELECT * FROM block3 WHERE report_id = $reportId") or die(mysqli_error($con));
$block3= mysqli_fetch_array($block3Query,MYSQLI_ASSOC);
$block4Query = mysqli_query($con,"SELECT * FROM block4 WHERE report_id = $reportId") or die(mysqli_error($con));
$block4= mysqli_fetch_array($block4Query,MYSQLI_ASSOC);	
$block5Query = mysqli_query($con,"SELECT * FROM block5 WHERE report_id = $reportId") or die(mysqli_error($con));
$block5= mysqli_fetch_array($block5Query,MYSQLI_ASSOC);
$block6Query = mysqli_query($con,"SELECT * FROM block6 WHERE report_id = $reportId") or die(mysqli_error($con));
$block6= mysqli_fetch_array($block6Query,MYSQLI_ASSOC);
$block7Query = mysqli_query($con,"SELECT * FROM block7 WHERE report_id = $reportId") or die(mysqli_error($con));
$block7= mysqli_fetch_array($block7Query,MYSQLI_ASSOC);	

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
		$pdf->Write(8, $block3['c1']);
		
		$pdf->SetXY(82, 147);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block3['c2']);
		
		if($block3['c3'] != null)
			$block3['c3'] = date('d-m-Y',strtotime($block3['c3']));		
		$pdf->SetXY(82, 153);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block3['c3']);
		
		$pdf->SetXY(180, 148);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block3['c4']);
		
		$pdf->SetXY(85, 162);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block3['c5']);

		$pdf->SetXY(180, 162);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block3['c6']);
		
		//BLOCK 4		
		$pdf->SetXY(110, 195);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block4['c1']);

		$pdf->SetXY(108, 203);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block4['c2']);

		$pdf->SetXY(108, 207);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block4['c3']);

		$pdf->SetXY(188, 205);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block4['c4']);

		$pdf->SetXY(48, 228);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block4['c5']);		
		
		$pdf->SetXY(72, 228);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block4['c6']);

		$pdf->SetXY(92, 228);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block4['c7']);

		$pdf->SetXY(116, 228);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block4['c8']);

		$pdf->SetXY(142, 228);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block4['c9']);

		$pdf->SetXY(178, 228);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block4['c10']);

		$pdf->SetXY(48, 237);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block4['c11']);

		$pdf->SetXY(72, 237);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block4['c12']);

		$pdf->SetXY(92, 237);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block4['c13']);

		$pdf->SetXY(116, 237);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block4['c14']);

		$pdf->SetXY(142, 237);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block4['c15']);

		$pdf->SetXY(178, 237);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block4['c16']);

		$pdf->SetXY(88, 247);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block4['c17']);

		$pdf->SetXY(190, 246);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block4['c18']);

		$pdf->SetXY(190, 251);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block4['c19']);

		$pdf->SetXY(118, 260);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block4['c20']);

		$pdf->SetXY(178, 260);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block4['c21']);		


	}
	if($pageNo == 2)
	{
		//BLOCK 5		
		$pdf->SetXY(115, 8);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block5['c1']);

		$pdf->SetXY(62, 20);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block5['c2']);

		$pdf->SetXY(116, 20);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block5['c3']);

		$pdf->SetXY(192, 20);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block5['c4']);

		$pdf->SetXY(60, 35);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block5['c5']);

		$pdf->SetXY(116, 35);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block5['c6']);

		$pdf->SetXY(192, 35);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block5['c7']);

		$pdf->SetXY(116, 51);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block5['c8']);

		$pdf->SetXY(192, 51);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block5['c9']);

		$pdf->SetXY(82, 65);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block5['c10']);

		$pdf->SetXY(192, 65);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block5['c11']);

		$pdf->SetXY(64, 80);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block5['c12']);

		$pdf->SetXY(120, 80);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block5['c13']);	

		$pdf->SetXY(192, 80);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block5['c14']);

		$pdf->SetXY(120, 94);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block5['c15']);	

		$pdf->SetXY(192, 94);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block5['c16']);

		//BLOCK 6
		$pdf->SetXY(110, 127);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block6['c1']);

		$pdf->SetXY(62, 154);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block6['c2']);

		$pdf->SetXY(88, 154);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block6['c3']);		
		
		$pdf->SetXY(122, 154);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block6['c4']);		
		
		$pdf->SetXY(148, 154);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block6['c5']);		
		
		$pdf->SetXY(172, 154);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block6['c6']);

		$pdf->SetXY(192, 154);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block6['c7']);

		$pdf->SetXY(62, 169);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block6['c8']);

		$pdf->SetXY(88, 169);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block6['c9']);		
		
		$pdf->SetXY(122, 169);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block6['c10']);		
		
		$pdf->SetXY(148, 169);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block6['c11']);		
		
		$pdf->SetXY(172, 169);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block6['c12']);

		$pdf->SetXY(192, 169);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block6['c13']);

		$pdf->SetXY(162, 181);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block6['c14']);

		$pdf->SetXY(174, 181);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block6['c15']);

		$pdf->SetXY(163, 186);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block6['c16']);

		$pdf->SetXY(92, 194);
		$pdf->SetFontSize(9);
		$pdf->Write(8, $block6['c17']);

		if($block6['c18'] != null)
			$block6['c18'] = date('d-m-Y',strtotime($block6['c18']));
		$pdf->SetXY(92, 198);
		$pdf->SetFontSize(9);
		$pdf->Write(8, $block6['c18']);

		$pdf->SetXY(92, 202);
		$pdf->SetFontSize(9);
		$pdf->Write(8, $block6['c19']);

		$pdf->SetXY(182, 194);
		$pdf->SetFontSize(9);
		$pdf->Write(8, $block6['c20']);

		$pdf->SetXY(182, 198);
		$pdf->SetFontSize(9);
		$pdf->Write(8, $block6['c21']);		
		
		if($block6['c22'] != null)
			$block6['c22'] = date('d-m-Y',strtotime($block6['c22']));		
		$pdf->SetXY(182, 202);
		$pdf->SetFontSize(8);
		$pdf->Write(8, $block6['c22']);

		$pdf->SetXY(64, 212);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block6['c23']);

		$pdf->SetXY(135, 212);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block6['c24']);

		$pdf->SetXY(190, 212);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block6['c25']);

		//BLOCK 7
		$pdf->SetXY(126, 241);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block7['c1']);

		$pdf->SetXY(59, 260);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block7['c2']);

		$pdf->SetXY(128, 260);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block7['c3']);

		$pdf->SetXY(192, 260);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block7['c4']);

		$pdf->SetXY(85, 269);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block7['c5']);

		$pdf->SetXY(188, 269);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block7['c6']);
	}	

	if($pageNo == 3)
	{	
		$pdf->SetXY(99, 10);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block7['c7']);		
		
		$pdf->SetXY(190, 10);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block7['c8']);

		$pdf->SetXY(82, 25);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block7['c9']);

		$pdf->SetXY(190, 25);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block7['c10']);		
		
		$pdf->SetXY(85, 40);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block7['c11']);		
		
		$pdf->SetXY(190, 40);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block7['c12']);

		$pdf->SetXY(85, 55);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block7['c13']);

		$pdf->SetXY(190, 55);
		$pdf->SetFontSize(10);
		$pdf->Write(8, $block7['c14']);		
	}					
}

// Output the new PDF
$pdf->Output();  