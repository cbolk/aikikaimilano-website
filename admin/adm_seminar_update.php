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
    header("Location: adm_index.php");
    exit;
  } 

	$db = new dbaccess();

	/* do the insertion */
	$ns = new seminar();
	$ns->id = $_POST["id"];
	$ns->fromdate = $db->date_to_db($_POST["startdate"]); 
	$ns->shortdate = date("Ymd", strtotime($ns->fromdate));
	$ns->todate = $db->date_to_db($_POST["enddate"]);
	$ns->title = convertCRBR(addslashes(htmlentities($_POST["title"])));		
	$ns->description = convertCRBR(addslashes(htmlentities($_POST["description"])));		
	$ns->locationfk = $_POST["locationid"];
	if($_POST["locationid"] === NULL || $_POST["locationid"] == ""){
		$ns->location = convertCRBR(addslashes(htmlentities($_POST["location"])));
		$ns->shortcity = convertCRBR(addslashes(htmlentities($_POST["shortcity"])));
		$ns->address = convertCRBR(addslashes(htmlentities($_POST["address"])));
		$ns->city = convertCRBR(addslashes(htmlentities($_POST["city"])));
	} 
	$ns->seminartype = $_POST["seminartype"];
	if(!($_POST["seminarinstructor1"]===NULL || $_POST["seminarinstructor1"] == ""))
		$ns->instructors[0]['id'] = $_POST["seminarinstructor1"];
	if(!($_POST["seminarinstructor2"]===NULL || $_POST["seminarinstructor2"] == ""))
		$ns->instructors[1]['id'] = $_POST["seminarinstructor2"];
	if(!($_POST["seminarinstructor3"]===NULL || $_POST["seminarinstructor3"] == ""))
		$ns->instructors[2]['id'] = $_POST["seminarinstructor3"];

	$ns->organizerfk = $_POST["organizerfk"];
	if($_POST["organizerfk"] === NULL || $_POST["organizerfk"] == ""){
		$ns->organizer = addslashes(htmlentities($_POST["organizer"], ENT_QUOTES));
		$ns->phone = $_POST["phone"];
		$ns->email = $_POST["email"];
		$ns->url = $_POST["url"];
	}
	$ns->pdf =	$_FILES['pdf']['name'];
	$ns->photo = $_FILES['photo']['name'];
	$ns->notes	= convertCRBR($_POST["notes"]);
	$ns->schedule	= convertCRBR($_POST["schedule"]);
	if(!($_POST["expires"]===NULL || $_POST["expires"] == "") )
		$ns->expires = $db->date_to_db($_POST["expires"]);
	else
		$ns->expires = date('Y-m-d', strtotime('+1 year'));
	//$ns->setGCal();

	/**/
	if($ns->locationfk){
		$ns->location = NULL;
		$ns->address = NULL;
		$ns->city = NULL;
		$ns->shortcity = NULL;						
	}
	
	$ns->visible	= convertCRBR($_POST["visible"]);
	
	$ris =  $ns->update($db);

	if ($ns->pdf != ""){
		$srcfile = $_FILES['pdf']['tmp_name'];
		$dstfile =  $uploadpath . $_FILES['pdf']['name'];
		if (!move_uploaded_file($srcfile, $dstfile)) {
				echo('locandina non caricata!');
		}
	}
	if ($ns->photo != ""){
		$srcfile = $_FILES['photo']['tmp_name'];
		$dstfile =  $uploadpath . $_FILES['photo']['name'];
		if (!move_uploaded_file($srcfile, $dstfile)) {
				echo('foto per elenco seminari non caricata!');
		}
	}
	return $ris;
?>
