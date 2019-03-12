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
	
	$reportQuery = mysqli_query($con,"SELECT * FROM reports WHERE jamath = $jamathId ORDER BY created_on DESC LIMIT 1") or die(mysqli_error($con));
	$report= mysqli_fetch_array($reportQuery,MYSQLI_ASSOC);

	if($report != null)
	{	
		$reportId = $report['id'];
		
		//BLOCK 1 assignment
		$block1Query = mysqli_query($con,"SELECT * FROM block1 WHERE report_id = $reportId") or die(mysqli_error($con));
		$block1= mysqli_fetch_array($block1Query,MYSQLI_ASSOC);	
		$b1c1 = $block1['c1'];
		$b1c3 = $block1['c3'];
		$b1c8 = $block1['c8'];
		$b1c9 = $block1['c9'];
		$b1c12 = $block1['c12'];
		$b1c13 = $block1['c13'];
		$b1c14 = $block1['c14'];
		
		//BLOCK 2 assignment
		$block2Query = mysqli_query($con,"SELECT * FROM block2 WHERE report_id = $reportId") or die(mysqli_error($con));
		$block2= mysqli_fetch_array($block2Query,MYSQLI_ASSOC);	
		$b2c1 = $block2['c1'];
		$b2c4 = $block2['c4'];
		$b2c5 = $block2['c5'];
		$b2c6 = $block2['c6'];
		$b2c7 = $block2['c7'];		
		$b2c8 = $block2['c8'];		
	}
