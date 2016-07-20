<?php  session_start();

	include("./basic.php");
	include("./class.db.php");
	include("./class.login.php");
	include("./class.seminar.php");
	include("./class.utilities.php");
	$log = new logmein();
	$log->encrypt = true; //set encryption 
	$isLogged = $log->logincheck($_SESSION['loggedin'], "user_t", "passwd", "login");	

	if($isLogged == false) { 
		header("Location: index.php");
		exit;
	} 

	$db = new dbaccess();

	/* do the insertion */
	$ns = new seminar();
	$ns->fromdate = $db->date_to_db($_POST["startdate"]); 
	$ns->shortdate = date("Ymd", strtotime($ns->fromdate));
	$ns->todate = $db->date_to_db($_POST["enddate"]);
	$ns->title = convertCRBR(addslashes(htmlentities($_POST["title"], ENT_QUOTES)));		
	$ns->description = convertCRBR(addslashes(htmlentities($_POST["description"], ENT_QUOTES)));		
	if($_POST["locationid"] != NULL && $_POST["locationid"] != "NULL"){
		$ns->locationfk = $_POST["locationid"];
		$ns->location = NULL;
		$ns->address = NULL;
		$ns->city = NULL;
		$ns->shortcity = NULL;						
	} else {
		$ns->locationfk = 0;
		$ns->location = $_POST["location"];
		$ns->shortcity = convertCRBR(htmlentities($_POST["shortcity"], ENT_QUOTES));
		$ns->address = convertCRBR(htmlentities($_POST["address"], ENT_QUOTES));
		$ns->city = convertCRBR(htmlentities($_POST["city"], ENT_QUOTES));
	}
	$ns->seminartype = $_POST["seminartype"];
	if(!($_POST["seminarinstructor1"]===NULL || $_POST["seminarinstructor1"] == ""))
		$ns->instructors[0]['id'] = $_POST["seminarinstructor1"];
	if(!($_POST["seminarinstructor2"]===NULL || $_POST["seminarinstructor2"] == ""))
		$ns->instructors[1]['id'] = $_POST["seminarinstructor2"];
	if(!($_POST["seminarinstructor3"]===NULL || $_POST["seminarinstructor3"] == ""))
		$ns->instructors[2]['id'] = $_POST["seminarinstructor3"];

	if($_POST["organizerfk"] != NULL && $_POST["organizerfk"] != "NULL"){
		$ns->organizerfk = $_POST["organizerfk"];
	} else {
		$ns->organizerfk = 0;
		$ns->organizer = addslashes(htmlentities($_POST["organizer"], ENT_QUOTES));
		$ns->phone = $_POST["phone"];
		$ns->email = $_POST["email"];
		$ns->url = $_POST["url"];		
	}
	$ns->tags = $_POST["tags"];
	$ns->pdf =	$_FILES['pdf']['name'];
	$ns->image = $_FILES['image']['name'];
	$ns->photo = $_FILES['photo']['name'];
	$ns->notes	= convertCRBR($_POST["notes"]);
	$ns->schedule	= convertCRBR($_POST["schedule"]);
	if(!($_POST["expires"]===NULL || $_POST["expires"] == "") )
		$ns->expires = $db->date_to_db($_POST["expires"]);
	else
		$ns->expires = date('Y-m-d', strtotime('+1 year'));
	//$ns->setGCal();
	
	$ris =  $ns->add($db);

	if ($ns->pdf != ""){
		$srcfile = $_FILES['pdf']['tmp_name'];
		$dstfile =  $uploadpath . $_FILES['pdf']['name'];
		if (!move_uploaded_file($srcfile, $dstfile)) {
				echo('locandina non caricata!');
		}
	}
	if ($ns->image != ""){
		$srcfile = $_FILES['image']['tmp_name'];
		$dstfile =  $uploadpath . $_FILES['image']['name'];
		if (!move_uploaded_file($srcfile, $dstfile)) {
				echo('miniatura non caricata!');
		}
	}
	if ($ns->photo != ""){
		$srcfile = $_FILES['photo']['tmp_name'];
		$dstfile =  $uploadpath . $_FILES['photo']['name'];
		if (!move_uploaded_file($srcfile, $dstfile)) {
				echo('foto per elenco seminari non caricata!');
		}
	}
	echo $ris;
?>
