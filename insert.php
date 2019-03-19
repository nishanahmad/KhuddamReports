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

// BLOCK 1
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


// BLOCK 2
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


// BLOCK 3		
	$b3c1 = $_POST['b3c1'];
	$b3c2 = $_POST['b3c2'];
	if(!empty($_POST['b3c3']))
		$b3c3 = date("Y-m-d", strtotime($_POST['b3c3']));
	else
		$b3c3 = null;	
	$b3c4 = $_POST['b3c4'];
	$b3c5 = $_POST['b3c5'];
	$b3c6 = $_POST['b3c6'];
	
	$query3="INSERT INTO block3 (report_id,c1,c2,c3,c4,c5,c6)
		 VALUES
		 ($reportId,'$b3c1','$b3c2',".var_export($b3c3, true).",'$b3c4','$b3c5','$b3c6')";

	$block3 = mysqli_query($con, $query3) or die(mysqli_error($con));	
	
// BLOCK 4		
	$b4c1 = $_POST['b4c1'];
	$b4c2 = $_POST['b4c2'];
	$b4c3 = $_POST['b4c3'];
	$b4c4 = $_POST['b4c4'];
	$b4c5 = $_POST['b4c5'];
	$b4c6 = $_POST['b4c6'];	
	$b4c7 = $_POST['b4c7'];	
	$b4c8 = $_POST['b4c8'];	
	$b4c9 = $_POST['b4c9'];	
	$b4c10 = $_POST['b4c10'];	
	$b4c11 = $_POST['b4c11'];	
	$b4c12 = $_POST['b4c12'];	
	$b4c13 = $_POST['b4c13'];	
	$b4c14 = $_POST['b4c14'];	
	$b4c15 = $_POST['b4c15'];	
	$b4c16 = $_POST['b4c16'];	
	$b4c17 = $_POST['b4c17'];	
	$b4c18 = $_POST['b4c18'];	
	$b4c19 = $_POST['b4c19'];	
	$b4c20 = $_POST['b4c20'];	
	$b4c21 = $_POST['b4c21'];	
				
	$query4="INSERT INTO block4 (report_id,c1,c2,c3,c4,c5,c6,c7,c8,c9,c10,c11,c12,c13,c14,c15,c16,c17,c18,c19,c20,c21)
		 VALUES
		 ($reportId,'$b4c1','$b4c2','$b4c3','$b4c4','$b4c5','$b4c6','$b4c7','$b4c8','$b4c9','$b4c10','$b4c11','$b4c12','$b4c13',
		  '$b4c14','$b4c15','$b4c16','$b4c17','$b4c18','$b4c19','$b4c20','$b4c21')";

	$block4 = mysqli_query($con, $query4) or die(mysqli_error($con));
	
// BLOCK 5
	$b5c1 = $_POST['b5c1'];
	$b5c2 = $_POST['b5c2'];
	$b5c3 = $_POST['b5c3'];
	$b5c4 = $_POST['b5c4'];
	$b5c5 = $_POST['b5c5'];
	$b5c6 = $_POST['b5c6'];	
	$b5c7 = $_POST['b5c7'];	
	$b5c8 = $_POST['b5c8'];	
	$b5c9 = $_POST['b5c9'];	
	$b5c10 = $_POST['b5c10'];	
	$b5c11 = $_POST['b5c11'];	
	$b5c12 = $_POST['b5c12'];	
	$b5c13 = $_POST['b5c13'];	
	$b5c14 = $_POST['b5c14'];	
	$b5c15 = $_POST['b5c15'];	
	$b5c16 = $_POST['b5c16'];	
				
	$query5="INSERT INTO block5 (report_id,c1,c2,c3,c4,c5,c6,c7,c8,c9,c10,c11,c12,c13,c14,c15,c16)
		 VALUES
		 ($reportId,'$b5c1','$b5c2','$b5c3','$b5c4','$b5c5','$b5c6','$b5c7','$b5c8','$b5c9','$b5c10','$b5c11','$b5c12','$b5c13',
		  '$b5c14','$b5c15','$b5c16')";

	$block5 = mysqli_query($con, $query5) or die(mysqli_error($con));

// BLOCK 6
	$b6c1 = $_POST['b6c1'];
	$b6c2 = $_POST['b6c2'];
	$b6c3 = $_POST['b6c3'];
	$b6c4 = $_POST['b6c4'];
	$b6c5 = $_POST['b6c5'];
	$b6c6 = $_POST['b6c6'];	
	$b6c7 = $_POST['b6c7'];	
	$b6c8 = $_POST['b6c8'];	
	$b6c9 = $_POST['b6c9'];	
	$b6c10 = $_POST['b6c10'];	
	$b6c11 = $_POST['b6c11'];	
	$b6c12 = $_POST['b6c12'];	
	$b6c13 = $_POST['b6c13'];	
	$b6c14 = $_POST['b6c14'];	
	$b6c15 = $_POST['b6c15'];	
	$b6c16 = $_POST['b6c16'];
	$b6c17 = $_POST['b6c17'];
	if(!empty($_POST['b6c18']))
		$b6c18 = date("Y-m-d", strtotime($_POST['b6c18']));
	else
		$b6c18 = null;	
	
	$b6c19 = $_POST['b6c19'];
	$b6c20 = $_POST['b6c20'];
	$b6c21 = $_POST['b6c21'];
	if(!empty($_POST['b6c22']))
		$b6c22 = date("Y-m-d", strtotime($_POST['b6c22']));
	else
		$b6c22 = null;
	$b6c23 = $_POST['b6c23'];
	$b6c24 = $_POST['b6c24'];
	$b6c25 = $_POST['b6c25'];	
				
	$query6="INSERT INTO block6 (report_id,c1,c2,c3,c4,c5,c6,c7,c8,c9,c10,c11,c12,c13,c14,c15,c16)
		 VALUES
		 ($reportId,'$b6c1','$b6c2','$b6c3','$b6c4','$b6c5','$b6c6','$b6c7','$b6c8','$b6c9','$b6c10','$b6c11','$b6c12','$b6c13',
		  '$b6c14','$b6c15','$b6c16','$b6c17',".var_export($b6c18, true).",'$b6c19','$b6c20','$b6c21',".var_export($b6c22, true).",'$b6c23','$b6c24','$b6c25')";

	$block6 = mysqli_query($con, $query6) or die(mysqli_error($con));	
	
	header( "Location: pdf/generate.php?id=$reportId" );
}
else
	header( "Location: index.php" );
?>