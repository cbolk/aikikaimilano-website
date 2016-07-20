<?php
	setlocale(LC_TIME, 'ita');
	date_default_timezone_set('Europe/Rome');
  	include("./adm/class.utilities.php");
  	include("./adm/class.db.php");
	include("./adm/class.seminar.php");

	$db = new dbaccess();
	$db->dbconnect();
	$seminar = new seminar();
	$util = new utils();
  	$thismonth = Date('m');
  	$nextsem = $util->getNextStageMMDD($db);

	$updateON = $seminar->lastUpdate($db);

	$today = Date('Y-m-d');
	if(date('m', strtotime($today)) >= 7 && date('d', strtotime($today)) > 10)
		$year = date('Y', strtotime($today));
	else
		$year = date('Y', strtotime($today)) - 1;


?>
<!DOCTYPE html>
<head lang="it">
    <title>Aikikai Milano - Elenco seminari</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
    <!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
    <link rel="icon" type="image/png" href="assets/img/logo.png">
</head>
<body>
    
    <!-- Header -->
	<?php include('./header.php'); ?>
    
    
    <!-- Main -->
    <div id="wrapper">

      <section class="color">
	        <p>&#9671;&#9671;</p>
      </section>

      <section id="seminars" class="odd">
		<div class="container">
		  <header>
			<h3 class="cntr">calendario seminari <?php echo "$year-" . ($year+1); ?></h3>
		  </header>

		  <hr/>

  	  	  <div class="features">
			<?php 
				$today = date("Y-m-d");
				$thismonth = date("m");
				for($i = 9; $i <= 12; $i++){
					$semlist = $seminar->getStagesStartedMonthYear($db,$i,$year);
					$nsem = count($semlist);
					if($nsem > 0){
						$firstdaymonth = $year . "-" . sprintf("%02d", $num) . "-01";
						for($isem = 0; $isem < $nsem; $isem++){
							$SemID = $semlist[$isem]["id"];
							$seminario = $seminar->get($db,$SemID);
							$from = $util->medDate($seminario->fromdate);
							$fromMob = $util->medDate($seminario->fromdate);
							$to = $util->medDate($seminario->todate);
							$toMob = $util->medDate($seminario->todate);
							$semUID = sprintf(str_replace("-", "", $seminario->fromdate),4,4);
							echo "<article><a id='" . $semUID . "'></a>";
							if($seminario->photo != null)
								echo "<a href='#' class='image'><img width='140px' class='img-responsive' src='./seminars/" . $seminario->photo . "' /></a>";
							echo "<div class='inner'>";
							echo "  <h4>";
							echo $seminario->title;
							if (strpos($seminario->title,"Maestro") == FALSE && strpos($seminario->title,"Shihan") == FALSE && strpos($seminario->title,"M&deg;") == FALSE && strpos($seminario->title,"M°") == FALSE ){
								echo'<br/>' . $seminario->instructorlabel;								
							}
							echo "  </h4>";
							echo "<ul class='leftindent'>";
							echo "<li class='itemli'><span class='itemhead'>Quando:</span><span class='itemval'>" .   $from . " <em>-</em> " . $to . "</span></li>";
							echo "<li class='itemli'><span class='itemhead'>Dove:</span><span class='itemval'>" . $seminario->shortcity ;
							if($seminario->location != "") 
								echo "&nbsp;&#9671;&nbsp;" . str_replace("<br/>", " ", $seminario->location);
							if($seminario->location != $seminario->organizer  && $seminario->organizer!= "")
								echo "&nbsp;&#9671;&nbsp;" . $seminario->organizer . "</span></li>";
							echo "<li class='itemli'><span class='itemhead'>Locandina:</span><span class='itemval'>";
							if($seminario->pdf != NULL)
								echo "pdf <a class='noborder disable' title='scarica la locandina' href='./seminars/$seminario->pdf'><span class='icon fa-file-pdf-o fa-fw smallicon'></span></a>";
							else
								echo "disponibile prossimamente";
							echo "</li>";
							echo "<li class='itemli'><span class='itemhead'>Note:</span><span class='itemval small'>" .   $seminario->seminartype . "</span>";
							echo "</li>";
							echo "</ul>";
							if($seminario->description)
								echo "<span class='itemval small'>" .   html_entity_decode($seminario->description) . "</span>";
							echo "</div><!--inner-->";
							echo "</article>";
						}
					}
				}
				$year++;
				for($i = 1; $i < 9; $i++){
					$semlist = $seminar->getStagesStartedMonthYear($db,$i,$year);
					$nsem = count($semlist);
					if($nsem > 0){
						$firstdaymonth = $year . "-" . sprintf("%02d", $num) . "-01";
						for($isem = 0; $isem < $nsem; $isem++){
							$SemID = $semlist[$isem]["id"];
							$seminario = $seminar->get($db,$SemID);
							$from = $util->medDate($seminario->fromdate);
							$fromMob = $util->medDate($seminario->fromdate);
							$to = $util->medDate($seminario->todate);
							$toMob = $util->medDate($seminario->todate);
							$semUID = sprintf(str_replace("-", "", $seminario->fromdate),4,4);
							echo "<article><a id='" . $semUID . "'></a>";
							if($seminario->photo != null){
								echo "<a href='#' class='image'><img src='./seminars/" . $seminario->photo . "' /></a>";
							}
							echo "<div class='inner'>";
							echo "  <h4>" . $seminario->title . "</h4>";
							if (strpos($seminario->title,"Maestro") == FALSE && strpos($seminario->title,"Shihan") == FALSE && strpos($seminario->title,"M&deg;") == FALSE && strpos($seminario->title,"M°") == FALSE ){
								echo "  <h4>" . $seminario->instructorlabel . "</h4>";
							}
							echo "<ul class='leftindent'>";
							echo "<li class='itemli'><span class='itemhead'>Quando:</span><span class='itemval'>" .   $from . " <em>-</em> " . $to . "</span></li>";
							echo "<li class='itemli'><span class='itemhead'>Dove:</span><span class='itemval'>" . $seminario->shortcity ;
							if($seminario->location != "") 
								echo "&nbsp;&#9671;&nbsp;" . str_replace("<br/>", " ", $seminario->location);
							if($seminario->location != $seminario->organizer && $seminario->organizer != "")
								echo "&nbsp;&#9671;&nbsp;" . $seminario->organizer . "</span></li>";
							echo "<li class='itemli'><span class='itemhead'>Locandina:</span><span class='itemval'>";
							if($seminario->pdf != NULL)
								echo "pdf <a class='noborder disable' title='scarica la locandina' href='./seminars/$seminario->pdf'><span class='icon fa-file-pdf-o fa-fw smallicon'></span></a>";
							else
								echo "disponibile prossimamente";
							echo "</li>";
							echo "<li class='itemli'><span class='itemhead'>Note:</span><span class='itemval small'>" .   $seminario->seminartype . "</span></li>";
							echo "</ul>";
							if($seminario->description)
								echo "<span class='itemval small'>" .   html_entity_decode($seminario->description) . "</span>";
							echo "</div><!--inner-->";
							echo "</article>";
						}
					}
				}

  	  	  		$n = count($semlist);
  	  	  		for($i = 0; $i < $n; $i++){
  	  	  			?>
					<article>
						<a href="#" class="image"><img src="stages/<?php echo $semlist[$i][$photo]; ?>" alt="" /></a>
						<div class="inner">
							<h4><?php echo $semlist[$i][$title]; ?></h4>
							<p><?php echo $semlist[$i][$date]; ?></p>
						</div>
					</article>  	  	  				
					<?php
  	  	  		}
  	  	  	?>

  	  	  </div>
	  
		</div><!-- div container -->
      </section>
            
     <section class="color">
			<div class='note calnote smallicon center'>&nbsp;&nbsp;Pagina soggetta a variazioni. 
			<!--Ultimo aggiornamento: <span class="black"><?php echo  $updateON; ?></span--></div>
      </section>

    </div><!-- wrapper/main -->
    
    <!-- Footer -->
	 <?php include('./footer.php'); ?>
    
	<!-- google -->
	<?php include_once("analyticstracking.php") ?>

    <!-- Scripts -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/jquery.scrolly.min.js"></script>
    <script src="assets/js/jquery.scrollzer.min.js"></script>
    <script src="assets/js/skel.min.js"></script>
    <script src="assets/js/util.js"></script>
    <!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
    <script src="assets/js/main.js"></script>
    
  </body>
</html>
