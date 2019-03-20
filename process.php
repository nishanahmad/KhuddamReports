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
	mysqli_autocommit($con,FALSE);	

	//BLOCK 1
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

		$search = mysqli_query($con, "SELECT * FROM reports WHERE jamath=$jamath AND year=$b1c11 AND month=$b1c10");
		if(mysqli_num_rows($search) <=0)
		{
			$query="INSERT INTO reports (jamath,year,month,created_on,status)
				 VALUES
				 ('$jamath','$b1c11','$b1c10','$created_on',1)";
			$report = mysqli_query($con, $query);			
			if($report)
				$reportId = $con->insert_id;
		}
		else
		{
			$report = mysqli_fetch_Array($search,MYSQLI_ASSOC);
			$reportId = $report['id'];
		}

		if(isset($reportId))
		{
			$search1 = 	mysqli_query($con, "SELECT * FROM block1 WHERE report_id=$reportId");
			if(mysqli_num_rows($search1) <=0)
			{
				$query1="INSERT INTO block1 (report_id,c1,c2,c3,c4,c5,c6,c7,c8,c9,c10,c11,c12,c13,c14)
					 VALUES
					 ($reportId,'$b1c1','$b1c2','$b1c3','$b1c4','$b1c5','$b1c6','$b1c7','$b1c8','$b1c9','$b1c10','$b1c11','$b1c12','$b1c13','$b1c14')";

				$insert1 = mysqli_query($con, $query1);	
				if(!$insert1)
					$error =  mysqli_error($con);				
			}
			else
			{				
				$query1="UPDATE block1 SET report_id='$reportId',c1='$b1c1',c2='$b1c2',c3='$b1c3',c4='$b1c4',c5='$b1c5',
						 c6='$b1c6',c7='$b1c7',c8='$b1c8',c9='$b1c9',c10='$b1c10',c11='$b1c11',c12='$b1c12',
						 c13='$b1c13',c14='$b1c14'";

			$fp = fopen('results.json', 'w');
			fwrite($fp, json_encode($query1));
			fclose($fp);			

				$update1 = mysqli_query($con, $query1);	
				if(!$update1)
					$error =  mysqli_error($con);				
			}	
		}
		else
		{
			$error = mysqli_error($con);
		}
		
		if($error == null)
			mysqli_commit($con);	
		else
			mysqli_rollback($con);	
		
		echo $error;

	}
	
	//BLOCK 2
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
			
			$search2 = mysqli_query($con, "SELECT * FROM block2 WHERE report_id=$reportId");
			if(mysqli_num_rows($search2) <=0)
			{
				$query2="INSERT INTO block2 (report_id,c1,c2,c3,c4,c5,c6,c7,c8)
					 VALUES
					 ($reportId,'$b2c1',".var_export($b2c2, true).",'$b2c3','$b2c4','$b2c5','$b2c6',".var_export($b2c7, true).",'$b2c8')";

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
				$query2="UPDATE block2 SET report_id='$reportId',c1='$b2c1',c2=".var_export($b2c2, true).",c3='$b2c3',c4='$b2c4',
						c5='$b2c5',c6='$b2c6',c7=".var_export($b2c7, true).",c8='$b2c8'";

				$update2 = mysqli_query($con, $query1);	
				if(!$update2)
					$error =  mysqli_error($con);				
			}

		}
		else
		{
			$error = mysqli_error($con);
		}
		
		echo $error;
	}
	
	
	//BLOCK 3
	else if(isset($_POST['block3']))
	{
		$block3 = json_decode($_POST['block3'],true);
		$year = (int)$block3["year"];
		$month = (int)$block3["month"];
		$reportQuery = mysqli_query($con, "SELECT id FROM reports WHERE jamath = $jamath AND year = $year AND month = $month");
		if($reportQuery)
		{
			$report = mysqli_fetch_Array($reportQuery,MYSQLI_ASSOC);
			$reportId = $report['id'];			
			
			$b3c1 = $block3["c1"];
			$b3c2 = $block3["c2"];
			if(!empty($block3['c3']))
				$b3c3 = date('Y-m-d',strtotime($block3['c3']));
			else
				$b3c3 = null;			
			$b3c4 = $block3["c4"];
			$b3c5 = $block3["c5"];
			$b3c6 = $block3["c6"];
			
			$query3="INSERT INTO block3 (report_id,c1,c2,c3,c4,c5,c6)
				 VALUES
				 ($reportId,'$b3c1','$b3c2',".var_export($b3c3, true).",'$b3c4','$b3c5','$b3c6')";

			$insert3 = mysqli_query($con, $query3);	
			if(!$insert3)
				$error =  mysqli_error($con);
			else
			{
				$updateStatus = mysqli_query($con,"UPDATE reports SET status=3 WHERE id='$reportId'");
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

	//BLOCK 4
	else if(isset($_POST['block4']))
	{
		$block4 = json_decode($_POST['block4'],true);
		$year = (int)$block4["year"];
		$month = (int)$block4["month"];
		$reportQuery = mysqli_query($con, "SELECT id FROM reports WHERE jamath = $jamath AND year = $year AND month = $month");
		if($reportQuery)
		{
			$report = mysqli_fetch_Array($reportQuery,MYSQLI_ASSOC);
			$reportId = $report['id'];			
			
			$b4c1 = $block4["c1"];
			$b4c2 = $block4["c2"];
			$b4c3 = $block4['c3'];
			$b4c4 = $block4["c4"];
			$b4c5 = $block4["c5"];
			$b4c6 = $block4["c6"];
			$b4c7 = $block4["c7"];
			$b4c8 = $block4["c8"];
			$b4c9 = $block4["c9"];
			$b4c10 = $block4["c10"];
			$b4c11 = $block4["c11"];
			$b4c12 = $block4["c12"];
			$b4c13 = $block4["c13"];
			$b4c14 = $block4["c14"];
			$b4c15 = $block4["c15"];
			$b4c16 = $block4["c16"];
			$b4c17 = $block4["c17"];
			$b4c18 = $block4["c18"];
			$b4c19 = $block4["c19"];
			$b4c20 = $block4["c20"];
			$b4c21 = $block4["c21"];
			
			$query4="INSERT INTO block4 (report_id,c1,c2,c3,c4,c5,c6,c7,c8,c9,c10,c11,c12,c13,c14,c15,c16,c17,c18,c19,c20,c21)
				 VALUES
				 ($reportId,'$b4c1','$b4c2','$b4c3','$b4c4','$b4c5','$b4c6','$b4c7','$b4c8','$b4c9','$b4c10',
				 '$b4c11','$b4c12','$b4c13','$b4c14','$b4c15','$b4c16','$b4c17','$b4c18','$b4c19','$b4c20','$b4c21')";

			$insert4 = mysqli_query($con, $query4);	
			if(!$insert4)
				$error =  mysqli_error($con);
			else
			{
				$updateStatus = mysqli_query($con,"UPDATE reports SET status=4 WHERE id='$reportId'");
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
	
	//BLOCK 5
	else if(isset($_POST['block5']))
	{
		$block5 = json_decode($_POST['block5'],true);
		$year = (int)$block5["year"];
		$month = (int)$block5["month"];
		$reportQuery = mysqli_query($con, "SELECT id FROM reports WHERE jamath = $jamath AND year = $year AND month = $month");
		if($reportQuery)
		{
			$report = mysqli_fetch_Array($reportQuery,MYSQLI_ASSOC);
			$reportId = $report['id'];			
			
			$b5c1 = $block5["c1"];
			$b5c2 = $block5["c2"];
			$b5c3 = $block5["c3"];
			$b5c4 = $block5["c4"];
			$b5c5 = $block5["c5"];
			$b5c6 = $block5["c6"];
			$b5c7 = $block5["c7"];
			$b5c8 = $block5["c8"];
			$b5c9 = $block5["c9"];
			$b5c10 = $block5["c10"];
			$b5c11 = $block5["c11"];
			$b5c12 = $block5["c12"];
			$b5c13 = $block5["c13"];
			$b5c14 = $block5["c14"];
			$b5c15 = $block5["c15"];
			$b5c16 = $block5["c16"];
			
			$query4="INSERT INTO block5 (report_id,c1,c2,c3,c4,c5,c6,c7,c8,c9,c10,c11,c12,c13,c14,c15,c16)
				 VALUES
				 ($reportId,'$b5c1','$b5c2','$b5c3','$b5c4','$b5c5','$b5c6','$b5c7','$b5c8','$b5c9','$b5c10',
				 '$b5c11','$b5c12','$b5c13','$b5c14','$b5c15','$b5c16')";

			$insert5 = mysqli_query($con, $query5);	
			if(!$insert5)
				$error =  mysqli_error($con);
			else
			{
				$updateStatus = mysqli_query($con,"UPDATE reports SET status=5 WHERE id='$reportId'");
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


	//BLOCK 6
	else if(isset($_POST['block6']))
	{
		$block6 = json_decode($_POST['block6'],true);
		$year = (int)$block6["year"];
		$month = (int)$block6["month"];
		$reportQuery = mysqli_query($con, "SELECT id FROM reports WHERE jamath = $jamath AND year = $year AND month = $month");
		if($reportQuery)
		{
			$report = mysqli_fetch_Array($reportQuery,MYSQLI_ASSOC);
			$reportId = $report['id'];			
			
			$b6c1 = $block6["c1"];
			$b6c2 = $block6["c2"];
			$b6c3 = $block6['c3'];
			$b6c4 = $block6["c4"];
			$b6c5 = $block6["c5"];
			$b6c6 = $block6["c6"];
			$b6c7 = $block6["c7"];
			$b6c8 = $block6["c8"];
			$b6c9 = $block6["c9"];
			$b6c10 = $block6["c10"];
			$b6c11 = $block6["c11"];
			$b6c12 = $block6["c12"];
			$b6c13 = $block6["c13"];
			$b6c14 = $block6["c14"];
			$b6c15 = $block6["c15"];
			$b6c16 = $block6["c16"];
			$b6c17 = $block6["c17"];
			if(!empty($block6["c18"]))
				$b6c18 = date('Y-m-d',strtotime($block6['c18']));
			else
				$b6c18 = null;			
			$b6c19 = $block6["c19"];
			$b6c20 = $block6["c20"];
			$b6c21 = $block6["c21"];
			if(!empty($block6["c22"]))
				$b6c22 = date('Y-m-d',strtotime($block6['c22']));
			else
				$b6c22 = null;
			$b6c23 = $block6["c23"];
			$b6c24 = $block6["c24"];
			$b6c25 = $block6["c25"];
			
			$query6="INSERT INTO block6 (report_id,c1,c2,c3,c4,c5,c6,c7,c8,c9,c10,c11,c12,c13,c14,c15,c16,c17,c18,c19,c20,c21)
				 VALUES
				 ($reportId,'$b6c1','$b6c2','$b6c3','$b6c4','$b6c5','$b6c6','$b6c7','$b6c8','$b6c9','$b6c10','$b6c11','$b6c12','$b6c13',
				 '$b6c14','$b6c15','$b6c16','$b6c17',".var_export($b6c18, true).",'$b6c19','$b6c20','$b6c21',".var_export($b6c22, true).",
				 '$b6c23','$b6c24','$b6c25')";

			$insert6 = mysqli_query($con, $query6);	
			if(!$insert6)
				$error =  mysqli_error($con);
			else
			{
				$updateStatus = mysqli_query($con,"UPDATE reports SET status=6 WHERE id='$reportId'");
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