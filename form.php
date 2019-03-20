<?php
session_start();
if(isset($_SESSION["user_name"]))
{
	require 'connect.php';
	require 'monthMap.php';

	$year = $_GET['year'];
	$month = $_GET['month'];
	$jamathId = (int)$_SESSION["jamath"];
	$jamathQuery = mysqli_query($con,"SELECT name FROM jamaths WHERE id = $jamathId ") or die(mysqli_error($con));	
	$jamath= mysqli_fetch_array($jamathQuery,MYSQLI_ASSOC);
	
	$reportQuery = mysqli_query($con,"SELECT * FROM reports WHERE jamath = $jamathId AND year=$year AND month=$month") or die(mysqli_error($con));
	$report= mysqli_fetch_array($reportQuery,MYSQLI_ASSOC);
	$reportId = $report['id'];
	
	if(isset($reportId))
	{
		$oldReportQuery = mysqli_query($con,"SELECT * FROM reports WHERE jamath = $jamathId AND id < $reportId ORDER BY id DESC") or die(mysqli_error($con).'20');
		$oldReport= mysqli_fetch_array($oldReportQuery,MYSQLI_ASSOC);
		$oldReportId = $oldReport['id'];	
	}
	else
	{
		$oldReportQuery = mysqli_query($con,"SELECT * FROM reports WHERE jamath = $jamathId ORDER BY id DESC") or die(mysqli_error($con).'26');
		$oldReport= mysqli_fetch_array($oldReportQuery,MYSQLI_ASSOC);
		$oldReportId = $oldReport['id'];		
	}
	
	if($reportId != null || $oldReportId != null)
	{	
		//BLOCK 1 assignment
		if($reportId == null &&  $oldReportId != null)
		{
			$block1Query = mysqli_query($con,"SELECT * FROM block1 WHERE report_id = $oldReportId") or die(mysqli_error($con).'35');
			$block1= mysqli_fetch_array($block1Query,MYSQLI_ASSOC);	
			$b1c1 = $block1['c1'];
			$b1c3 = $block1['c3'];
			$b1c8 = $block1['c8'];
			$b1c9 = $block1['c9'];
			$b1c12 = $block1['c12'];
			$b1c13 = $block1['c13'];
			$b1c14 = $block1['c14'];			
		}
		else if($reportId != null )
		{
			$block1Query = mysqli_query($con,"SELECT * FROM block1 WHERE report_id = $reportId") or die(mysqli_error($con).'48');
			$block1= mysqli_fetch_array($block1Query,MYSQLI_ASSOC);	
			$b1c1 = $block1['c1'];
			$b1c2 = date('d-m-Y',strtotime($block1['c2']));
			$b1c3 = $block1['c3'];
			$b1c4 = date('d-m-Y',strtotime($block1['c4']));
			$b1c8 = $block1['c8'];
			$b1c9 = $block1['c9'];
			$b1c12 = $block1['c12'];
			$b1c13 = $block1['c13'];
			$b1c14 = $block1['c14'];			
		}
		
		//BLOCK 2 assignment
		$reportFlag = null;
		if($reportId != null)
		{
			$block2Query = mysqli_query($con,"SELECT * FROM block2 WHERE report_id = $reportId") or die(mysqli_error($con).'50');
			if(mysqli_num_rows($block2Query) <=0)
			{
				if($oldReportId != null)
					$block2Query = mysqli_query($con,"SELECT * FROM block2 WHERE report_id = $oldReportId") or die(mysqli_error($con).'52');								
			}	
			else
				$reportFlag = 'new';		
		}
		else if($oldReportId != null)
			$block2Query = mysqli_query($con,"SELECT * FROM block2 WHERE report_id = $oldReportId") or die(mysqli_error($con).'55');			

		$block2= mysqli_fetch_array($block2Query,MYSQLI_ASSOC);	
		$b2c1 = $block2['c1'];
		$b2c4 = $block2['c4'];
		$b2c5 = $block2['c5'];
		$b2c6 = $block2['c6'];
		if(!empty($block2['c7']))
			$b2c7 = date('d-m-Y',strtotime($block2['c7']));
		$b2c8 = $block2['c8'];
		if($reportFlag == 'new')
		{
			if(!empty($block2['c2']))
				$b2c2 = date("d-m-Y", strtotime($block2['c2']));
			
			$b2c3 = $block2['c3'];
		}			
		
		
		//BLOCK 3 assignment
		$reportFlag = null;
		if($reportId != null)
		{
			$block3Query = mysqli_query($con,"SELECT * FROM block3 WHERE report_id = $reportId") or die(mysqli_error($con).'68');
			if(mysqli_num_rows($block3Query) <=0)
			{
				if($oldReportId != null)
					$block3Query = mysqli_query($con,"SELECT * FROM block3 WHERE report_id = $oldReportId") or die(mysqli_error($con).'70');				
			}
			else
				$reportFlag = 'new';
		}
		else if($oldReportId != null)
			$block3Query = mysqli_query($con,"SELECT * FROM block3 WHERE report_id = $oldReportId") or die(mysqli_error($con).'73');			

		
		$block3= mysqli_fetch_array($block3Query,MYSQLI_ASSOC);	
		$b3c1 = $block3['c1'];
		$b3c2 = $block3['c2'];
		if(!empty($block3['c3']))
			$b3c3 = date("d-m-Y", strtotime($block3['c3']));		
		if($reportFlag == 'new')
		{
			$b3c4 = $block3['c4'];
			$b3c5 = $block3['c5'];
			$b3c6 = $block3['c6'];
		}					
		
		
		//BLOCK 4 assignment
		$reportFlag = null;
		if($reportId != null)
		{
			$block4Query = mysqli_query($con,"SELECT * FROM block4 WHERE report_id = $reportId") or die(mysqli_error($con));	
			if(mysqli_num_rows($block4Query) <=0)
			{
				if($oldReportId != null)
					$block4Query = mysqli_query($con,"SELECT * FROM block4 WHERE report_id = $oldReportId") or die(mysqli_error($con));					
			}
			else
				$reportFlag = 'new';
		}
		else if($oldReportId != null)
			$block4Query = mysqli_query($con,"SELECT * FROM block4 WHERE report_id = $oldReportId") or die(mysqli_error($con));	
		
		$block4= mysqli_fetch_array($block4Query,MYSQLI_ASSOC);	
		$b4c1 = $block4['c1'];
		$b4c5 = $block4['c5'];
		$b4c6 = $block4['c6'];
		$b4c7 = $block4['c7'];
		$b4c8 = $block4['c8'];
		$b4c9 = $block4['c9'];
		$b4c10 = $block4['c10'];
		$b4c11 = $block4['c11'];
		$b4c12 = $block4['c12'];
		$b4c13 = $block4['c13'];
		$b4c14 = $block4['c14'];
		$b4c15 = $block4['c15'];
		$b4c16 = $block4['c16'];
		$b4c17 = $block4['c17'];
		if($reportFlag == 'new')
		{
			$b4c2 = $block4['c2'];
			$b4c3 = $block4['c3'];
			$b4c4 = $block4['c4'];
			$b4c18 = $block4['c18'];
			$b4c19 = $block4['c19'];
			$b4c20 = $block4['c20'];
			$b4c21 = $block4['c21'];
		}
		
		
		//BLOCK 5 assignment
		$reportFlag = null;
		if($reportId != null)
		{		
			$block5Query = mysqli_query($con,"SELECT * FROM block5 WHERE report_id = $reportId") or die(mysqli_error($con));
			if(mysqli_num_rows($block5Query) <=0)
			{
				if($oldReportId != null)
					$block5Query = mysqli_query($con,"SELECT * FROM block5 WHERE report_id = $oldReportId") or die(mysqli_error($con));					
			}
			else
				$reportFlag = 'new';

		}
		else if($oldReportId != null)
			$block5Query = mysqli_query($con,"SELECT * FROM block5 WHERE report_id = $oldReportId") or die(mysqli_error($con));	
		
		$block5= mysqli_fetch_array($block5Query,MYSQLI_ASSOC);	
		$b5c1 = $block5['c1'];
		$b5c4 = $block5['c4'];
		$b5c9 = $block5['c9'];
		$b5c10 = $block5['c10'];		
		if($reportFlag == 'new')
		{
			$b5c2 = $block5['c2'];
			$b5c3 = $block5['c3'];
			$b5c5 = $block5['c5'];
			$b5c6 = $block5['c6'];
			$b5c7 = $block5['c7'];
			$b5c8 = $block5['c8'];
			$b5c11 = $block5['c11'];
			$b5c12 = $block5['c12'];
			$b5c13 = $block5['c13'];
			$b5c14 = $block5['c14'];
			$b5c15 = $block5['c15'];
			$b5c16 = $block5['c16'];
		}		
		
		//BLOCK 6 assignment
		$reportFlag = null;
		if($reportId != null)
		{
			$block6Query = mysqli_query($con,"SELECT * FROM block6 WHERE report_id = $reportId") or die(mysqli_error($con));
			if(mysqli_num_rows($block6Query) <=0)
			{
				if($oldReportId != null)
					$block6Query = mysqli_query($con,"SELECT * FROM block6 WHERE report_id = $oldReportId") or die(mysqli_error($con));								
			}
			else
				$reportFlag = 'new';

		}
		else if($oldReportId != null)
			$block6Query = mysqli_query($con,"SELECT * FROM block6 WHERE report_id = $oldReportId") or die(mysqli_error($con));				
			
		$block6= mysqli_fetch_array($block6Query,MYSQLI_ASSOC);	
		$b6c1 = $block6['c1'];		
		if($reportFlag == 'new')
		{
			$b6c2 = $block6['c2'];		$b6c12 = $block6['c12'];
			$b6c3 = $block6['c3'];		$b6c13 = $block6['c13'];
			$b6c4 = $block6['c4'];		$b6c14 = $block6['c14'];
			$b6c5 = $block6['c5'];		$b6c15 = $block6['c15'];
			$b6c6 = $block6['c6'];		$b6c16 = $block6['c16'];
			$b6c7 = $block6['c7'];		$b6c17 = $block6['c17'];
			$b6c8 = $block6['c8'];		$b6c18 = $block6['c18'];
			$b6c9 = $block6['c9'];		$b6c19 = $block6['c19'];
			$b6c10 = $block6['c10'];	$b6c20 = $block6['c20'];
			$b6c11 = $block6['c11'];	$b6c21 = $block6['c21'];
			$b6c22 = $block6['c22'];	$b6c23 = $block6['c23'];
			$b6c24 = $block6['c24'];	$b6c25 = $block6['c25'];
		}
	}
?>
	<!DOCTYPE html>
	<html lang="en">
		<head>
			<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<title><?php echo getMonth($month).' '.$year;?></title>

			<!-- CSS -->
			<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
			<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
			<link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
			<link rel="stylesheet" href="assets/css/form-elements.css">
			<link rel="stylesheet" href="assets/css/style.css">
			<link rel="stylesheet" href="assets/css/jquery-ui.css">

			<!-- Favicon and touch icons -->
			<link rel="shortcut icon" href="assets/ico/favicon.png">
			<link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
			<link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
			<link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
			<link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
			<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
		</head>

		<body>
			<!-- Top menu -->
			<nav class="navbar navbar-inverse navbar-no-bg" role="navigation">
				<div class="container">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#top-navbar-1">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					<a class="navbar-brand" href="index.php">Khuddamul Ahmadiyya Bharath Report Form</a>
					</div>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse" id="top-navbar-1">
						<ul class="nav navbar-nav navbar-right">
							<li>
								<span class="li-text">
									Put some text or
								</span> 
								<a href="#"><strong>links</strong></a> 
								<span class="li-text">
									here, or some icons: 
								</span> 
								<span class="li-social">
									<a href="#"><i class="fa fa-facebook"></i></a> 
									<a href="#"><i class="fa fa-twitter"></i></a> 
									<a href="#"><i class="fa fa-envelope"></i></a> 
									<a href="#"><i class="fa fa-skype"></i></a>
								</span>
							</li>
						</ul>
					</div>
				</div>
			</nav>

			<!-- Top content -->
			<div class="top-content">
				<div class="inner-bg">
					<div class="container">
						<div class="row">
							<div class="col-sm-8 col-sm-offset-2 text">
								<h1><strong><?php echo $jamath['name'];?> Report Form</strong></h1>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6 col-sm-offset-3 form-box">
								<form role="form" action="insert.php" method="post" class="registration-form">
									
									<!------------------ BLOCK 1 ------------------------->	
									<fieldset id="f1">
										<div class="form-top">
											<div class="form-top-left">
												<h3>1. General Info</h3>
											</div>
										</div>
										<div class="form-bottom">
											<div class="form-group">
												<label for="b1c1">പ്രാദേശിക നമ്പർ</label>
												<input type="text" name="b1c1" class="form-control" id="b1c1" <?php if(isset($b1c1)) echo 'value='.$b1c1;?>>
											</div>
											<div class="form-group">
												<label for="b1c2">തീയതി </label>
												<input type="text" name="b1c2" class="form-control" id="b1c2" value="<?php if(isset($b1c2)) echo $b1c2; else echo date('d-m-Y'); ?>">
											</div>
											<div class="form-group">
												<label for="b1c3">വന്ന ഓഫീസ് നമ്പർ </label>
												<input type="text" name="b1c3" class="form-control" id="b1c3" <?php if(isset($b1c3)) echo 'value='.$b1c3;?>>
											</div>										
											<div class="form-group">
												<label for="b1c4">വന്ന തീയതിയും സീലും </label>
												<input type="text" name="b1c4" class="form-control" id="b1c4" <?php if(isset($b1c4)) echo 'value='.$b1c4;?>>
											</div>
											<div class="form-group">
												<label for="b1c5">മജ്‌ലിസിൻറെ പേര് </label>
												<input type="text" readonly name="b1c5" class="form-control" id="b1c5" value="<?php echo $jamath['name'];?>">
											</div>																				
											<div class="form-group">
												<label for="b1c6">District</label>
												<input type="text" name="b1c6" class="form-control" id="b1c6" value="Kannur">
											</div>																				
											<div class="form-group">
												<label for="b1c7">State</label>
												<input type="text" name="b1c7" class="form-control" id="b1c7" value="Kerala">
											</div>																				
											<div class="form-group">
												<label for="b1c8">ഖാദിമീങ്ങളുടെ എണ്ണം  </label>
												<input type="text" name="b1c8" class="form-control" id="b1c8" <?php if(isset($b1c8)) echo 'value='.$b1c8;?>>
											</div>																				
											<div class="form-group">
												<label for="b1c9">ആമില അംഗങ്ങളുടെ എണ്ണം </label>
												<input type="text" name="b1c9" class="form-control" id="b1c9" <?php if(isset($b1c9)) echo 'value='.$b1c9;?>>
											</div>																				
											<div class="form-group">
												<label for="b1c10">Month</label>
												<select id="b1c10" name="b1c10" class="form-control">																				<?php	
													for($i=1;$i<=12;$i++) 
													{																																?>			
														<option value="<?php echo $i;?>" <?php if($i == $month) echo 'selected';?>><?php echo getMonth($i);?></option>				<?php	
													}																																?>	
												</select>
											</div>
											<div class="form-group">
												<label for="b1c11">Year</label>
												<input type="text" name="b1c11" class="form-control" id="b1c11" value="<?php echo $year;?>">
											</div>
											<div class="form-group">
												<label for="b1c12">Qaid Name</label>
												<input type="text" name="b1c12" class="form-control" id="b1c12" <?php if(isset($b1c12)) echo 'value="'.$b1c12.'"'?>>
											</div>
											<div class="form-group">
												<label for="b1c13">Email</label>
												<input type="text" name="b1c13" class="form-email form-control" id="b1c13" <?php if(isset($b1c13)) echo 'value='.$b1c13;?>>
											</div>
											<div class="form-group">
												<label for="b1c14">Mobile</label>
												<input type="text" name="b1c14" class="form-control" id="b1c14" <?php if(isset($b1c14)) echo 'value='.$b1c14;?>>
											</div>										
											<button type="button" class="btn btn-next" onClick="Block1()">Next</button>
											
											<button style="float:right" class="btn btn-success" onClick="Save1()">Save & Exit  <i class="fas fa-save"></i></button>
										</div>
									</fieldset>
									<!------------------ BLOCK 1 END ------------------------->	



									<!------------------ BLOCK 2 ------------------------->		
									<fieldset id="f2">
										<div class="form-top">
											<div class="form-top-left">
												<h3>2. ശുഅബ ഇഅതിമാദ്</h3>
											</div>
										</div>
										<div class="form-bottom">
											<div class="form-group">
												<label for="b2c1">മുഅതമിദിൻറെ പേര്</label>
												<input type="text" name="b2c1" class="form-control" id="b2c1" <?php if(isset($b2c1)) echo 'value="'.$b2c1.'"'?>>
											</div>
											<div class="form-group">
												<label for="b2c2">ആമില യോഗം നടന്ന തീയതി</label>
												<input type="text" name="b2c2" class="form-control ignore" id="b2c2" <?php if(isset($b2c2)) echo 'value='.$b2c2;?>>
											</div>
											<div class="form-group">
												<label for="b2c3">യോഗത്തിൻറെ റിപ്പോർട്ട് വേറെ പേപ്പറിൽ ചേർത്തിട്ടുണ്ടോ?</label>
												<select id="b2c3" name="b2c3" class="form-control">
													<option value=""></option>
													<option <?php if(isset($b2c3) && $b2c3 == 'Yes') echo 'selected';?> value="Yes">Yes</option>
													<option <?php if(isset($b2c3) && $b2c3 == 'No') echo 'selected';?> value="No">No</option>
												</select>
											</div>				
											<div class="form-group">
												<label for="b2c4">ഭാരവാഹികൾ ലായേ അമൽ വായിച്ചിട്ടുണ്ടോ?</label>
												<select id="b2c4" name="b2c4" class="form-control">
													<option <?php if(isset($b2c4) && $b2c4 == 'Yes') echo 'selected';?> value="Yes">Yes</option>
													<option <?php if(isset($b2c4) && $b2c4 == 'No') echo 'selected';?> value="No">No</option>													
												</select>
											</div>				
											<div class="form-group">
												<label for="b2c5">ഭാരവാഹികൾക്കു റിഫ്രഷർ ക്ലാസ് എടുത്ത് പരീക്ഷ നടത്തിയോ?</label>
												<select id="b2c5" name="b2c5" class="form-control">
													<option <?php if(isset($b2c5) && $b2c5 == 'Yes') echo 'selected';?> value="Yes">Yes</option>
													<option <?php if(isset($b2c5) && $b2c5 == 'No') echo 'selected';?> value="No">No</option>													
												</select>
											</div>																						
											<div class="form-group">
												<label for="b2c6">റിസൾട്ട് അയച്ചുവോ?</label>
												<select id="b2c6" name="b2c6" class="form-control">
													<option <?php if(isset($b2c6) && $b2c6 == 'Yes') echo 'selected';?> value="Yes">Yes</option>
													<option <?php if(isset($b2c6) && $b2c6 == 'No') echo 'selected';?> value="No">No</option>													
												</select>
											</div>																						
											<div class="form-group">
												<label for="b2c7">തീയതി</label>
												<input type="text" name="b2c7" class="form-control ignore" id="b2c7" <?php if(isset($b2c7)) echo 'value='.$b2c7;?>>
											</div>
											<div class="form-group">
												<label for="b2c8">നമസ്കാരവും, മജ്‌ലിസെ ശൂറ തീരുമാനപ്രകാരം പ്രവർത്തനം നടക്കുന്നതിന് മജ്‌ലിസെ ആമില യോഗം നടത്തിയോ? </label>
												<select id="b2c8" name="b2c8" class="form-control">
													<option <?php if(isset($b2c8) && $b2c8 == 'Yes') echo 'selected';?> value="Yes">Yes</option>
													<option <?php if(isset($b2c8) && $b2c8 == 'No') echo 'selected';?> value="No">No</option>													
												</select>
											</div>																																	
											<button type="button" class="btn btn-previous">Previous</button>
											<button type="button" class="btn btn-next" onclick="Block2(<?php echo $year.','.$month;?>)">Next</button>
											<button style="float:right" class="btn btn-success" onClick="Save2()">Save & Exit  <i class="fas fa-save"></i></button>
										</div>
									</fieldset>
									<!------------------ BLOCK 2 End ------------------------->	
									
									
									
									<!------------------ BLOCK 3 ------------------------->	
									<fieldset id="f3">
										<div class="form-top">
											<div class="form-top-left">
												<h3>3. ശുഅബ തജ്‌നീദ് </h3>
											</div>
										</div>
										<div class="form-bottom">
											<div class="form-group">
												<label for="b3c1">നാസിം തജ്‌നീദിൻറെ പേര്</label>
												<input type="text" name="b3c1" class="form-control" id="b3c1" <?php if(isset($b3c1)) echo 'value="'.$b3c1.'"'?>>
											</div>
											<div class="form-group">
												<label for="b3c2">തജ്‌നീദ് ഫോറം പൂരിപ്പിച് അയച്ചുവോ?</label>
												<select id="b3c2" name="b3c2" class="form-control">
													<option <?php if(isset($b3c2) && $b3c2 == 'Yes') echo 'selected';?> value="Yes">Yes</option>
													<option <?php if(isset($b3c2) && $b3c2 == 'No') echo 'selected';?> value="No">No</option>
												</select>	
											</div>	
											<div class="form-group">
												<label for="b3c3">എപ്പോൾ (തീയതി )?</label>
												<input type="text" name="b3c3" class="form-control ignore" id="b3c3" <?php if(isset($b3c3)) echo 'value='.$b3c3;?>>
											</div>
											<div class="form-group">
												<label for="b3c4">താങ്കളുടെ മജ്‌ലിസിൽ സായിക്കുമാരുടെ പ്രവർത്തന സംവിധാനം ഉണ്ടോ?</label>
												<select id="b3c4" name="b3c4" class="form-control">
													<option <?php if(isset($b3c4) && $b3c4 == 'Yes') echo 'selected';?> value="Yes">Yes</option>
													<option <?php if(isset($b3c4) && $b3c4 == 'No') echo 'selected';?> value="No">No</option>
												</select>	
											</div>
											<div class="form-group">
												<label for="b3c5">താങ്കളുടെ മജ്‌ലിസിൽ ഖുദാമിൽ പ്രവേശിച്ച പുതിയ അംഗങ്ങളുടെ എണ്ണം</label>
												<input type="text" name="b3c5" class="form-control ignore" id="b3c5" <?php if(isset($b3c5)) echo 'value='.$b3c5;?>>
											</div>
											<div class="form-group">
												<label for="b3c6">താങ്കളുടെ മജ്‌ലിസിൽ നിന്നും മറ്റു മജ്‌ലിസിലേക്‌ മാറിയവരുടെ എണ്ണം</label>
												<input type="text" name="b3c6" class="form-control ignore" id="b3c6" <?php if(isset($b3c6)) echo 'value='.$b3c6;?>>
											</div>											
											
											<button type="button" class="btn btn-previous">Previous</button>
											<button type="button" class="btn btn-next" onclick="Block3(<?php echo $year.','.$month;?>)">Next</button>
											<button style="float:right" class="btn btn-success" onClick="Save3()">Save & Exit  <i class="fas fa-save"></i></button>
										</div>
									</fieldset>
									<!------------------ BLOCK 3 End ------------------------->	
									
									
									<!------------------ BLOCK 4 ------------------------->	
									<fieldset id="f4">
										<div class="form-top">
											<div class="form-top-left">
												<h3>4. ശുഅബ തഅലിം</h3>
											</div>
										</div>
										<div class="form-bottom">
											<div class="form-group">
												<label for="b4c1">നാസിം തഅലിമിൻറെ പേര്</label>
												<input type="text" name="b4c1" class="form-control" id="b4c1" <?php if(isset($b4c1)) echo 'value="'.$b4c1.'"'?>>
											</div>
											<div class="form-group">
												<label for="b4c2">തഅലിം ക്ലാസ് നടത്തിയോ?</label>
												<select id="b4c2" name="b4c2" class="form-control">
													<option <?php if(isset($b4c2) && $b4c2 == 'Yes') echo 'selected';?> value="Yes">Yes</option>
													<option <?php if(isset($b4c2) && $b4c2 == 'No') echo 'selected';?> value="No">No</option>
												</select>	
											</div>	
											<div class="form-group">
												<label for="b4c3">എത്ര?</label>
												<input type="text" name="b4c3" class="form-control" id="b4c3" <?php if(isset($b4c3)) echo 'value='.$b4c3;?>>
											</div>
											<div class="form-group">
												<label for="b4c4">ഹാജരായ ഖാദിമീങ്ങളുടെ എണ്ണം</label>
												<input type="text" name="b4c4" class="form-control ignore" id="b4c4" <?php if(isset($b4c4)) echo 'value='.$b4c4;?>>
											</div>
											<div class="form-group">
												<table border="1" width="90%">
													<tr>
														<td></td>
														<td>അറിയുന്ന ഖുദ്ദആം</td>
														<td>പഠിക്കുന്ന ഖുദ്ദആം</td>
													</tr>
													<tr>
														<td>നോക്കി ഓതൽ</td>
														<td><input type="text" name="b4c5" class="form-control ignore" id="b4c5" <?php if(isset($b4c5)) echo 'value='.$b4c5;?>></td>
														<td><input type="text" name="b4c11" class="form-control ignore" id="b4c11" <?php if(isset($b4c11)) echo 'value='.$b4c11;?>></td>
													</tr>
													<tr>
														<td>ഖുർആൻ തർജമ</td>														
														<td><input type="text" name="b4c6" class="form-control ignore" id="b4c6" <?php if(isset($b4c6)) echo 'value='.$b4c6;?>></td>
														<td><input type="text" name="b4c12" class="form-control ignore" id="b4c12" <?php if(isset($b4c12)) echo 'value='.$b4c12;?>></td>					
													</tr>													
													<tr>
														<td>നമസ്കാരം</td>														
														<td><input type="text" name="b4c7" class="form-control ignore" id="b4c7" <?php if(isset($b4c7)) echo 'value='.$b4c7;?>></td>
														<td><input type="text" name="b4c13" class="form-control ignore" id="b4c13" <?php if(isset($b4c13)) echo 'value='.$b4c13;?>></td>
													</tr>																										
													<tr>
														<td>നമസ്കാരം തർജമ</td>														
														<td><input type="text" name="b4c8" class="form-control ignore" id="b4c8" <?php if(isset($b4c8)) echo 'value='.$b4c8;?>></td>
														<td><input type="text" name="b4c14" class="form-control ignore" id="b4c14" <?php if(isset($b4c14)) echo 'value='.$b4c14;?>></td>
													</tr>
													<tr>
														<td>ബഖറ ആദ്യ 17 ആയത്</td>														
														<td><input type="text" name="b4c9" class="form-control ignore" id="b4c9" <?php if(isset($b4c9)) echo 'value='.$b4c9;?>></td>
														<td><input type="text" name="b4c15" class="form-control ignore" id="b4c15" <?php if(isset($b4c15)) echo 'value='.$b4c15;?>></td>
													</tr>													
													<tr>
														<td>അമ്മ അവസാന 10 സൂറത്</td>														
														<td><input type="text" name="b4c10" class="form-control ignore" id="b4c10" <?php if(isset($b4c10)) echo 'value='.$b4c10;?>></td>
														<td><input type="text" name="b4c16" class="form-control ignore" id="b4c16" <?php if(isset($b4c16)) echo 'value='.$b4c16;?>></td>
													</tr>																										
												</table>
											</div>
											<div class="form-group">
												<label for="b4c17">മസീഹ് മൗഊദിൻറെ ഗ്രന്ഥങ്ങൾ വായിക്കുന്ന ഖാദിമീങ്ങളുടെ എണ്ണം </label>
												<input type="text" name="b4c17" class="form-control ignore" id="b4c17" <?php if(isset($b4c17)) echo 'value='.$b4c17;?>>
											</div>	
											<div class="form-group">
												<label for="b4c18">ഈ മാസം മജ്‌ലിസ് ഹുസ്‌നെ ബയാനിൻറെ കീഴിൽ മത്സരങ്ങൾ നടത്തിയോ?</label>
												<select id="b4c18" name="b4c18" class="form-control">
													<option <?php if(isset($b4c18) && $b4c18 == 'No') echo 'selected';?> value="No">No</option>
													<option <?php if(isset($b4c18) && $b4c18 == 'Yes') echo 'selected';?> value="Yes">Yes</option>
												</select>	
											</div>	
											<div class="form-group">
												<label for="b4c19">മത്സരങ്ങളുടെ എണ്ണം</label>
												<input type="text" name="b4c19" class="form-control ignore" id="b4c19" <?php if(isset($b4c19)) echo 'value='.$b4c19;?>>
											</div>
											<div class="form-group">
												<label for="b4c20">ഈ മാസം മജ്‍ലിസ് അൻസാറുള്ളാഹ് സുൽത്താനുൽ ഖലാമിന്റെ കീഴിൽ ഏതെങ്കിലും യോഗം നടത്തിയോ?</label>
												<select id="b4c20" name="b4c20" class="form-control">
													<option <?php if(isset($b4c20) && $b4c20 == 'No') echo 'selected';?> value="No">No</option>
													<option <?php if(isset($b4c20) && $b4c20 == 'Yes') echo 'selected';?> value="Yes">Yes</option>
												</select>	
											</div>
											<div class="form-group">
												<label for="b4c21">യോഗങ്ങളുടെ എണ്ണം</label>
												<input type="text" name="b4c21" class="form-control ignore" id="b4c21" <?php if(isset($b4c21)) echo 'value='.$b4c21;?>>
											</div>											
											<button type="button" class="btn btn-previous">Previous</button>
											<button type="button" class="btn btn-next" onclick="Block4(<?php echo $year.','.$month;?>)">Next</button>
											<button style="float:right" class="btn btn-success" onClick="Save4()">Save & Exit  <i class="fas fa-save"></i></button>
										</div>
									</fieldset>	
									<!------------------ BLOCK 4 End ------------------------->										
									
									<!------------------ BLOCK 5 ------------------------->	
									<fieldset id="f5">
										<div class="form-top">
											<div class="form-top-left">
												<h3>5. ശുഅബ തർബിയ്യത് </h3>
											</div>
										</div>
										<div class="form-bottom">
											<div class="form-group">
												<label for="b5c1">നാസിം തർബിയ്യത്തിൻറെ പേര്</label>
												<input type="text" name="b5c1" class="form-control" id="b5c1" <?php if(isset($b5c1)) echo 'value="'.$b5c1.'"'?>>
											</div>
											<div class="form-group">
												<label for="b5c2">ഈ മാസം എത്ര തർബിയ്യത് യോഗം സംഘടിപ്പിച്ചു?</label>
												<input type="text" name="b5c2" class="form-control ignore" id="b5c2" <?php if(isset($b5c2)) echo 'value='.$b5c2;?>>
											</div>
											<div class="form-group">
												<label for="b5c3">ഹാജരായ ഖുദാമുകളുടെ എണ്ണം</label>
												<input type="text" name="b5c3" class="form-control ignore" id="b5c3" <?php if(isset($b5c3)) echo 'value='.$b5c3;?>>
											</div>
											<div class="form-group">
												<label for="b5c4">ഈ മാസം അഞ്ചു നേര നമസ്കാരം നിർവഹിച്ച ഖുദാമുകളുടെ എണ്ണം</label>
												<input type="text" name="b5c4" class="form-control ignore" id="b5c4" <?php if(isset($b5c4)) echo 'value='.$b5c4;?>>
											</div>											
											<div class="form-group">
												<label for="b5c5">ഈ മാസം തഹജ്ജുദ് നമസ്കാരം നടത്തിയോ?</label>
												<select id="b5c5" name="b5c5" class="form-control">
													<option <?php if(isset($b5c5) && $b5c5 == 'No') echo 'selected';?> value="No">No</option>
													<option  <?php if(isset($b5c5) && $b5c5 == 'Yes') echo 'selected';?> value="Yes">Yes</option>
												</select>	
											</div>
											<div class="form-group">
												<label for="b5c6">ഹാജരായ ഖുദാമുകളുടെ എണ്ണം</label>
												<input type="text" name="b5c6" class="form-control ignore" id="b5c6" <?php if(isset($b5c6)) echo 'value='.$b5c6;?>>
											</div>
											<div class="form-group">
												<label for="b5c7">ഈ മാസം എത്ര ഖുദാമുകൾക് വ്യക്തിപരമായി തർബിയ്യത്തിൻറെ കണക്കെടുത്തു, എണ്ണം?</label>
												<input type="text" name="b5c7" class="form-control ignore" id="b5c7" <?php if(isset($b5c7)) echo 'value='.$b5c7;?>>
											</div>
											<div class="form-group">
												<label for="b5c8">ഈ മാസം തഹജ്ജുദ് നമസ്കാരം നിർവഹിച്ചവരുടെ എണ്ണം</label>
												<input type="text" name="b5c8" class="form-control ignore" id="b5c8" <?php if(isset($b5c8)) echo 'value='.$b5c8;?>>
											</div>
											<div class="form-group">
												<label for="b5c9">നിസാമെ വസിയ്യത്തിൽ ഉൾപ്പെട്ട ഖാദിമീങ്ങളുടെ എണ്ണം</label>
												<input type="text" name="b5c9" class="form-control ignore" id="b5c9" <?php if(isset($b5c9)) echo 'value='.$b5c9;?>>
											</div>
											<div class="form-group">
												<label for="b5c10">മജ്‌ലിസെ ആമിലയിൽ എത്ര അംഗങ്ങൾ മൂസിയാണ്?</label>
												<input type="text" name="b5c10" class="form-control ignore" id="b5c10" <?php if(isset($b5c10)) echo 'value='.$b5c10;?>>
											</div>
											<div class="form-group">
												<label for="b5c11">ഈ മാസം എത്ര ഖുദ്‌ദാമിനെ വസിയ്യത് പദ്ധതിയിൽ ഉൾപ്പെടുത്തി?</label>
												<input type="text" name="b5c11" class="form-control ignore" id="b5c11" <?php if(isset($b5c11)) echo 'value='.$b5c11;?>>
											</div>		
											<div class="form-group">
												<label for="b5c12">ഈ മാസം തർബിയ്യത് വിഷയങ്ങളിൽ പാംഫ്ലെറ് ഇറക്കിയോ?</label>
												<select id="b5c12" name="b5c12" class="form-control">
													<option <?php if(isset($b5c12) && $b5c12 == 'No') echo 'selected';?> value="No">No</option>
													<option <?php if(isset($b5c12) && $b5c12 == 'Yes') echo 'selected';?> value="Yes">Yes</option>
												</select>	
											</div>
											<div class="form-group">
												<label for="b5c13">ഇറക്കിയ പാംഫ്ലേറ്റിന്റെ കോപ്പി ചേർത്തോ?</label>
												<select id="b5c13" name="b5c13" class="form-control">
													<option <?php if(isset($b5c13) && $b5c13 == 'No') echo 'selected';?> value="No">No</option>
													<option <?php if(isset($b5c13) && $b5c13 == 'Yes') echo 'selected';?> value="Yes">Yes</option>
												</select>	
											</div>
											<div class="form-group">
												<label for="b5c14">ഈ മാസം ഹുസൂറിന് കത്തയച്ച ഖുദാമുകളുടെ എണ്ണം</label>
												<input type="text" name="b5c14" class="form-control ignore" id="b5c14" <?php if(isset($b5c14)) echo 'value='.$b5c14;?>>
											</div>	
											<div class="form-group">
												<label for="b5c15">ഹുസൂരിന്റെ ഖുതുബ സ്ഥിരമായി കേൾക്കുന്ന ഖുദാമുകളുടെ എണ്ണം</label>
												<input type="text" name="b5c15" class="form-control ignore" id="b5c15" <?php if(isset($b5c15)) echo 'value='.$b5c15;?>>
											</div>
											<div class="form-group">
												<label for="b5c16">വഖഫ് ആർസിയിൽ പങ്കെടുത്ത ഖുദാമുകളുടെ എണ്ണം</label>
												<input type="text" name="b5c16" class="form-control ignore" id="b5c16" <?php if(isset($b5c16)) echo 'value='.$b5c16;?>>
											</div>											
											
											<button type="button" class="btn btn-previous">Previous</button>
											<button type="button" class="btn btn-next" onclick="Block5(<?php echo $year.','.$month;?>)">Next</button>
											<button style="float:right" class="btn btn-success" onClick="Save5()">Save & Exit  <i class="fas fa-save"></i></button>
										</div>
									</fieldset>
									<!------------------ BLOCK 5 End ------------------------->

									<!------------------ BLOCK 6 ------------------------->	
									<fieldset id="f6">
										<div class="form-top">
											<div class="form-top-left">
												<h3>6. ശുഅബ തബ്‌ലീഗ് </h3>
											</div>
										</div>
										<div class="form-bottom">
											<div class="form-group">
												<label for="b6c1">നാസിം തബ്‌ലീഗിൻ്റെ പേര്</label>
												<input type="text" name="b6c1" class="form-control" id="b6c1" <?php if(isset($b6c1)) echo 'value="'.$b6c1.'"'?>>
											</div>
											<div class="form-group">
												<table border="1" width="90%">
													<tr>
														<td>ഈ മാസം സംഘടിപ്പിക്കുന്ന തബ്‌ലീഗ് പ്രോഗ്രാം</td>
														<td>പങ്കെടുത്ത ഖുദാമുകളുടെ എണ്ണം</td>
														<td>എത്ര പേർക് സന്ദേശം എത്തിച്ചു</td>
													</tr>
													<tr>
														<td>സോഷ്യൽ മീഡിയ</td>
														<td><input type="text" name="b6c2" class="form-control ignore" id="b6c2" <?php if(isset($b6c2)) echo 'value='.$b6c2;?>></td>
														<td><input type="text" name="b6c8" class="form-control ignore" id="b6c8" <?php if(isset($b6c8)) echo 'value='.$b6c8;?>></td>
													</tr>
													<tr>
														<td>ചോദ്യോത്തര സദസ്സ് (മജ്‌ലിസ് )</td>														
														<td><input type="text" name="b6c3" class="form-control ignore" id="b6c3" <?php if(isset($b6c3)) echo 'value='.$b6c3;?>></td>
														<td><input type="text" name="b6c9" class="form-control ignore" id="b6c9" <?php if(isset($b6c9)) echo 'value='.$b6c9;?>></td>
													</tr>													
													<tr>
														<td>ലിറ്ററേച്ചർ/ ലീഫ് ലെറ്റ് വിതരണം</td>														
														<td><input type="text" name="b6c4" class="form-control ignore" id="b6c4" <?php if(isset($b6c4)) echo 'value='.$b6c4;?>></td>
														<td><input type="text" name="b6c10" class="form-control ignore" id="b6c10" <?php if(isset($b6c10)) echo 'value='.$b6c10;?>></td>
													</tr>																										
													<tr>
														<td>ബുക്ക് സ്റ്റാൾ</td>														
														<td><input type="text" name="b6c5" class="form-control ignore" id="b6c5" <?php if(isset($b6c5)) echo 'value='.$b6c5;?>></td>
														<td><input type="text" name="b6c11" class="form-control ignore" id="b6c11" <?php if(isset($b6c11)) echo 'value='.$b6c11;?>></td>
													</tr>
													<tr>
														<td>തബ്ലീഗ് യോഗങ്ങൾ</td>														
														<td><input type="text" name="b6c6" class="form-control ignore" id="b6c6" <?php if(isset($b6c6)) echo 'value='.$b6c6;?>></td>
														<td><input type="text" name="b6c12" class="form-control ignore" id="b6c12" <?php if(isset($b6c12)) echo 'value='.$b6c12;?>></td>
													</tr>													
													<tr>
														<td>MTA</td>														
														<td><input type="text" name="b6c7" class="form-control ignore" id="b6c7" <?php if(isset($b6c7)) echo 'value='.$b6c7;?>></td>
														<td><input type="text" name="b6c13" class="form-control ignore" id="b6c13" <?php if(isset($b6c13)) echo 'value='.$b6c13;?>></td>
													</tr>																										
												</table>
											</div>
											<div class="form-group">
												<label for="b6c14">ഈ മാസം 10 ദിന തബ്‌ലീഗിൻ്റെ കീഴിൽ പ്രോഗ്രാം നടത്തിയോ?</label>
												<select id="b6c14" name="b6c14" class="form-control">
													<option <?php if(isset($b6c14) && $b6c14 == 'No') echo 'selected';?> value="No">No</option>
													<option <?php if(isset($b6c14) && $b6c14 == 'Yes') echo 'selected';?> value="Yes">Yes</option>
												</select>	
											</div>											
											<div class="form-group">
												<label for="b6c15">എത്ര പേർ പങ്കെടുത്തു?</label>
												<input type="text" name="b6c15" class="form-control ignore" id="b6c15" <?php if(isset($b6c15)) echo 'value='.$b6c15;?>>
											</div>
											<div class="form-group">
												<label for="b6c16">പങ്കെടുത്ത ഖുദാമുകളുടെ പട്ടിക ചേർത്തിട്ടുണ്ടോ?</label>
												<select id="b6c16" name="b6c16" class="form-control">
													<option <?php if(isset($b6c16) && $b6c16 == 'No') echo 'selected';?> value="No">No</option>
													<option <?php if(isset($b6c16) && $b6c16 == 'Yes') echo 'selected';?> value="Yes">Yes</option>
												</select>	
											</div>
											<div class="form-group">
												<label for="b6c17">ഈ മാസം ദാഈൻ  ഖുദാമിന് തബ്‌ലീഗ് ക്ലാസ് സംഘടിപ്പിച്ചോ?</label>
												<select id="b6c17" name="b6c17" class="form-control">
													<option <?php if(isset($b6c17) && $b6c17 == 'No') echo 'selected';?> value="No">No</option>
													<option <?php if(isset($b6c17) && $b6c17 == 'Yes') echo 'selected';?> value="Yes">Yes</option>
												</select>	
											</div>											
											<div class="form-group">
												<label for="b6c18">Date</label>
												<input type="text" name="b6c18" class="form-control ignore" id="b6c18" <?php if(isset($b6c18)) echo 'value='.$b6c18;?>>
											</div>
											<div class="form-group">
												<label for="b6c19">എത്ര പേർ പങ്കെടുത്തു?</label>
												<input type="text" name="b6c19" class="form-control ignore" id="b6c19" <?php if(isset($b6c19)) echo 'value='.$b6c19;?>>
											</div>											
											<div class="form-group">
												<label for="b6c20">ഓരോ 6 മാസത്തിലും തബ്‌ലീഗ് വാരം സംഘടിപ്പിച്ചോ?</label>
												<select id="b6c20" name="b6c20" class="form-control">
													<option <?php if(isset($b6c18) && $b6c18 == 'No') echo 'selected';?> value="No">No</option>
													<option <?php if(isset($b6c18) && $b6c18 == 'Yes') echo 'selected';?> value="Yes">Yes</option>
												</select>	
											</div>
											<div class="form-group">
												<label for="b6c21">എണ്ണം</label>
												<input type="text" name="b6c21" class="form-control ignore" id="b6c21" <?php if(isset($b6c21)) echo 'value='.$b6c21;?>>
											</div>																						
											<div class="form-group">
												<label for="b6c22">Date</label>
												<input type="text" name="b6c22" class="form-control ignore" id="b6c22" <?php if(isset($b6c22)) echo 'value='.$b6c22;?>>
											</div>											
											<div class="form-group">
												<label for="b6c23">പ്രത്യേക ദാഈൻ ഖുദാമുകളുടെ എണ്ണം</label>
												<input type="text" name="b6c23" class="form-control ignore" id="b6c23" <?php if(isset($b6c23)) echo 'value='.$b6c23;?>>
											</div>																																	
											<div class="form-group">
												<label for="b6c24">ഈ മാസം എത്ര ബയ്യത്തുകൾ ചെയ്യിപ്പിച്ചു?</label>
												<input type="text" name="b6c24" class="form-control ignore" id="b6c24" <?php if(isset($b6c24)) echo 'value='.$b6c24;?>>
											</div>
											<div class="form-group">
												<label for="b6c25">ബയ്യത് ഫോറം കോപ്പി കൂടെ ചേർത്തിട്ടുണ്ടോ?</label>
												<select id="b6c25" name="b6c25" class="form-control">
													<option <?php if(isset($b6c25) && $b6c25 == 'No') echo 'selected';?> value="No">No</option>
													<option <?php if(isset($b6c25) && $b6c25 == 'Yes') echo 'selected';?> value="Yes">Yes</option>
												</select>	
											</div>											
											<button type="button" class="btn btn-previous">Previous</button>
											<button type="button" class="btn btn-next" onclick="Block6(<?php echo $year.','.$month;?>)">Next</button>
											<button style="float:right" class="btn btn-success" onClick="Save6()">Save & Exit  <i class="fas fa-save"></i></button>
										</div>
									</fieldset>
									<!------------------ BLOCK 6 End ------------------------->									
								</form>		
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Javascript -->
			<script src="assets/js/jquery-1.11.1.min.js"></script>
			<script src="assets/js/jquery-ui.min.js"></script>	
			<script src="assets/bootstrap/js/bootstrap.min.js"></script>
			<script src="assets/js/jquery.backstretch.min.js"></script>
			<script src="assets/js/retina-1.1.0.min.js"></script>
			<script src="assets/js/scripts.js"></script>
			<script src="assets/js/blockFunctions.js"></script>
			<script src="assets/js/saveFunctions.js"></script>
			<script>
				$( document ).ready(function() {
					var status = "<?php echo $report['status'] ?>";
					if(status != 0)
					{
						status = parseInt(status) + 1;
						var fset = '#f' + status;	
						
						$('#f1').fadeOut();
						$(fset).fadeIn();						
					}
				});

				$(function() {
					var b1c2 = { dateFormat:"dd-mm-yy"}; 
					$( "#b1c2" ).datepicker(b1c2);
					
					var b1c4 = { dateFormat:"dd-mm-yy"}; 
					$( "#b1c4" ).datepicker(b1c4);					
					
					var b2c2 = { dateFormat:"dd-mm-yy"};
					$( "#b2c2" ).datepicker(b2c2);
					
					var b2c7 = { dateFormat:"dd-mm-yy"};
					$( "#b2c7" ).datepicker(b2c7);					
					
					var b3c3 = { dateFormat:"dd-mm-yy"};
					$( "#b3c3" ).datepicker(b3c3);

					var b6c18 = { dateFormat:"dd-mm-yy"};
					$( "#b6c18" ).datepicker(b6c18);
					
					var b6c22 = { dateFormat:"dd-mm-yy"};
					$( "#b6c22" ).datepicker(b6c22);										
				});
			</script>
		</body>
	</html>
<?php
}
else
	header("Location:loginPage.php");