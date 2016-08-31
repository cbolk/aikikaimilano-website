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
	if($_GET['day']){
		$theday = $_GET['day'];
		$month = date('m',strtotime($theday)); 
		$year = date('Y',strtotime($theday));
	}else{
		$theday = date('Y-m-d');
		$month = date('m');
		$year = date('Y');
	}
	if($month < 9)
		$y = $year - 1;
	else
		$y = $year;
	

	$util = new utils();
	$dbconn = new dbaccess();
	$dbconn->dbconnect();

?>
<!DOCTYPE html>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	    <link rel="apple-touch-icon-precomposed" href="../assets/favicon_t.png" />
  		<link rel="shortcut icon" href="../assets/favicon.png">
 	    <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>keiko <?php echo $theday; ?></title>
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
    <?php 
    	$ai = new aikidoka();
    	$person = $ai->fullname($dbconn, $aid);
		echo "<h2>" . $person[0]['fullname'] . "</h2>";
    	$hours = $ai->getHoursMonthYear($dbconn, $aid, $month, $year);
    ?>
    </div>
  </div>
  <div class="clearfix"></div>

  <!-- This space is for the app's content -->
   <?php
    	$ai->generateMonthKeikoHoursColor($month, $year, $hours);
    	$ai->printKeikoHoursColorScale();
  ?>
 
  <div class="nav">
		<a class="nav-button" href="usr_attendance_daily.php?aid=<?php echo $aid; ?>&day=<?php echo $theday; ?>"><i class="fa fa-flag fa-fw"></i><br/>oggi</a>
		<a class="nav-button" href="usr_attendance_monthly.php?aid=<?php echo $aid; ?>"><i class="fa fa-calendar fa-fw"></i><br/>mese</a>
		<a class="nav-button" href="usr_attendance_yearly.php?aid=<?php echo $aid; ?>&y=<?php echo $y; ?>"><i class="fa fa-area-chart fa-fw"></i><br/>anno</a>
		<a class="nav-button" href="usr_attendance_yearly.php?aid=<?php echo $aid; ?>"><i class="fa fa-bar-chart fa-fw"></i><br/>da esame</a>
  </div>
</div>
</body>
</html>