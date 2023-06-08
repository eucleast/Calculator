<?php
	include_once "include/config.php";
	error_reporting(E_ALL ^ E_NOTICE);
	date_default_timezone_set("Asia/Kuala_Lumpur");
	date_default_timezone_get();
?>

<style>
.eg {
	color:#F60F0F;
	font-weight:bolder;
	margin:0 5px;
	display:inline;
	vertical-align:middle;
	font-size:10px;
}
</style>

<script language="javascript">
function resetform(){
document.getElementById('TT_identify').value = "";
document.getElementById('TT_close').value = "";
document.getElementById('TT_restore_day').value = "0";
document.getElementById('TT_restore_hrs').value = "0";
document.getElementById('TT_restore_min').value = "0";
document.getElementById('planned_end').value = "";
}
function resetform_others(){
document.getElementById('planned_end_others').value = "";
document.getElementById('TT_identify_others').value = "";
document.getElementById('TT_close_others').value = "";
document.getElementById('TT_restore_day_others').value = "0";
document.getElementById('TT_restore_hrs_others').value = "0";
document.getElementById('TT_restore_min_others').value = "0";
}
function resetform_resolved(){
document.getElementById('planned_end_resolved').value = "";
document.getElementById('TT_identify_resolved').value = "";
document.getElementById('TT_close_resolved').value = "";
document.getElementById('TT_restore_day_resolved').value = "0";
document.getElementById('TT_restore_hrs_resolved').value = "0";
document.getElementById('TT_restore_min_resolved').value = "0";
}
//limit minutes input box
function handleChange(input){
    if (input.value < 0) input.value = 0;
    if (input.value > 60) input.value = 60;	
}
//end limit minutes input box
</script>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
		<title><?php echo $pgTitle ?></title>
		<link rel="stylesheet" type="text/css" href="css/styles.css">			
		<script src="js/util.js"></script>
	</head>
	<body>
		<div id="container">
			<div id="header">
				<div class="width">
					<h1 style="margin-left: -9%;"><a href="#"><?php echo $topTitle ?></a></h1>
				</div>
			</div>
			<div id="nav">
				<div class="width">
					<ul style="margin-left: -8%;">
						<li class="start selected"><a href="/knowledgebay">Knowledge bay</a></li>
					</ul>
				</div>
								<div class="width">
					<ul style="margin-left: -8%;">
						<li class="start selected"><a href="/knowledgebay">HOME</a></li>
					</ul>
				</div>
								<div class="width">
					<ul style="margin-left: -8%;">
						<li class="start selected"><a href="/knowledgebay/leased-line/">LEASED LINE</a></li>
					</ul>
				</div>
								<div class="width">
					<ul style="margin-left: -8%;">
						<li class="start selected"><a href="/knowledgebay/iplc">IPLC</a></li>
					</ul>
				</div>
								<div class="width">
					<ul style="margin-left: -8%;">
						<li class="start selected"><a href="/knowledgebay/metro-e">METRO-E</a></li>
					</ul>
				</div>
								<div class="width">
					<ul style="margin-left: -8%;">
						<li class="start selected"><a href="/knowledgebay/voice">VOICE</a></li>
					</ul>
				</div>
								<div class="width">
					<ul style="margin-left: -8%;">
						<li class="start selected"><a href="/calculator">CALCULATOR</a></li>
					</ul>
				</div>
			</div>
