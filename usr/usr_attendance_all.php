<?php
	setlocale(LC_TIME, 'ita');
	date_default_timezone_set('Europe/Rome');
	include("../admin/class.db.php");
	include("../admin/class.login.php");
	include("../admin/class.aikidoka.php");
	include("../admin/class.utilities.php");
	$log = new logmein();
	$log->encrypt = true; //set encryption 
	$isLogged = $log->logincheck($_SESSION['loggedin'], "user_t", "passwd", "login");	

	if(isset($_GET["aid"]))
		$aid = $_GET["aid"];
	else
		$aid = -1;

	$month = date('m');
	if($month < 9){
		$year = date('Y') - 1;
	}else{
		$year = date('Y');
	}

	if($_GET["y"]){
		$y = $_GET["y"];
		$from = $y;
		$to = intval($y)+1;
		$title = $from . "-" . $to;
	} else {
		$y = "";
		$title = "complessivo";
	}

	$dbconn = new dbaccess();
	$dbconn->dbconnect();
	
?>
<!DOCTYPE html>
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	    <link rel="apple-touch-icon-precomposed" href="assets/favicon_t.png" />
  		<link rel="shortcut icon" href="assets/favicon.png">
 	    <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>keiko : <?php echo $title; ?></title>
		<link rel="stylesheet" href="../assets/css/stats.css" /> 
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" />  
		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
</head>
<body>
<?php
	if($isLogged == false) { 
		header("Location: ../admin/adm_index.php");
		exit;
	} 
?>
<div id="wrapper">
  <div class="top-bar">
    <div>
    <h2>
    <?php 
    	$ai = new aikidoka();
    	$person = $ai->fullname($dbconn, $aid);
		echo "<h2>" . $person[0]['fullname'] . "</h2>";
    ?>
    </h2>
    </div>
  </div>
  <div class="clearfix"></div>

  <div class="content">
	<h3><?php
			if($y != "") {
				echo "anno " . $from . "-" . $to;
		    	$mhours = $ai->getHoursYear($dbconn, $aid, $from, $to);
			} else {
				echo "complessivo";
		    	$mhours = $ai->getHoursFromStart($dbconn, $aid);
			}
	?>
	</h3>
  </div>
  <!-- This space is for the app's content -->
  <div class="content">
		<?php
				$headstr = "<div class='calendar_row calendar__weekdaynames'>";
				$headstr = $headstr . "<div class='calendar__year_label'></div>\n";
				$headstr = $headstr . "<div class='calendar__monthname'>S</div>\n";
				$headstr = $headstr . "<div class='calendar__monthname'>O</div>\n";
				$headstr = $headstr . "<div class='calendar__monthname'>N</div>\n";
				$headstr = $headstr . "<div class='calendar__monthname'>D</div>\n";
				$headstr = $headstr . "<div class='calendar__monthname'>G</div>\n";
				$headstr = $headstr . "<div class='calendar__monthname'>F</div>\n";
				$headstr = $headstr . "<div class='calendar__monthname'>M</div>\n";
				$headstr = $headstr . "<div class='calendar__monthname'>A</div>\n";
				$headstr = $headstr . "<div class='calendar__monthname'>M</div>\n";
				$headstr = $headstr . "<div class='calendar__monthname'>G</div>\n";
				$headstr = $headstr . "<div class='calendar__monthname'>L</div>\n";
				$headstr = $headstr . "<div class='calendar__monthname'>A</div>\n";
				$headstr = $headstr . "<div class='calendar__month_tot'>TOT</div>\n";
				$headstr = $headstr . "</div>";
				echo $headstr;
				$nhrs = 0;
				$firstmonth = $mhours[0]['MM'];
				$firstyear = $mhours[0]['YY'];
