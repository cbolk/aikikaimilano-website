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

	if($_GET["y"]){
		$y = $_GET["y"];
		$from = $y;
		$to = intval($y)+1;
		$title = $from . "-" . $to;
		$nyears = 1;
	} else if ($_GET["from"]) {
		$y = "";
		$from = $_GET["from"];
		$to = intval($_GET["to"])+1;
		$title = "dall'a.a. " . $from . "-" . (intval($from)+1) . " all'a.a. " . (intval($to)-1) . "-" . $to;
		$nyears = intval($_GET["to"]) - intval($_GET["from"]) +1;
	} else {
		$y = "";
		$from = "";
		$to = "";
		$title = "complessivo";
	}

	$dbconn = new dbaccess();
	$dbconn->dbconnect();

$examhours = array(
    0 => array(
        'rank' => 'mu',
        'hours' => '20'
    ),
    1 => array(
        'rank' => '6 kyu',
        'hours' => '20'
    ),
    2 => array(
        'rank' => '5 kyu',
        'hours' => '60'
    ),
    3 => array(
        'rank' => '4 kyu',
        'hours' => '90'
    ),
    4 => array(
        'rank' => '3 kyu',
        'hours' => '110'
    ),
    5 => array(
        'rank' => '2 kyu',
        'hours' => '150'
    ),
    6 => array(
        'rank' => '1 kyu',
        'hours' => '200'
    ),
    7 => array(
        'rank' => 'shodan',
        'hours' => '500'
    ),
    8 => array(
        'rank' => 'nidan',
        'hours' => '600'
    ),
    9 => array(
        'rank' => 'sandan',
        'hours' => '800'
    )
 );

	function ranktohours($info, $r)
	{
		$ne = count($info);
		for($i = 0; $i < $ne; $i++)
			if($info[$i]['rank'] == $r)
				return $info[$i]['hours'];
		return -1;
	}


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
	<title>presenze</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" type="text/css" href="../assets/css/jquery-ui-1.8.20.custom.css">
    <link href="../assets/css/bootstrap.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../assets/css/dashboard.css" rel="stylesheet">
    <link href="../assets/css/dashboardAF.css" rel="stylesheet">
		<link rel="stylesheet" href="../assets/css/admcalendar.css" /> 

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type='text/javascript' src='//code.jquery.com/jquery-2.1.1.min.js'></script>
    <script type="text/javascript" language="javascript" src="../js/jquery-ui-1.8.20.custom.min.js" ></script>   
	<script type="text/javascript" src="../js/presenze.js"></script>
<style>
	td.green {background-color: #7dbe7d}
	tr.beginner {background-color: #5BC0DE}
</style>

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
        
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">
			<?php 
				$ai = new aikidoka();
				if($aid != -1){
					$person = $ai->fullname($dbconn, $aid);
					$isBeg = $ai->isBeginner($dbconn, $aid);
					$aiid = $aid;
					echo  $person[0]['fullname'] ;
				} else 
					echo "dati iscritti attivi";
			?>
		  <!--div class='actions aright'>
		  	<a href='./adm_attendance_month.php' alt="elenco presenze"><i class="fa fa-bars"></i> elenco</a>&nbsp;
		  <?php
				if($y != "") {
					echo "<a href='./adm_attendance_yearly.php?aid=" . $aiid. "' alt='elenco presenze'><i class='fa fa-bar-chart fa-fw'></i> da esame</a>";
				} else {
					echo "<a href='./adm_attendance_yearly.php?aid=" . $aiid . "&y=" . $year . "' alt='elenco presenze'><i class='fa fa-bar-chart fa-fw'></i> anno</a>";
				}
		  ?>
		  	
		  </div-->
          </h1>
		  <div class='clearfix'></div>
          <div class="row">
	        <center>			
			<h3><?php
				echo $title;
				if($aid != -1){
					if($y != "") {						
			    		$mhours = $ai->getHoursYear($dbconn, $aid, $from, $to);
					} else {
			    		$mhours = $ai->getHoursFromExam($dbconn, $aid);
					}					
				} else {
					if($y != "") {
			    		$mhours = $ai->getHoursYearAllAikidokas($dbconn, $from, $to);
					} else {
			    		$mhours = $ai->getHoursFromExamsAllAikidokas($dbconn);
					}					

				}
				?>
			</h3>
				<table class='table table-striped' id='ajaxtable'>
				<thead>
				  <tr>
						<th>id</th>
						<th>nominativo</th>
						<th>data iscizione</th>
						<th>grado</th>
						<th>data ultimo esame</th>
						<?php
							$headstr = "";
							$froma = $from;
							$toa = intval($froma) + 1;
							for($ny = 0; $ny < $nyears; $ny++){
								$headstr = $headstr . "<th>" . $froma . " - " . $toa . "</th>\n";
								$froma = $toa;
								$toa = intval($froma) + 1;
							}
							echo $headstr;
						?>
						<th>TOT</th>
						<th>n. ore necessarie</th>
				  </tr>
				</thead>
				<tbody>
			<?php
				$ndati = count($mhours);
//				if($aid != -1 && $title == "complessivo"){	// hours from exams
					$i = 0;
					while($i < $ndati){
						$examh = ranktohours($examhours, $mhours[$i]['rank']);
						if(intval($mhours[$i]['tothours']) >= intval($examh))
							$col = "green";
						else
							$col = "";
						echo "<tr>";
						if($mhours[$i]['beginner'] == 1) 
							echo "<tr class='beginner'>";
						else
							echo "<tr>";
						echo "<td>" . $mhours[$i]['aikidoka_fk'] . "</td>";
						echo "<td>" . $mhours[$i]['lastname'] . " " . $mhours[$i]['firstname'] . "</td>";
						echo "<td>" . $dbconn->db_to_date($mhours[$i]['enrolled']) . "</td>";
						echo "<td>" . $mhours[$i]['rank'] . "</td>";
						echo "<td>" . $dbconn->db_to_date($mhours[$i]['last_exam']) . "</td>";
						echo "<td class='" . $col . "'>" . $mhours[$i]['tothours'] . "</td>";
						echo "<td>" . $examh . "</td>";
						echo "</tr>";
						$i++;
					}
//				}
/*
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

		*/

?>
			</tbody>
			</table>
			</center>
			<p>Numero voci in elenco: <?php echo $ndati; ?></p>
			<p><br/><br/><br/></p>
		  </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script>window.jQuery || document.write('<script src="./js/jquery-1.7.2.min.js"><\/script>')</script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/bootstrap-checkbox.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="../js/holder.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../js/ie10-viewport-bug-workaround.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/fileinput.js"></script>
  </body>
</html>