<?php
		//##### Down issue #####

		//check date value
		if($TT_identify==0 || $TT_identify===''){ $TT_identify=0;}
		if($TT_close==0 || $TT_close===''){ $TT_close=0;}
		if($planned==0 || $planned===''){ $planned='';}

		//initial post data
		$TT_identify = $_POST['TT_identify'];
		$TT_close = $_POST['TT_close'];
		$TT_restore_day = $_POST['TT_restore_day'];
		$TT_restore_hrs = $_POST['TT_restore_hrs'];
		$TT_restore_min = $_POST['TT_restore_min'];

		//convert day to hour
		$daytohour = $TT_restore_day*24;	
		$TT_restore = $TT_restore_hrs + $daytohour;

		//convert string	
		$time1 = strtotime(str_replace('/','-',$TT_identify));
		$time2 = strtotime(str_replace('/','-',$TT_close));
		$time3 = $TT_restore;		
		
		//Calculation	
		$duration = $time2 - $time1;	 
		$y = ($time3 * 3600) + (($TT_restore_min + 30) * 60);
		$z = $time2 + $duration;
		$z = $z - $y;

		$dateinsec=$time2;
		$newdate=$dateinsec+$duration;	
		$planned_end = $newdate - $y;
		$planned = date('d/m/Y h:i:s a',$planned_end);	
		
		//##### Performance issue #####

		//check date value		
		if($TT_identify_others==0 || $TT_identify_others===''){ $TT_identify_others=0;}
		if($TT_close_others==0 || $TT_close_others===''){ $TT_close_others=0;}
		if($planned_others==0 || $planned_others===''){ $planned_others='';}

		//initial post data
		$TT_identify_others = $_POST['TT_identify_others'];
		$TT_close_others = $_POST['TT_close_others'];
		$TT_restore_day_others = $_POST['TT_restore_day_others'];
		$TT_restore_hrs_others = $_POST['TT_restore_hrs_others'];
		$TT_restore_min_others = $_POST['TT_restore_min_others'];

		//convert day to hour
		$daytohour_others = $TT_restore_day_others*24;
		$TT_restore_others = $TT_restore_hrs_others + $daytohour_others;

		//convert string			 
		$time1_others = strtotime(str_replace('/','-',$TT_identify_others));
		$time2_others = strtotime(str_replace('/','-',$TT_close_others));
		$time3_others = $TT_restore_others;

		//Calculation
		$duration_others = $time2_others - $time1_others;	 
		$y_others = ($time3_others * 3600) + (($TT_restore_min_others + 30) * 60);
		$z_others = $time2_others + $duration_others;
		$z_others = $z_others - $y_others;

		$dateinsec_others=$time2_others;
		$newdate_others=$dateinsec_others+$duration_others;	
		$planned_end_others = $newdate_others - $y_others;
		$planned_others = date('d/m/Y h:i:s a',$planned_end_others);		

		//##### Productive hours #####

		//check date value		
		if($TT_identify_resolved==0 || $TT_identify_resolved===''){ $TT_identify_resolved=0;}
		if($TT_close_resolved==0 || $TT_close_resolved===''){ $TT_close_resolved=0;}
		if($planned_end_resolved==0 || $planned_end_resolved===''){ $planned_end_resolved='';}						

		//initial post data
		$TT_identify_resolved = $_POST['TT_identify_resolved'];
		$TT_close_resolved = $_POST['TT_close_resolved'];
		$TT_restore_day_resolved = $_POST['TT_restore_day_resolved'];
		$TT_restore_hrs_resolved = $_POST['TT_restore_hrs_resolved'];
		$TT_restore_min_resolved = $_POST['TT_restore_min_resolved'];

		//convert day to hour		
		$daytohour_resolved = $TT_restore_day_resolved*24;
		$TT_restore_resolved = $TT_restore_hrs_resolved + $daytohour_resolved;


		//convert string			 		 
		$time1_resolved = strtotime(str_replace('/','-',$TT_identify_resolved));
		$time2_resolved = strtotime(str_replace('/','-',$TT_close_resolved));
		$time3_resolved = $TT_restore_resolved;

		//Calculation
		$duration_resolved = $time2_resolved - $time1_resolved;	 
		$y_resolved = ($time3_resolved * 3600) + (($TT_restore_min_resolved + 30) * 60);
		$z_resolved = $time2_resolved + $duration_resolved;
		$z_resolved = $z_resolved - $y_resolved;
		//$duration_resolved = ($time1_resolved - $time2_resolved) /1000;
		//$TT_restore_day_resolved = ($duration_resolved/86400);
		//$TT_restore_hrs_resolved = ($duration_resolved/3600)%24;
		//$TT_restore_min_resolved = ($duration_resolved/60)%60;
				
		$dateinsec_resolved=$time2_resolved;
		$newdate_resolved=$dateinsec_resolved+$duration_resolved;	
		$planned_end_resolved = $newdate_resolved - $y_resolved;
		$planned_end_resolved = date('d/m/Y h:i:s a',$planned_end_resolved);
		//$planned_end_resolved = $TT_restore_hrs_resolved;
		
