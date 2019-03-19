<?php
session_start();
if(isset($_SESSION["user_name"]))
{
	require 'connect.php';
	require 'monthMap.php';

	$jamathId = (int)$_SESSION["jamath"];
	$jamathQuery = mysqli_query($con,"SELECT name FROM jamaths WHERE id = $jamathId ") or die(mysqli_error($con));	
	$jamath= mysqli_fetch_array($jamathQuery,MYSQLI_ASSOC);
	
	if(isset($_GET['year']))
		$year = (int)$_GET['year'];
	else
		$year = (int)date('Y');	
	
	$years = mysqli_query($con,"SELECT DISTINCT year FROM reports WHERE jamath = $jamathId ORDER BY year") or die(mysqli_error($con));	
	foreach($years as $y)
	{
		$yearList[] = (int)$y['year']; 
	}
	if(empty($yearList))
		$yearList[] = (int)date('Y');	
	else
		$yearList[] = $y['year'] +1; 
	
	$reports = mysqli_query($con,"SELECT * FROM reports WHERE jamath = $jamathId AND year = $year ORDER BY month") or die(mysqli_error($con));
	foreach($reports as $report)
	{
		$reportMap[$report['month']] = $report;
		$reportMap[$report['month']]['percentage'] = $report['status']/20*100;
	}
?>
	<!DOCTYPE html>
	<html lang="en">
		<head>
			<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<title>Pending list <?php echo $year;?></title>

			<!-- CSS -->
			<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
			<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
			<link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
			<link rel="stylesheet" href="assets/css/form-elements.css">
			<link rel="stylesheet" href="assets/css/style.css">
			<link rel="stylesheet" href="assets/css/jquery-ui.css">
			<link rel="stylesheet" href="assets/css/loadBar.css">

			<!-- Favicon and touch icons -->
			<link rel="shortcut icon" href="assets/ico/favicon.png">
			<link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
			<link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
			<link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
			<link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
		</head>

		<body>
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
								<h1><strong><?php echo $jamath['name'].' '.$year;?></strong></h1>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-8 col-sm-offset-2 form-box">
								<form role="form" action="" method="post" class="registration-form">
									<fieldset>
										<div class="form-top">
											<div align="center">
												<br/>
												<div class="form-group">
													<select name="year" id="year" onchange="document.location.href = 'index.php?year=' + this.value" class="form-control" style="width:30%">				<?php
														foreach($yearList as $y)
														{																																			?>
															<option value="<?php echo $y;?>" <?php if($year == $y) echo 'selected';?>><?php echo $y;?></option> 						<?php
														}																																			?>
													</select>
												</div>
												<br/>
												<div class="form-group">											
													<table border="1">																	<?php
													for($i=1;$i<=12;$i++)
													{																		?>
														<tr>
															<td style="padding:10px;"><?php echo getMonth($i);?></td>
															<td style="padding:10px;">										<?php 
																if(isset($reportMap[$i]))
																{
																	$percentage = $reportMap[$report['month']]['percentage']?>
																	<div class="meter">
																	  <span style="width:<?php echo $percentage;?>%"></span>
																	  <p><?php echo $percentage;?>%</p>
																	</div><?php																	
																}
																else
																{?>
																	<div class="meter">
																	  <span style="width:0%"></span>
																	  <p>0%</p>
																	</div>															<?php																																		
																}																	?>
															</td>
															<td style="padding:15px;">																				<?php 
																if(!isset($reportMap[$i]))
																{																									?>
																	<a href="new.php?year=<?php echo $year.'&month='.$i;?>" class="btn btn-info">Create Report</a>									<?php	
																}																									?>	
															</td>
														</tr>																										<?php
													}																												?>
													</table>
												</div>	
											</div>
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
				$( document ).ready(function() {
					var bar = $('span');
					var p = $('p');

					var width = bar.attr('style');
					width = width.replace("width:", "");
					width = width.substr(0, width.length-1);


					var interval;
					var start = 0; 
					var end = parseInt(width);
					var current = start;

					var countUp = function() {
					  current++;
					  p.html(current + "%");
					  
					  if (current === end) {
						clearInterval(interval);
					  }
					};
					interval = setInterval(countUp, (1000 / (end + 1)));
				});
			</script>			
		</body>
	</html>
<?php
}
else
	header("Location:loginPage.php");