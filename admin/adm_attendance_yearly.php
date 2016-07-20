<?php
	setlocale(LC_TIME, 'ita');
	date_default_timezone_set('Europe/Rome');
	include("./class.db.php");
	include("./class.login.php");
	include("./class.aikidoka.php");
	include("./class.utilities.php");
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
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="admin website">
    <meta name="author" content="cbolk">
    <link rel="icon" href="../assets/favicon.png">
	<link href='http://fonts.googleapis.com/css?family=Lato:400,400italic,700,300,300italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Oxygen+Mono' rel='stylesheet' type='text/css'>
	<title>presenze mensili</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" type="text/css" href="../assets/css/jquery-ui-1.8.20.custom.css">
    <link href="../assets/css/bootstrap.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../assets/css/dashboard.css" rel="stylesheet">
    <link href="../assets/css/dashboardAM.css" rel="stylesheet">
		<link rel="stylesheet" href="../assets/css/admcalendar.css" /> 

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type='text/javascript' src='//code.jquery.com/jquery-2.1.1.min.js'></script>
    <script type="text/javascript" language="javascript" src="../assets/js/jquery-ui-1.8.20.custom.min.js" ></script>   
	<script type="text/javascript" src="../assets/js/presenze.js"></script>
</head>
<body>
<?php
	if($isLogged == false) { 
		header("Location: adm_index.php");
		exit;
	} 