?>
<br>
<h3>&nbsp;&nbsp;Unproductive Downtime Calculator</h3><br />
<table width='100%'>
	<tr>
		<td width="100%" style="border: 1px solid rgba(0, 0, 255, 0.2);">

		<!--##### Down issue #####-->

		<div id="content">
			<fieldset>
				<legend>Down issue:</legend>
				<form action="?pg=index" method="post" id="formcalc" onsubmit="return validateForm(this)">
					<table class="table_list" style="width:450px">
						<tr>
							<th style="width:150px; font-size:13px;">CTT Created Date :</th>
							<td><input 
								type="text" 
								name="TT_identify" 
								id="TT_identify" 
								class="box box200 validate:string" 
								maxlength="50" 
								placeholder="eg: 22/12/2016 10:10:10 am"
								value="<?php echo $TT_identify ?>">
							</td>
						</tr>
						<tr>
							<th style="width:150px; font-size:13px;">Exclusion Time (start) :</th>
							<td><input 
								type="text" 
								name="TT_close" 
								id="TT_close" 
								class="box box200 validate:string" 
								maxlength="50" 
								value="<?php echo $TT_close ?>">
							</td>
						</tr>						
						<tr>
							<th style="width:150px; font-size:13px;">Productive Hours :</th>
							<td>
							<input 
							type="text" 
							style="text-align:right;" 
							name="TT_restore_day" 
							id="TT_restore_day" 
							class="box box50 validate:string"
							placeholder="day" 
							maxlength="50" 
							value="<?php if($TT_restore_day!='')echo $TT_restore_day; else{ echo ""; }?>">
							
							<input 
							type="text" 
							style="text-align:right; margin-left: 20px;" 
							name="TT_restore_hrs" 
							id="TT_restore_hrs" 
							class="box box50 validate:string"
							placeholder="hrs" 
							maxlength="50" 
							value="<?php if($TT_restore_hrs!='')echo $TT_restore_hrs; else{ echo ""; }?>">
							
							<input 
							type="text" 
							style="text-align:right; margin-left: 20px;" 
							name="TT_restore_min" 
							id="TT_restore_min" 
							class="box box50 validate:string"
							placeholder="min" 
							maxlength="50" 
							value="<?php if($TT_restore_min!='')echo $TT_restore_min; else{ echo ""; } ?>">
						</td>					
						</tr>				
						<tr class="last">
							<td  colspan='2'>
							<p></p>
							<input 
							name="reset1" 
							style="margin-left: 170px;" 
							onclick="resetform()" 
							class="formbutton neutral" 
							value="Reset" 
							type="button" />
							
							<input 
							name="send" 
							style="margin-left: 10px;" 
							class="formbutton" 
							value="Calculate" 
							type="submit" />
							</td>
						</tr>
						<tr><td></td></tr>
						<tr>
							<th style="width:150px; font-size:13px;">Planned end :</th>
							<td>
								<input 
								type="text" 
								name="planned_end" 
								id="planned_end" 
								class="box box200" 
								readonly maxlength="50" 
								value="<?php  if($planned==="01/01/1970 07:00:00 am"){ echo "";
							} else if( ($TT_close ==='') || ($TT_identify ==='') || ($TT_restore_day==='') || ($TT_restore_hrs==='') || ($TT_restore_min==='')){ echo "";
						}
						else{ echo $planned; 
						}?>"></td>
						</tr>
					</table>
					<br />
				</form>
			</fieldset>
		</div>

		<!--##### Productive hours #####-->
