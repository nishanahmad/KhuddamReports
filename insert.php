<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require 'connect.php';
session_start();
if(isset($_SESSION["user_name"]))
{
	$jamath = $_SESSION["jamath"];
	$year = $_POST['b1c11'];
	$month = $_POST['b1c10'];
	$created_on = date('Y-m-d H:i:s');		

	$query="INSERT INTO reports (jamath,year,month,created_on)
		 VALUES
		 ('$jamath','$year','$month','$created_on')";
	$report = mysqli_query($con, $query) or die(mysqli_error($con));
	$reportId = $con->insert_id;

	$b1c1 = $_POST['b1c1'];
	$b1c2 = date("Y-m-d", strtotime($_POST['b1c2']));
	$b1c3 = $_POST['b1c3'];
	$b1c4 = date("Y-m-d", strtotime($_POST['b1c4']));
	$b1c5 = $_POST['b1c5'];
	$b1c6 = $_POST['b1c6'];
	$b1c7 = $_POST['b1c7'];
	$b1c8 = $_POST['b1c8'];
	$b1c9 = $_POST['b1c9'];
	$b1c10 = $_POST['b1c10'];
	$b1c11 = $_POST['b1c11'];
	$b1c12 = $_POST['b1c12'];
	$b1c13 = $_POST['b1c13'];
	$b1c14 = $_POST['b1c14'];
	
	
	$query1="INSERT INTO block1 (report_id,c1,c2,c3,c4,c5,c6,c7,c8,c9,c10,c11,c12,c13,c14)
		 VALUES
		 ($reportId,'$b1c1','$b1c2','$b1c3','$b1c4','$b1c5','$b1c6','$b1c7','$b1c8','$b1c9','$b1c10','$b1c11','$b1c12','$b1c13','$b1c14')";

	$block1 = mysqli_query($con, $query1) or die(mysqli_error($con));

	$b2c1 = $_POST['b2c1'];
	if(!empty($_POST['b2c2']))
		$b2c2 = date("Y-m-d", strtotime($_POST['b2c2']));
	else
		$b2c2 = null;
	
	$b2c3 = $_POST['b2c3'];
	$b2c4 = $_POST['b2c4'];
	$b2c5 = $_POST['b2c5'];
	$b2c6 = $_POST['b2c6'];
	if(!empty($_POST['b2c7']))
		$b2c7 = date("Y-m-d", strtotime($_POST['b2c7']));
	else
		$b2c7 = null;
	
	$b2c8 = $_POST['b2c8'];
	
	$query2="INSERT INTO block2 (report_id,c1,c2,c3,c4,c5,c6,c7,c8)
		 VALUES
		 ($reportId,'$b2c1',".var_export($b2c2, true).",'$b2c3','$b2c4','$b2c5','$b2c6',".var_export($b2c7, true).",'$b2c8')";

	$block2 = mysqli_query($con, $query2) or die(mysqli_error($con));	

		
	header( "Location: pdf/generate.php?id=$reportId" );

}
else
	header( "Location: index.php" );
?> 