?>
   <?php include('./_nav_top.htm'); ?>

    <div class="container-fluid">
      <div class="row">
        <?php include('./_nav_main.php'); ?>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">
			<?php 
				$ai = new aikidoka();
				$person = $ai->fullname($dbconn, $aid);
				$isBeg = $ai->isBeginner($dbconn, $aid);
				$aiid = $aid;
				echo  $person[0]['fullname'] ;
			?>
		  <div class='actions aright'>
		  	<a href='./adm_attendance_month.php' alt="elenco presenze"><i class="fa fa-bars"></i> elenco</a>&nbsp;
		  <?php
				if($y != "") {
					echo "<a href='./adm_attendance_yearly.php?aid=" . $aiid. "' alt='elenco presenze'><i class='fa fa-bar-chart fa-fw'></i> da esame</a>";
				} else {
					echo "<a href='./adm_attendance_yearly.php?aid=" . $aiid . "&y=" . $year . "' alt='elenco presenze'><i class='fa fa-bar-chart fa-fw'></i> anno</a>";
				}
		  ?>
		  	
		  </div>
          </h1>
		  <div class='clearfix'></div>
          <div class="row">
	        <center>			
			<h3><?php
				if($y != "") {
					echo "anno " . $from . "-" . $to;
		    		$mhours = $ai->getHoursYear($dbconn, $aid, $from, $to);
				} else {
					echo "complessivo";
		    		$mhours = $ai->getHoursFromExam($dbconn, $aid);
				}
				?>
			</h3>
			<?php
				$ndati = count($mhours);
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
				$headstr = "";
			    $yhrs = 0;
			    // first year eventually not complete
			    $firstayear = $mhours[0]['YA'];
			    $firstamonth = $mhours[0]['MA'];
			    echo "\n<div class='calendar_row'>\n<div class='calendar__year_label'>" . $mhours[0]['YA'] . "</div>\n";
			    $i = 0;
			    while($i < $firstamonth){
			    	$headstr = $headstr ."<div class='calendar__day calendar__day_not_in_month'>NA</div>\n";
			    	$i++;
			    }
			    for($j = 0; $i < 12; $i++){
			    	$headstr =  $headstr ."<div class='calendar__day calendar__day_working";
			    	if($mhours[$j]['MA'] == $i){
						if ($y == "" && $mhours[$j]['MA'] == $firstamonth && $mhours[$j]['YA'] == $firstayear)
							$headstr = $headstr . " date__lastexam ";
						$headstr = $headstr . " '>";
						if($mhours[$j]['MH'] == ""){
							$headstr = $headstr . "0";
						} else {
							$headstr = $headstr . $mhours[$j]['MH'];
						}						
						$nhrs = $nhrs + intval($mhours[$j]['MH']);
						$yhrs = $yhrs + intval($mhours[$j]['MH']);
						$ndati--;
						$j++;			    		
			    	} else {
			    		$headstr = $headstr . "'>";
			    		$headstr = $headstr . "0";
			    	}
					$headstr = $headstr . "</div>\n";
					echo $headstr;
					$headstr = "";
			    }
				echo "<div class='calendar__month_tot aright'>" . $yhrs . "</div>\n</div><!-- row -->";


				while($ndati > 0){
				    echo "\n<div class='calendar_row'>\n<div class='calendar__year_label'>" . $mhours[$j]['YA'] . "</div>\n";
				    for($i = 0, $yhrs = 0; $i < 12; $i++){
				    	$headstr =  $headstr ."<div class='calendar__day calendar__day_working";
				    	if($mhours[$j]['MA'] == $i){
							if ($y == "" && $mhours[$j]['MA'] == $firstamonth && $mhours[$j]['YA'] == $firstayear)
								$headstr = $headstr . " date__lastexam ";
							$headstr = $headstr . " '>";
							if($mhours[$j]['MH'] == ""){
								$headstr = $headstr . "0";
							} else {
								$headstr = $headstr . $mhours[$j]['MH'];
							}						
							$nhrs = $nhrs + intval($mhours[$j]['MH']);
							$yhrs = $yhrs + intval($mhours[$j]['MH']);
							$ndati--;
							$j++;
				    	} else {
				    		$headstr = $headstr . "'>";
				    		$headstr = $headstr . "0";				    		
				    	}
						$headstr = $headstr . "</div>\n";
						echo $headstr;
						$headstr = "";
				    }
					echo "<div class='calendar__month_tot aright'>" . $yhrs . "</div>\n</div><!-- row -->";				
				}

				if($y == ""){
					echo "\n<div class='calendar_row'>\n<div class='calendar__year_label'>totale</div>\n";
					for($i = 0; $i < 12; $i++)
						echo "<div class='calendar__day calendar__day_not_in_month'>NA</div>\n";
					echo "<div class='calendar__month_tot aright'>" . $nhrs . "</div>\n</div><!-- row -->\n";	
				}			

			 //    if($firstmonth != 9  && $isBeg == 0){
				// 	echo "\n<div class='calendar_row'>\n<div class='calendar__year_label'>" . $startyear;
				// 	$toyear = intval($startyear) +1 ;
				// 	echo "-" . $toyear . "</div>\n";
				// 	/* empty months */
				// 	if($firstmonth > 9) {
				// 		for(; $i < $firstmonth; $i++)
				// 			$headstr = $headstr ."<div class='calendar__day calendar__day_not_in_month'>NA</div>\n";
				// 		//$i = 9;
				// 	} else if ($firstmonth < 9) {
				// 		for(; $i <= 12; $i++)
				// 			$headstr = $headstr ."<div class='calendar__day calendar__day_not_in_month'>NA</div>\n";
				// 		for($i = 1; $i < $firstmonth; $i++)
				// 			$headstr = $headstr ."<div class='calendar__day calendar__day_not_in_month'>NA</div>\n";
				// 	}
				// 	for(; $i <= 8; $i++){
				// 		$headstr =  $headstr ."<div class='calendar__day calendar__day_working";
				// 		if($mhours[$j]['MM'] == ($i % 12)){
				// 			if ($y == "" && $mhours[$j]['MM'] == $firstmonth && $mhours[$j]['YY'] == $firstyear)
				// 				$headstr = $headstr . " date__lastexam ";
				// 			$headstr = $headstr . " '>";
				// 			$headstr = $headstr . $mhours[$j]['MH'];
				// 			$nhrs = $nhrs + intval($mhours[$j]['MH']);
				// 			$yhrs = $yhrs + intval($mhours[$j]['MH']);
				// 			$j++;
				// 			$ndati--;
				// 		} else if ($mhours[$j]['MM'] == 12){
				// 			if ($y == "" && $mhours[$j]['MM'] == $firstmonth && $mhours[$j]['YY'] == $firstyear)
				// 				$headstr = $headstr . " date__lastexam ";
				// 			$headstr = $headstr . "'>";
				// 			$headstr = $headstr . $mhours[$j]['MH'];
				// 			$nhrs = $nhrs + intval($mhours[$j]['MH']);
				// 			$yhrs = $yhrs + intval($mhours[$j]['MH']);
				// 			$j++;
				// 			$ndati--;
				// 		} else {
				// 			$headstr = $headstr . "'>";
				// 			$headstr = $headstr . "0";
				// 		}
				// 		$headstr = $headstr . "</div>\n";
				// 		echo $headstr;
				// 		$headstr = "";
				// 	}
				// 	echo "<div class='calendar__month_tot'>" . $yhrs . "</div>\n</div>";
				// }
				// while($ndati > 0){
				// 	echo "\n<div class='calendar_row'>\n<div class='calendar__year_label'>" . $startyear;
				// 	$startyear = intval($startyear) +1 ;
				// 	echo "-" . $startyear . "</div>\n";
				// 	for($i = 9, $yhrs = 0; $i < 21; $i++){
				// 		$headstr =  $headstr ."<div class='calendar__day calendar__day_working";
				// 		if($mhours[$j]['MM'] == ($i % 12)){
				// 			if ($y == "" && $mhours[$j]['MM'] == $firstmonth && $mhours[$j]['YY'] == $firstyear)
				// 				$headstr = $headstr . " date__lastexam ";
				// 			$headstr = $headstr . "'>";
				// 			if($mhours[$j]['MH'] == ""){
				// 				$headstr = $headstr . "0";
				// 			} else {
				// 				$headstr = $headstr . $mhours[$j]['MH'];
				// 			}
				// 			$nhrs = $nhrs + intval($mhours[$j]['MH']);
				// 			$yhrs = $yhrs + intval($mhours[$j]['MH']);
				// 			$j++;
				// 			$ndati--;
				// 		} else if ($mhours[$j]['MM'] == 12){
				// 			if ($y == "" && $mhours[$j]['MM'] == $firstmonth && $mhours[$j]['YY'] == $firstyear)
				// 				$headstr = $headstr . " date__lastexam ";
				// 			$headstr = $headstr . "'>";
				// 			if($mhours[$j]['MH'] == ""){
				// 				$headstr = $headstr . "0";
				// 			} else {
				// 				$headstr = $headstr . $mhours[$j]['MH'];
				// 			}
				// 			$nhrs = $nhrs + intval($mhours[$j]['MH']);
				// 			$yhrs = $yhrs + intval($mhours[$j]['MH']);
				// 			$j++;					
				// 			$ndati--;
				// 		} else{
				// 			$headstr = $headstr . "'>";
				// 			$headstr = $headstr . "0";
				// 		}
				// 		$headstr = $headstr . "</div>\n";
				// 		echo $headstr;
				// 		$headstr = "";
				// 	}
				// 	echo "<div class='calendar__month_tot'>" . $yhrs . "</div>\n</div>";				
				// }

?>
		<p><br/><br/><br/></p>
			</center>
		  </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script>window.jQuery || document.write('<script src="./js/jquery-1.7.2.min.js"><\/script>')</script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/bootstrap-checkbox.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="../assets/js/holder.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../assets/js/ie10-viewport-bug-workaround.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../assets/js/fileinput.js"></script>
  </body>
</html>