?>
	<!DOCTYPE html>
	<html lang="en">
		<head>
			<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<title>Kannur Report</title>

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
					<a class="navbar-brand" href="index.html">Khuddamul Ahmadiyya Bharath Report Form</a>
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
								<h1><strong>Report Form</strong></h1>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6 col-sm-offset-3 form-box">
								<form role="form" action="insert.php" method="post" class="registration-form">
										
									<fieldset>
										<div class="form-top">
											<div class="form-top-left">
												<h3>General Info</h3>
											</div>
										</div>
										<div class="form-bottom">
											<div class="form-group">
												<label for="b1c1">പ്രാദേശിക നമ്പർ</label>
												<input type="text" name="b1c1" class="form-control" id="b1c1" <?php if(isset($b1c1)) echo 'value='.$b1c1;?>>
											</div>
											<div class="form-group">
												<label for="b1c2">തീയതി </label>
												<input type="text" name="b1c2" class="form-control" id="b1c2" value="<?php echo date('d-m-Y'); ?>">
											</div>
											<div class="form-group">
												<label for="b1c3">വന്ന ഓഫീസ് നമ്പർ </label>
												<input type="text" name="b1c3" class="form-control" id="b1c3" <?php if(isset($b1c3)) echo 'value='.$b1c3;?>>
											</div>										
											<div class="form-group">
												<label for="b1c4">വന്ന തീയതിയും സീലും </label>
												<input type="text" name="b1c4" class="form-control" id="b1c4">
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
												<input type="text" name="b1c12" class="form-control" id="b1c12" <?php if(isset($b1c12)) echo 'value='.$b1c12;?>>
											</div>
											<div class="form-group">
												<label for="b1c13">Email</label>
												<input type="text" name="b1c13" class="form-email form-control" id="b1c13" <?php if(isset($b1c13)) echo 'value='.$b1c13;?>>
											</div>
											<div class="form-group">
												<label for="b1c14">Mobile</label>
												<input type="text" name="b1c14" class="form-control" id="b1c14" <?php if(isset($b1c14)) echo 'value='.$b1c14;?>>
											</div>										
											<button type="button" class="btn btn-next">Next</button>
										</div>
									</fieldset>


									<fieldset>
										<div class="form-top">
											<div class="form-top-left">
												<h3>ശുഅബ ഇഅതിമാദ്</h3>
											</div>
										</div>
										<div class="form-bottom">
											<div class="form-group">
												<label for="b2c1">മുഅതമിദിൻറെ പേര്</label>
												<input type="text" name="b2c1" class="form-control" id="b2c1" <?php if(isset($b2c1)) echo 'value='.$b2c1;?>>
											</div>
											<div class="form-group">
												<label for="b2c2">ആമില യോഗം നടന്ന തീയതി</label>
												<input type="text" name="b2c2" class="form-control ignore" id="b2c2">
											</div>
											<div class="form-group">
												<label for="b2c3">യോഗത്തിൻറെ റിപ്പോർട്ട് വേറെ പേപ്പറിൽ ചേർത്തിട്ടുണ്ടോ?</label>
												<select id="b2c3" name="b2c3" class="form-control">
													<option value=""></option>
													<option value="Yes">Yes</option>
													<option value="No">No</option>													
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
												<input type="text" name="b2c7" class="form-control ignore" id="b2c7" <?php if(isset($b2c7)) echo 'value='.date('d-m-Y',strtotime($b2c1));?>>
											</div>
											<div class="form-group">
												<label for="b2c8">നമസ്കാരവും, മജ്‌ലിസെ ശൂറ തീരുമാനപ്രകാരം പ്രവർത്തനം നടക്കുന്നതിന് മജ്‌ലിസെ ആമില യോഗം നടത്തിയോ? </label>
												<select id="b2c8" name="b2c8" class="form-control">
													<option <?php if(isset($b2c8) && $b2c8 == 'Yes') echo 'selected';?> value="Yes">Yes</option>
													<option <?php if(isset($b2c8) && $b2c8 == 'No') echo 'selected';?> value="No">No</option>													
												</select>
											</div>																																	
											<button type="button" class="btn btn-previous">Previous</button>
											<button type="button" class="btn btn-next">Next</button>
										</div>
									</fieldset>
									
									<fieldset>
										<div class="form-top">
											<div class="form-top-left">
												<h3>ശുഅബ തജ്‌നീദ് </h3>
											</div>
										</div>
										<div class="form-bottom">
											<div class="form-group">
												<label for="b3c1">നാസിം തജ്‌നീദിൻറെ പേര്</label>
												<input type="text" name="b3c1" class="form-control" id="b3c1" <?php if(isset($b3c1)) echo 'value='.$b3c1;?>>
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
												<input type="text" name="b3c3" class="form-control ignore" id="b3c3">
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
											<button type="button" class="btn btn-next">Next</button>
										</div>
									</fieldset>
									
									
									<fieldset>
										<div class="form-top">
											<div class="form-top-left">
												<h3>ശുഅബ തഅലിം</h3>
											</div>
										</div>
										<div class="form-bottom">
											<div class="form-group">
												<label for="b4c1">നാസിം തഅലിമിൻറെ പേര്</label>
												<input type="text" name="b4c1" class="form-control" id="b4c1" <?php if(isset($b4c1)) echo 'value='.$b4c1;?>>
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
												<input type="text" name="b4c3" class="form-control" id="b4c3">
											</div>
											<div class="form-group">
												<label for="b4c4">ഹാജരായ ഖാദിമീങ്ങളുടെ എണ്ണം</label>
												<input type="text" name="b4c4" class="form-control ignore" id="b4c4">
											</div>

												<table border="1" width="90%">
													<tr>
														<td><label>എണ്ണം എഴുതുക</label></td>
														<td>നോക്കി ഓതൽ</td>
														<td>ഖുർആൻ തർജമ</td>
														<td>നമസ്കാരം</td>
														<td>നമസ്കാരം തർജമ</td>
														<td>ബഖറ ആദ്യ 17 ആയത്</td>
														<td>അമ്മ അവസാന 10 സൂറത്</td>
													</tr>
													<tr>
														<td>അറിയുന്ന ഖുദ്ദആം</td>
														<td><input type="text" name="b4c5" class="form-control ignore" id="b4c5"></td>
														<td><input type="text" name="b4c6" class="form-control ignore" id="b4c6"></td>
														<td><input type="text" name="b4c7" class="form-control ignore" id="b4c7"></td>
														<td><input type="text" name="b4c8" class="form-control ignore" id="b4c8"></td>
														<td><input type="text" name="b4c9" class="form-control ignore" id="b4c9"></td>
														<td><input type="text" name="b4c10" class="form-control ignore" id="b4c10"></td>														
													</tr>
													<tr>
														<td>പഠിക്കുന്ന ഖുദ്ദആം</td>
														<td><input type="text" name="b4c11" class="form-control ignore" id="b4c11"></td>
														<td><input type="text" name="b4c12" class="form-control ignore" id="b4c12"></td>
														<td><input type="text" name="b4c13" class="form-control ignore" id="b4c13"></td>
														<td><input type="text" name="b4c14" class="form-control ignore" id="b4c14"></td>
														<td><input type="text" name="b4c15" class="form-control ignore" id="b4c15"></td>
														<td><input type="text" name="b4c16" class="form-control ignore" id="b4c16"></td>														
													</tr>													
												</table>
											<button type="button" class="btn btn-previous">Previous</button>
											<button type="button" class="btn btn-next">Next</button>
										</div>
									</fieldset>									
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
			<script>
				$(function() {
					var pickerOpts1 = { dateFormat:"dd-mm-yy"}; 
					$( "#b1c2" ).datepicker(pickerOpts1);
					
					var pickerOpts2 = { dateFormat:"dd-mm-yy"}; 
					$( "#b1c4" ).datepicker(pickerOpts2);					
					
					var pickerOpts3 = { dateFormat:"dd-mm-yy"};
					$( "#b2c2" ).datepicker(pickerOpts3);
					
					var pickerOpts4 = { dateFormat:"dd-mm-yy"};
					$( "#b2c7" ).datepicker(pickerOpts4);					
				});
			</script>
		</body>
	</html>
<?php
}
else
	header("Location:loginPage.php");