//				echo $firstmonth . ":" . $firstyear;
				if($firstmonth >= 9)
					$startyear = $firstyear;
				else
					$startyear = intval($firstyear) - 1;
					
				$ndati = count($mhours);
				$j = 0;
				$headstr = "";
				$i = 9;
			    $yhrs = 0;
			    if($firstmonth != 9){
					echo "\n<div class='calendar_row'>\n<div class='calendar__year_label'>" . $startyear;
					$toyear = intval($startyear) +1 ;
					echo "-" . $toyear . "</div>\n";
					/* empty months */
					if($firstmonth > 9) {
						for(; $i < $firstmonth; $i++)
							$headstr = $headstr ."<div class='calendar__day calendar__day_not_in_month'>NA</div>\n";
						//$i = 9;
					} else if ($firstmonth < 9) {
						for(; $i <= 12; $i++)
							$headstr = $headstr ."<div class='calendar__day calendar__day_not_in_month'>NA</div>\n";
						for($i = 1; $i < $firstmonth; $i++)
							$headstr = $headstr ."<div class='calendar__day calendar__day_not_in_month'>NA</div>\n";
					}
					for(; $i <= 8; $i++){
						$headstr =  $headstr ."<div class='calendar__day calendar__day_working";
						if($mhours[$j]['MM'] == ($i % 12)){
							if ($y == "" && $mhours[$j]['MM'] == $firstmonth && $mhours[$j]['YY'] == $firstyear)
								$headstr = $headstr . " date__lastexam ";
							$headstr = $headstr . " '>";
							$headstr = $headstr . $mhours[$j]['MH'];
							$nhrs = $nhrs + intval($mhours[$j]['MH']);
							$yhrs = $yhrs + intval($mhours[$j]['MH']);
							$j++;
							$ndati--;
						} else if ($mhours[$j]['MM'] == 12){
							if ($y == "" && $mhours[$j]['MM'] == $firstmonth && $mhours[$j]['YY'] == $firstyear)
								$headstr = $headstr . " date__lastexam ";
							$headstr = $headstr . "'>";
							$headstr = $headstr . $mhours[$j]['MH'];
							$nhrs = $nhrs + intval($mhours[$j]['MH']);
							$yhrs = $yhrs + intval($mhours[$j]['MH']);
							$j++;
							$ndati--;
						} else {
							$headstr = $headstr . "'>";
							$headstr = $headstr . "0";
						}
						$headstr = $headstr . "</div>\n";
						echo $headstr;
						$headstr = "";
					}
					echo "<div class='calendar__month_tot'>" . $yhrs . "</div>\n</div>";
					$startyear = intval($startyear) +1 ;
				}
				while($ndati > 0){
					echo "\n<div class='calendar_row'>\n<div class='calendar__year_label'>" . $startyear;
					$startyear = intval($startyear) +1 ;
					echo "-" . $startyear . "</div>\n";
					for($i = 9, $yhrs = 0; $i < 21; $i++){
						$headstr =  $headstr ."<div class='calendar__day calendar__day_working";
						if($mhours[$j]['MM'] == ($i % 12)){
							if ($y == "" && $mhours[$j]['MM'] == $firstmonth && $mhours[$j]['YY'] == $firstyear)
								$headstr = $headstr . " date__lastexam ";
							$headstr = $headstr . "'>";
							if($mhours[$j]['MH'] == ""){
								$headstr = $headstr . "0";
							} else {
								$headstr = $headstr . $mhours[$j]['MH'];
							}
							$nhrs = $nhrs + intval($mhours[$j]['MH']);
							$yhrs = $yhrs + intval($mhours[$j]['MH']);
							$j++;
							$ndati--;
						} else if ($mhours[$j]['MM'] == 12){
							if ($y == "" && $mhours[$j]['MM'] == $firstmonth && $mhours[$j]['YY'] == $firstyear)
								$headstr = $headstr . " date__lastexam ";
							$headstr = $headstr . "'>";
							if($mhours[$j]['MH'] == ""){
								$headstr = $headstr . "0";
							} else {
								$headstr = $headstr . $mhours[$j]['MH'];
							}
							$nhrs = $nhrs + intval($mhours[$j]['MH']);
							$yhrs = $yhrs + intval($mhours[$j]['MH']);
							$j++;					
							$ndati--;
						} else{
							$headstr = $headstr . "'>";
							$headstr = $headstr . "0";
						}
						$headstr = $headstr . "</div>\n";
						echo $headstr;
						$headstr = "";
					}
					echo "<div class='calendar__month_tot'>" . $yhrs . "</div>\n</div>";				
				}
				if($y == ""){
					echo "\n<div class='calendar_row'>\n<div class='calendar__year_label'>totale</div>\n";
					for($i = 0; $i < 12; $i++)
						echo "<div class='calendar__day calendar__day_not_in_month'>NA</div>\n";
					echo "<div class='calendar__month_tot'>" . $nhrs . "</div></div>\n";	
				}			
?>
		<p><br/><br/><br/></p>
  </div>

  <div class="nav">
		<a class="nav-button" href="usr_attendance_daily.php?aid=<?php echo $aid; ?>"><i class="fa fa-flag fa-fw"></i><br/>oggi</a>
		<a class="nav-button" href="usr_attendance_monthly.php?aid=<?php echo $aid; ?>"><i class="fa fa-calendar fa-fw"></i><br/>mese</a>
		<a class="nav-button" href="usr_attendance_yearly.php?aid=<?php echo $aid; ?>&y=<?php echo $year; ?>"><i class="fa fa-calendar-o fa-fw"></i><br/>anno</a>
		<a class="nav-button" href="usr_attendance_yearly.php?aid=<?php echo $aid; ?>"><i class="fa fa-bar-chart fa-fw"></i><br/>da esame</a>
		<a class="nav-button" href="usr_attendance_all.php?aid=<?php echo $aid; ?>"><i class="fa fa-area-chart fa-fw"></i><br/>da sempre</a>
  </div>
</div>
</body>
</html>