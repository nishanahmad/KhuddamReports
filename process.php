<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require 'connect.php';
session_start();
if(isset($_SESSION["user_name"]))
{
	$error = null;	
	$jamath = $_SESSION["jamath"];
	$created_on = date('Y-m-d H:i:s');		

	if(isset($_POST['block1']))
	{
		$block1 = json_decode($_POST['block1'],true);
		$b1c1 = $block1["c1"];
		$b1c2 = date('Y-m-d',strtotime($block1['c2']));
		$b1c3 = $block1["c3"];
		$b1c4 = date('Y-m-d',strtotime($block1['c4']));
		$b1c5 = $block1["c5"];
		$b1c6 = $block1["c6"];
		$b1c7 = $block1["c7"];
		$b1c8 = $block1["c8"];
		$b1c9 = $block1["c9"];
		$b1c10 = $block1["c10"];
		$b1c11 = $block1["c11"];
		$b1c12 = $block1["c12"];
		$b1c13 = $block1["c13"];
		$b1c14 = $block1["c14"];

		$query="INSERT INTO reports (jamath,year,month,created_on,status)
			 VALUES
			 ('$jamath','$b1c11','$b1c10','$created_on',1)";
		$report = mysqli_query($con, $query);
		if($report)
		{
			$reportId = $con->insert_id;		
			$query1="INSERT INTO block1 (report_id,c1,c2,c3,c4,c5,c6,c7,c8,c9,c10,c11,c12,c13,c14)
				 VALUES
				 ($reportId,'$b1c1','$b1c2','$b1c3','$b1c4','$b1c5','$b1c6','$b1c7','$b1c8','$b1c9','$b1c10','$b1c11','$b1c12','$b1c13','$b1c14')";

			$insert1 = mysqli_query($con, $query1);	
			if(!$insert1)
				$error =  mysqli_error($con);
		}
		else
		{
			$error = mysqli_error($con);
		}

		echo $error;

		/*
		$fp = fopen('results.json', 'w');
		fwrite($fp, json_encode(mysqli_error($con)));
		fclose($fp);	
		*/
	}
	else if(isset($_POST['block2']))
	{
		$block2 = json_decode($_POST['block2'],true);
		$year = (int)$block2["year"];
		$month = (int)$block2["month"];
		$reportQuery = mysqli_query($con, "SELECT id FROM reports WHERE jamath = $jamath AND year = $year AND month = $month");
		if($reportQuery)
		{
			$report = mysqli_fetch_Array($reportQuery,MYSQLI_ASSOC);
			$reportId = $report['id'];			
			
			$b2c1 = $block2["c1"];
			if(!empty($block2['c2']))
				$b2c2 = date('Y-m-d',strtotime($block2['c2']));
			else
				$b2c2 = null;
			$b2c3 = $block2["c3"];
			$b2c4 = $block2["c4"];
			$b2c5 = $block2["c5"];
			$b2c6 = $block2["c6"];
			if(!empty($block2['c7']))
				$b2c7 = date('Y-m-d',strtotime($block2['c7']));
			else
				$b2c7 = null;
			$b2c8 = $block2["c8"];			
			
			$query2="INSERT INTO block2 (report_id,c1,c2,c3,c4,c5,c6,c7,c8)
				 VALUES
				 ($reportId,'$b2c1','$b2c2','$b2c3','$b2c4','$b2c5','$b2c6','$b2c7','$b2c8')";

			$insert2 = mysqli_query($con, $query2);	
			if(!$insert2)
				$error =  mysqli_error($con);
			else
			{
				$updateStatus = mysqli_query($con,"UPDATE reports SET status=2 WHERE id='$reportId'");
				if(!$updateStatus)
					$error =  mysqli_error($con);
					
			}
		}
		else
		{
			$error = mysqli_error($con);
		}
		
		echo $error;
	}
	
}
?>