<!--
		<div id="content" style="margin-left:-2%;border-left: 1px solid rgba(0, 0, 255, 0.2);">
			<fieldset>
				<legend style="margin-left: 5%;">Outage time:</legend>
				<form action="?pg=index" method="post" id="formcalc" onsubmit="return validateForm(this)">
					<table class="table_list" style="width:450px; margin-left:3%">
						<tr>
							<th style="width:150px; font-size:13px;">CTT Created Date :</th>
							<td>
								<input 
								type="text" 
								name="TT_identify_resolved" 
								id="TT_identify_resolved" 
								class="box box200 validate:string" 
								maxlength="50" 
								placeholder="eg: 22/12/2016 10:10:10 am"
								value="<?php echo $TT_identify_resolved ?>">
							</td>
						</tr>
						<tr>
							<th style="width:150px; font-size:13px;">CTT Uptime (resolved) :</th>
							<td>
								<input 
								type="text" 
								name="TT_close_resolved" 
								id="TT_close_resolved" 
								class="box box200 validate:string" 
								maxlength="50" 
								value="<?php echo $TT_close_resolved ?>">
							</td>
						</tr>
			
						<tr class="last">
							<td  colspan='2'>
							<p></p>
							<input 
							name="reset1_resolved" 
							style="margin-left: 170px;" 
							onclick="resetform_resolved()" 
							class="formbutton neutral" 
							value="Reset" 
							type="button" />
							
							<input 
							name="send" 
							style="margin-left: 10px;" 
							class="formbutton" 
							value="Calculate" 
							type="submit" />
							</td>
						</tr>
						<tr><td></td></tr>
						<tr>
							<th style="width:150px; font-size:13px;">Productive Hours :</th>
							<td>
								<input 
								type="text" 
								name="planned_end_resolved" 
								id="planned_end_resolved" 
								class="box box200" 
								readonly maxlength="50" 
								value="<?php if($planned_end_resolved==="01/01/1970 07:00:00 am"){ echo "";
							} else{ echo $planned_end_resolved; }?>">
							</td>
						</tr>
					</table>
					<br /><br /><br />
					<br />
				</form>
			</fieldset>
		</div>
-->
		<!--##### Performance issue #####-->

		<div id="content" style="margin-left:-1%;border-left: 1px solid rgba(0, 0, 255, 0.2);">
			<fieldset>
				<legend style="margin-left: 5%;">Performance issue:</legend>
				<form action="?pg=index" method="post" id="formcalc" onsubmit="return validateForm(this)">
					<table class="table_list" style="width:450px; margin-left:3%">
						<tr>
							<th style="width:150px; font-size:13px;">CTT Created Date :</th>
							<td>
								<input 
								type="text" 
								name="TT_identify_others" 
								id="TT_identify_others" 
								class="box box200 validate:string" 
								maxlength="50" 
								placeholder="eg: 22/12/2016 10:10:10 am"
								value="<?php echo $TT_identify_others ?>">
							</td>
						</tr>
						<tr>
							<th style="width:150px; font-size:13px;">Exclusion Time (start) :</th>
							<td>
								<input 
								type="text" 
								name="TT_close_others" 
								id="TT_close_others" 
								class="box box200 validate:string" 
								maxlength="50" 
								value="<?php echo $TT_close_others ?>">
							</td>
						</tr>
			
						<tr class="last">
							<td  colspan='2'>
							<p></p>
							<input 
							name="reset1_others" 
							style="margin-left: 170px;" 
							onclick="resetform_others()" 
							class="formbutton neutral" 
							value="Reset" 
							type="button" />
							
							<input 
							name="send" 
							style="margin-left: 10px;" 
							class="formbutton" 
							value="Calculate" 
							type="submit" />
							</td>
						</tr>
						<tr><td></td></tr>
						<tr>
							<th style="width:150px; font-size:13px;">Planned end :</th>
							<td>
								<input 
								type="text" 
								name="planned_end_others" 
								id="planned_end_others" 
								class="box box200" 
								readonly maxlength="50" 
								value="<?php if($planned_others==="01/01/1970 07:00:00 am"){ echo "";
							} else{ echo $planned_others; }?>">
							</td>
						</tr>
					</table>
					<br /><br /><br />
					<br />
				</form>
			</fieldset>
		</div>

	</td>
	</tr>
</table>
<div id="footer">
	<div class="footer-bottom">
		<p><?php echo $footText ?></p>
		 </div>
			</div>
		</div>
	</body>
</html>