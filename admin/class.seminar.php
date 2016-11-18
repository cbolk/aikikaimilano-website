<?php

  class seminar {

  	var $id;
  	var $fromdate;
  	var $shortdate;
  	var $todate;
  	var $title;
  	var $description;
  	var $locationfk;
  	var $fulllocation;
  	var $location;
  	var $address;
  	var $city;
  	var $shortcity;
    var $lat;
    var $long;
  	var $seminartype;
  	var $instructors = array();
  	var $instructorlabel;
  	var $instructortag;
  	var $organizerfk;
  	var $organizer;
  	var $phone;
  	var $email;
  	var $opening;
  	var $url;
  	var $pdf;
  	var $pdfe;
  	var $photo;
  	var $pagelink;
  	var $expires;
  	var $notes;
  	var $schedule;
  	var $visible;

  	/* retrieves the info of a seminar */
  	function get($dbconn, $sid){
  		$sem = $this->getStage($dbconn, $sid);
  		//print_r($sem);
		$this->id =  $sem[0]['id'];
		if($this->id === NULL)
			return;

  		$this->fromdate = $sem[0]['startdate'];
  		$this->shortdate = date("Ymd", strtotime($this->fromdate));
  		$this->todate = $sem[0]['enddate'];
  		$this->description = $sem[0]['description'];
  		$this->title = $sem[0]['title'];

	    $this->locationfk = $sem[0]['locationfk'];
		if($this->locationfk != 0 && $this->locationfk != NULL){
    		$loc = $this->getLocation($dbconn, $this->locationfk);
			$this->location = $loc[0]['name'];
			$this->address = $loc[0]['address'];
			$this->city = $loc[0]['city'];
			$this->shortcity =$loc[0]['shortcity'];
		    $this->long = $loc[0]['longitude'];
		    $this->lat = $loc[0]['latitude'];
		    $this->placeID = $loc[0]['placeID'];
		} else {
			$this->location = $sem[0]['location'];
			$this->address = $sem[0]['address'];
			$this->city = $sem[0]['city'];
			$this->shortcity =$sem[0]['shortcity'];
		}
		$this->fulllocation = "<strong>" . $this->location . "</strong>: " . $this->address . " - " . $this->city;

		$this->seminartype = $sem[0]['semtype'];

		$this->organizerfk = $sem[0]['organizerfk'];
		if($this->organizerfk != 0){
			$this->organizer = $sem[0]['orgname'];
			$this->phone = $sem[0]['orgphone'];
			$this->email = $sem[0]['orgmail'];
			if(strpos($sem[0]['orgurl'],"http")==0)
				$this->url = $sem[0]['orgurl'];
			else
				$this->url = "http://" . $sem[0]['orgurl'];
			$this->opening = $sem[0]['orghours'];
		} else {
			$this->organizer = $sem[0]['organizer'];
			$this->phone = $sem[0]['phone'];
			$this->email = $sem[0]['email'];
			if(strpos($sem[0]['url'],"http")==0)
				$this->url = $sem[0]['url'];
			else
				$this->url = "http://" . $sem[0]['url'];
			$this->opening = "";
		}

		$this->pdf = $sem[0]['pdf'];
		$this->pdfe = $sem[0]['pdfe'];
		$this->photo = $sem[0]['photo'];
		$this->notes = $sem[0]['notes'];
		$this->schedule = $sem[0]['schedule'];

		$this->instructors = $this->getStageInstructors($dbconn, $this->id);
		$ninst = count($this->instructors);
		$this->instructorlabel = "";
		$this->instructortag = "";
		for($i = 0; $i < $ninst; $i++){
			if($this->instructors[$i]['lastname'] === "Foglietta" || $this->instructors[$i]['lastname'] === "Travaglini")
				$this->instructorlabel = $this->instructorlabel . "M&deg; ";
			
			$this->instructorlabel = $this->instructorlabel . $this->instructors[$i]['lastname'];
			$this->instructortag = $this->instructortag . substr($this->instructors[$i]['lastname'],1);
			if($i < $ninst - 1)
				$this->instructorlabel = $this->instructorlabel . " &amp; ";
		}
		$this->pagelink = $sem[0]['link'];

		$this->expires = $sem[0]['expires'];
		$this->visible = $sem[0]['visible'];
		return $this;
  	}

  	/* clear all fields */
  	function clear()
  	{
  		foreach ($this as &$value) 
 		   $value = null;
  	}

  	/* retrieves the information of a stage, given its ID */
  	/* returns an array */
	function getStage($dbconn, $sid)
	{
		$query = "SELECT s.*, st.description as semtype, l.name as locname, l.address as locaddress, l.city as loccity, l.shortcity as locshortcity, l.placeID as locplaceID, o.name as orgname, o.phone as orgphone, o.email as orgmail, o.website as orgurl, o.openinghours as orghours FROM seminar s LEFT JOIN seminartype st ON s.typefk=st.id LEFT JOIN location l ON s.locationfk = l.id LEFT JOIN location o ON s.organizerfk = o.id WHERE s.id = " . $sid . ";";
		//echo $query;
		$dbconn->dbconnect();
		$result = $dbconn->qry($query);
		$rownum = mysql_num_rows($result);
		if($rownum == 1){	/* stage */
	        $data = array();
	        while($row = mysql_fetch_assoc($result))
    	        $data[] = $row;

        }
		return $data;
	}

	/* returns the data of the next seminar to be held*/
	function getNextStage($dbconn)
	{
		$query = "SELECT s.*, st.description as semtype, l.name as locname, l.address as locaddress, l.city as loccity, l.shortcity as locshortcity, l.placeID as locplaceID, o.name as orgname, o.phone as orgphone, o.email as orgmail, o.website as orgurl, o.openinghours as orghours FROM seminar s LEFT JOIN seminartype st ON s.typefk=st.id LEFT JOIN location l ON s.locationfk = l.id LEFT JOIN location o ON s.organizerfk = o.id WHERE  s.enddate >= DATE(NOW()) AND s.visible = 1 order by s.startdate asc LIMIT 1;";
		$dbconn->dbconnect();
		$result = $dbconn->qry($query);
		$rownum = mysql_num_rows($result);
		if($rownum == 1){	/* next upcoming stage */
	        $data = array();
	        while($row = mysql_fetch_assoc($result))
    	        $data[] = $row;
			return $data;
        }
        return null;
	}

	/* returns the ID of the next seminar to be held*/
	function getNextStageID($dbconn)
	{
		$query = "SELECT id FROM seminar WHERE enddate >= DATE(NOW()) AND visible = 1 order by startdate asc LIMIT 1;";
		$dbconn->dbconnect();
		$result = $dbconn->qry($query);
		$rownum = mysql_num_rows($result);
		if($rownum == 1){	/* next upcoming stage */
	        $row = mysql_fetch_assoc($result);
			return $row['id'];
        }
        return null;
	}

	/* returns the data of the next seminar to be held
	COPIED ALSO TO UTILITIES */
	function getNextStageMMDD($dbconn)
	{
		$query = "SELECT startdate FROM seminar WHERE startdate >= DATE(NOW()) AND visible = 1 order by startdate asc LIMIT 1;";
		$dbconn->dbconnect();
		$result = $dbconn->qry($query);
		$rownum = mysql_num_rows($result);
        while($row = mysql_fetch_assoc($result)){
   	        $mmdd = sprintf($row['startdate'],4,4);
			return $mmdd;
        }
        return null;
	}


	/* adds a new seminar */
	function add($dbconn){

		$query = "INSERT INTO seminar (startdate, enddate, month, year, title, description, ";
		$query = $query . "locationfk, location, address, city, shortcity, schedule, typefk, organizerfk, ";
		$query = $query . "organizer, email, phone, url, link, notes, pdf, pdfe, image, photo, expires, visible) ";
		$query = $query . " values ('$this->fromdate','$this->todate',MONTH('$this->fromdate'),YEAR('$this->todate'), '$this->title', '$this->description', ";
		$query = $query . " $this->locationfk, '$this->location', '$this->address', '$this->city', '$this->shortcity', '$this->schedule', $this->seminartype, $this->organizerfk, ";
		$query = $query . " '$this->organizer', '$this->email', '$this->phone', '$this->url', '$this->pagelink', '$this->notes', '$this->pdf', '$this->pdfe', '$this->photo', '$this->expires', 1);";

		//echo $query;

		$result = $dbconn->qry($query);
		$newID = mysql_insert_id(); 

		/* add instructors */
		$inum = count($this->instructors);
		for($i = 0; $i < $inum; $i++){
			$query = "INSERT INTO seminarinstructor VALUES (" . $newID ."," . $this->instructors[$i]['id'] . "," . ($i+1) . ");";
			//echo $query;
			if(strpos($query,"NULL") == FALSE)
				$result = $dbconn->qry($query);
		}
		return $newID;
	}

	/* updates the info of a seminar */
	function update($dbconn){
		//$this->setGCal();

		$query = "UPDATE seminar SET startdate='$this->fromdate', enddate='$this->todate', month=MONTH('$this->fromdate'), ";
		$query = $query . "year=YEAR('$this->todate'), description='$this->description', title='$this->title', ";
		$query = $query . "locationfk=$this->locationfk, location='$this->location', address='$this->address', city='$this->city', shortcity='$this->shortcity',";
		$query = $query . " schedule='$this->schedule', typefk=$this->seminartype, organizerfk=$this->organizerfk, ";
		$query = $query . "organizer='$this->organizer', email='$this->email', phone='$this->phone', url='$this->url', pdf='$this->pdf', pdfe='$this->pdfe', link='$this->pagelink', notes='$this->notes', photo='$this->photo', expires='$this->expires', visible='$this->visible' ";
		$query = $query . " WHERE id = " . $this->id . ";";

		//echo $query;
		$result = $dbconn->qry($query);

		/* update instructors by deleteing them first */
		$query = "DELETE FROM seminarinstructor WHERE seminarfk = " . $this->id . ";";
		$resultinst = $dbconn->qry($query);

		$inum = count($this->instructors);
		for($i = 0; $i < $inum; $i++){
			$query = "INSERT INTO seminarinstructor VALUES (" . $this->id ."," . $this->instructors[$i]['id'] . "," . ($i+1) . ");";
			if(strpos($query,"NULL")  === false)
				$result = $dbconn->qry($query);
		}

		return $this->id;
	}

	/* deletes a seminar */
	function del($dbconn){

		$query = "DELETE FROM seminar WHERE id = " . $this->id . ";";
		$result = $dbconn->qry($query);
		
		/* instructors */
		$query = "DELETE FROM seminarinstructor WHERE seminarfk = " . $this->id . ";";
		$resultinst = $dbconn->qry($query);

		return $result;

	}

	/* retrieves the list of all seminar ids */
	function getStageListID($dbconn){
		$query = "SELECT id FROM seminar WHERE visible = 1 ORDER BY startdate DESC;";
		$dbconn->dbconnect();
		$result = $dbconn->qry($query);
        $data = array();
        while($row = mysql_fetch_assoc($result))
	        $data[] = $row;
		return $data;
	}

	function getStagesMonthYear($dbconn, $month, $year){
		$query = "SELECT s.*, st.description as semtype, l.name as locname, l.address as locaddress, l.city as loccity, l.placeID as locplaceID, o.name as orgname, o.phone as orgphone, o.email as orgmail, o.website as orgurl, o.openinghours as orghours FROM seminar s LEFT JOIN seminartype st ON s.typefk=st.id LEFT JOIN location l ON s.locationfk = l.id LEFT JOIN location o ON s.organizerfk = o.id WHERE (MONTH(startdate) = $month AND YEAR(startdate) = $year) OR (MONTH(enddate) = $month AND YEAR(enddate) = $year) AND visible = 1 ORDER BY startdate asc;";
		$dbconn->dbconnect();
        $result = $dbconn->qry($query);
        if($result){
	        $data = array();
	        while($row = mysql_fetch_assoc($result))
    	        $data[] = $row;
        }
		return $data;
	}

	function getStagesStartedMonthYear($dbconn, $month, $year){
		$query = "SELECT s.*, st.description as semtype, l.name as locname, l.address as locaddress, l.city as loccity, l.placeID as locplaceID, o.name as orgname, o.phone as orgphone, o.email as orgmail, o.website as orgurl, o.openinghours as orghours FROM seminar s LEFT JOIN seminartype st ON s.typefk=st.id LEFT JOIN location l ON s.locationfk = l.id LEFT JOIN location o ON s.organizerfk = o.id WHERE (MONTH(enddate) = $month AND YEAR(enddate) = $year) AND visible = 1 ORDER BY startdate asc;";
		$dbconn->dbconnect();
        $result = $dbconn->qry($query);
        if($result){
	        $data = array();
	        while($row = mysql_fetch_assoc($result))
    	        $data[] = $row;
        }
		return $data;
	}

  	function rawlist($dbconn, $activeonly, $thisyearonly, $reverseorder = false){
  		if($thisyearonly){
			$today = Date('Y-m-d');
			if(date('m', strtotime($today)) >= 9)
				$year = date('Y', strtotime($today));
			else
				$year = date('Y', strtotime($today)) - 1;
			$from = $year . "-09-01";
  		}
  		if($activeonly && $thisyearonly)			
			$query = "SELECT * from seminar where DATE(startdate) >= '" . $from . "' AND (DATE(expires) > DATE(NOW()) OR expires='0000-00-00') order by startdate";
  		else if ($thisyearonly)
			$query = "SELECT * FROM seminar WHERE DATE(startdate) >= '" . $from . "' ORDER BY startdate";
		else
			$query = "SELECT * FROM seminar ORDER BY startdate ";

		if($reverseorder)
			$query = $query . " DESC;";
		else
			$query = $query . " ASC;";
		//echo $query;
		$dbconn->dbconnect();
        $result = $dbconn->qry($query);
  		return $result;
  	}

	/* returns the number of active seminars */
	function numActiveSeminars($dbconn)
	{
		$query = "SELECT COUNT(*) FROM seminar WHERE DATE(enddate) > DATE(NOW());";
		$dbconn->dbconnect();
        $result = $dbconn->qry($query);
        $row = mysql_fetch_array($result);
        return $row[0];
        
	}

	/* returns the number of active seminars */
	function numNotVisibleSeminars($dbconn)
	{
		$query = "SELECT COUNT(*) FROM seminar WHERE DATE(enddate) > DATE(NOW()) AND visible =  0;";
		$dbconn->dbconnect();
        $result = $dbconn->qry($query);
        $row = mysql_fetch_array($result);
        return $row[0];
        
	}

	/* returns the number of semianrs */
	function numSeminars($dbconn)
	{
		$query = "SELECT COUNT(*) FROM seminar;";
		$dbconn->dbconnect();
        $result = $dbconn->qry($query);
        $row = mysql_fetch_array($result);
        return $row[0];
        
	}

  	/* retrieves the list of seminars, eventually those that are active and/or upcoming only */
  	function getList($dbconn, $activeonly, $upcoming){
  		if($activeonly){
  			$strCond = "WHERE DATE(expires) > DATE(now()) OR expires='0000-00-00' ";
	  		if($upcoming)
  				$strCond = $strCond . " AND DATE(enddate) > DATE(now()) ";
  		} else if($upcoming)
  			$strCond = " WHERE DATE(enddate) > DATE(now()) ";

 		//$query = "SELECT * from seminar " . $strCond . " ORDER BY startdate DESC;";
 		$query = "SELECT * from seminar " . $strCond . " AND visible = 1 ORDER BY date DESC;";
		$dbconn->dbconnect();
		$result = $dbconn->qry($query);
		$rownum = mysql_num_rows($result);
		if($rownum >= 1){	/* seminar type */
	        $data = array();
	        while($row = mysql_fetch_assoc($result))
    	        $data[] = $row;

        }
		return $data;
 	}

	/* retrieves the instructors for a given stage by ID */
	function getStageInstructors($dbconn, $sid)
	{
		$query = "SELECT i.* from instructor i INNER JOIN seminarinstructor si ON i.id=si.instructorfk WHERE si.seminarfk = " . $sid . " ORDER BY sorting;";
		$dbconn->dbconnect();
		$result = $dbconn->qry($query);
		$rownum = mysql_num_rows($result);
		if($rownum >= 1){	/* next upcoming stage */
	        $data = array();
	        while($row = mysql_fetch_assoc($result))
    	        $data[] = $row;

        }
		return $data;
	}

	/* builds a selection for the instructors */
	function getStageInstructorsDropdown($dbconn,$order,$iid=NULL)
	{
		$query = "SELECT * from instructor ORDER BY sorting, rank DESC;";
		$dbconn->dbconnect();
		$result = $dbconn->qry($query);
		$rownum = mysql_num_rows($result);
		if($rownum >= 1){
	        $data = "<select class='seminardd' name='seminarinstructor" . $order . "'>";
	        while($row = mysql_fetch_assoc($result)){
    	        $data = $data . "<option ";
    	        if($iid != NULL && $iid == $row['id'])
    	        	$data = $data . " selected ";
	    	    $data = $data . " value='" . $row['id'] . "'>" . $row['lastname'] . "</option>";
	        }

	        $data = $data . "<option value='NULL'";
	        if($iid == NULL || $iid == 0)
	        	$data = $data . " selected ";
	        $data = $data . ">&nbsp;</option>";
    	    $data = $data . "</select>";
        }
		return $data;
	}

	/* builds a list of options for the dropdown of the selection for the instructors */
	function getStageInstructorsOptions($dbconn,$iid=NULL)
	{
		$query = "SELECT * from instructor ORDER BY sorting, rank DESC;";
		$dbconn->dbconnect();
		$result = $dbconn->qry($query);
		$rownum = mysql_num_rows($result);
		if($rownum >= 1){
	        $data = "";
	        while($row = mysql_fetch_assoc($result)){
    	        $data = $data . "<option ";
    	        if($iid != NULL && $iid == $row['id'])
    	        	$data = $data . " selected ";
	    	    $data = $data . " value='" . $row['id'] . "'>" . $row['lastname'] . "</option>";
	        }

	        $data = $data . "<option value='NULL'";
	        if($iid == NULL || $iid == 0)
	        	$data = $data . " selected ";
	        $data = $data . ">&nbsp;</option>";
    	    
        }
		return $data;
	}

	/* retrieves the type of a seminar */
	function getStageType($dbconn, $sid)
	{
		$query = "SELECT * from seminartype st INNER JOIN seminar s ON st.id=s.typefk WHERE s.id = " . $sid . ";";
		$dbconn->dbconnect();
		$result = $dbconn->qry($query);
		$rownum = mysql_num_rows($result);
		if($rownum >= 1){	/* seminar type */
	        $data = array();
	        while($row = mysql_fetch_assoc($result))
    	        $data[] = $row;

        }
		return $data;
	}

	/* gets types of seminars */
	function getTypes($dbconn)
	{
		$query = "SELECT * from seminartype ORDER BY name;";
		$dbconn->dbconnect();
		$result = $dbconn->qry($query);
		$rownum = mysql_num_rows($result);
		if($rownum >= 1){	/* seminar type */
	        $data = array();
	        while($row = mysql_fetch_assoc($result))
    	        $data[] = $row;

        }
		return $data;
	}

	/* builds a selection for the instructors */
	function getTypeDropdown($dbconn,$tid = NULL)
	{
		$query = "SELECT * from seminartype ORDER BY description;";
		$dbconn->dbconnect();
		$result = $dbconn->qry($query);
		$rownum = mysql_num_rows($result);
		if($rownum >= 1){
	       $data = "<select class='seminardd' name='seminartype'>";
	        while($row = mysql_fetch_assoc($result))
	        	if(($row['description'] == "ordinario" && $tid == NULL) || ($tid == $row['id']))
	    	        $data = $data . "<option selected value='" . $row['id'] . "'>" . $row['description'] . "</option>";
				else
	    	        $data = $data . "<option value='" . $row['id'] . "'>" . $row['description'] . "</option>";

	        $data = $data . "<option ";
	        if($tid == NULL || $tid == 0)
	        	$data = $data . " selected ";
	        $data = $data . " value='NULL'>&nbsp;</option>";
	    	$data = $data . "</select>";
        }
		return $data;
	}

	/* builds a list of options for the instructors */
	function getTypeOptions($dbconn,$tid = NULL)
	{
		$query = "SELECT * from seminartype ORDER BY description;";
		$dbconn->dbconnect();
		$result = $dbconn->qry($query);
		$rownum = mysql_num_rows($result);
		$sel = false;
		if($rownum >= 1){
 	        $data = "";
	        while($row = mysql_fetch_assoc($result))
	        	if(($row['description'] == "ordinario" && $tid === NULL) || ($tid == $row['id'])){
	    	        $data = $data . "<option selected value='" . $row['id'] . "'>" . $row['description'] . "</option>";
	    	        $sel = true;
				} else
	    	        $data = $data . "<option value='" . $row['id'] . "'>" . $row['description'] . "</option>";

	        $data = $data . "<option ";
	        if($sel == false && ($tid == NULL || $tid == 0))
	        	$data = $data . " selected ";
	        $data = $data . " value='NULL'>&nbsp;</option>";
        }
		return $data;
	}

  function getLocation($dbconn, $lid)
	{
		$query = "SELECT * from location WHERE id= " . $lid .";";
		$dbconn->dbconnect();
		$result = $dbconn->qry($query);
		$rownum = mysql_num_rows($result);
		if($rownum >= 1){
	        $data = array();
	        while($row = mysql_fetch_assoc($result))
    	        $data[] = $row;

        }
		return $data;
	}

	/* gets locations */
	function getLocations($dbconn)
	{
		$query = "SELECT * from location ORDER BY sorting;";
		$dbconn->dbconnect();
		$result = $dbconn->qry($query);
		$rownum = mysql_num_rows($result);
		if($rownum >= 1){	/* seminar type */
	        $data = array();
	        while($row = mysql_fetch_assoc($result))
    	        $data[] = $row;

        }
		return $data;
	}

	/* builds a dropdown for the selection of the location */
	function getLocationDropdown($dbconn, $lid = NULL)
	{
		$query = "SELECT * from location ORDER BY sorting;";
		$dbconn->dbconnect();
		$result = $dbconn->qry($query);
		$rownum = mysql_num_rows($result);
		$isFirst = true;
		if($rownum >= 1){	/* seminar type */
	        $data = "<select class='seminardd' name='locationid' onchange='updateLocation()'>";
	        while($row = mysql_fetch_assoc($result)){
				$data = $data . "<option city='" . $row['city'] ."' address='" . $row['address'] ."' value='" . $row['id'] . "'";
				if($lid != NULL){
					if($lid == $row['id'])
						$data = $data . " selected ";
				} else {
					if($isFirst){
						$data = $data . " selected ";
						$isFirst = false;
					}
				}
				$data = $data . ">" . $row['name'] . "</option>";
	        }

	        $data = $data . "<option value='NULL'>_inserisci_a_mano_</option>";
    	    $data = $data . "</select>";
        }

		return $data;
	}

	/* builds a list of options for a dropdown for the selection of the location */
	function getLocationOptions($dbconn, $lid = NULL)
	{
		$query = "SELECT * from location ORDER BY sorting;";
		$dbconn->dbconnect();
		$result = $dbconn->qry($query);
		$rownum = mysql_num_rows($result);
		$isFirst = true;
		if($rownum >= 1){	/* seminar type */
	        $data = "";
	        while($row = mysql_fetch_assoc($result)){
				$data = $data . "<option city='" . $row['city'] ."' address='" . $row['address'] ."' value='" . $row['id'] . "'";
				if($lid != NULL){
					if($lid == $row['id'])
						$data = $data . " selected ";
				} else {
					if($isFirst){
						$data = $data . " selected ";
						$isFirst = false;
					}
				}
				$data = $data . ">" . $row['name'] . "</option>";
	        }

	        $data = $data . "<option value='NULL'>_inserisci_a_mano_</option>";
        }

		return $data;
	}

  	function getStageLocation($dbconn, $sid)
	{
		$query = "SELECT l.* from location l INNER JOIN seminar s  ON l.id = s.locationfk WHERE s.id= " . $sid .";";
		$dbconn->dbconnect();
		$result = $dbconn->qry($query);
		$rownum = mysql_num_rows($result);
		if($rownum >= 1){
	        $data = array();
	        while($row = mysql_fetch_assoc($result))
    	        $data[] = $row;

        }
		return $data;
	}


	/* builds a dropdown for the selection of the organizer */
	function getOrganizerDropdown($dbconn, $oid = NULL)
	{
		$query = "SELECT * from location WHERE organizer = 1 ORDER BY sorting;";
		$dbconn->dbconnect();
		$result = $dbconn->qry($query);
		$rownum = mysql_num_rows($result);
		$isFirst = true;
		if($rownum >= 1){	/* seminar type */
	        $data = "<select class='seminardd' name='organizerid' onchange='updateOrganizer()'>";
	        while($row = mysql_fetch_assoc($result)){
				$data = $data . "<option ";
				if($oid != NULL){
					if($oid == $row['id'])
						$data = $data . " selected ";
				} else {
					if($isFirst){
						$data = $data . " selected ";
						$isFirst = false;
					}
				}

				$data = $data . "optphone='" . $row['phone'] ."' optemail='" . $row['email'] ."' opturl='" . $row['website']  ."' value='" . $row['id'] . "'>" . $row['name'] . "</option>";
	        }
	        $data = $data . "<option value='NULL'>_inserisci_a_mano_</option>";
    	    $data = $data . "</select>";
        }

		return $data;
	}

	/* builds a dropdown for the selection of the organizer */
	function getOrganizerOptions($dbconn, $oid = NULL)
	{
		$query = "SELECT * from location WHERE organizer = 1 ORDER BY sorting;";
		$dbconn->dbconnect();
		$result = $dbconn->qry($query);
		$rownum = mysql_num_rows($result);
		$isFirst = true;
		if($rownum >= 1){	/* seminar type */
	        $data = "";
	        while($row = mysql_fetch_assoc($result)){
				$data = $data . "<option ";
				if($oid != NULL){
					if($oid == $row['id'])
						$data = $data . " selected ";
				} else {
					if($isFirst){
						$data = $data . " selected ";
						$isFirst = false;
					}
				}

				$data = $data . "optphone='" . $row['phone'] ."' optemail='" . $row['email'] ."' opturl='" . $row['website']  ."' value='" . $row['id'] . "'>" . $row['name'] . "</option>";
	        }
	        $data = $data . "<option value='NULL'>_inserisci_a_mano_</option>";
        }

		return $data;
	}
	

	function stagesOfTheMonthYear($dbconn, $month, $year){
		$query = "SELECT * FROM seminar WHERE (MONTH(startdate) = $month AND YEAR(startdate) = $year) OR (MONTH(enddate) = $month AND YEAR(enddate) = $year) AND visible = 1 ORDER BY startdate asc;";
		$dbconn->dbconnect();
        $result = $dbconn->qry($query);
        if($result){
	        $data = array();
	        while($row = mysql_fetch_assoc($result))
    	        $data[] = $row;
        }
		return $data;
	}


	function stagesOfTheAYear($dbconn){
		$query = "SELECT * FROM seminar WHERE startdate > IF(NOW()>MAKEDATE(YEAR(NOW()),213),MAKEDATE(YEAR(NOW()),213),MAKEDATE(YEAR(NOW())-1,213)) AND visible = 1 ORDER BY startdate asc;";
		$dbconn->dbconnect();
        $result = $dbconn->qry($query);
		return $result;
	}

	function makeDate($dbconn){
		$query = "SELECT MAKEDATE(YEAR(NOW()),213) as D1, MAKEDATE(YEAR(NOW())-1,213) as D2;";
		$dbconn->dbconnect();
        $result = $dbconn->qry($query);
        $row = mysql_fetch_array($result);
        $strout = "[" . $row["D1"] . " - " . $row["D2"] . "]";
		return $strout;
	}

  	function lastStage($dbconn)
  	{
		$query = "SELECT * from seminar WHERE startdate >= DATE(NOW()) AND visible = 1 order by startdate desc LIMIT 1;";
		$dbconn->dbconnect();
		$result = $dbconn->qry($query);
		$rownum = mysql_num_rows($result);
        if($rownum > 0){
			$counter = 1;
			while ($row = mysql_fetch_array($result)){
				$mod = fmod($counter,2);
				if ($mod == 1)
					$class = 'todd';
				else
					$class = 'teven';
				if(($row["expires"] != "0000-00-00") && dateExp($row["expires"]))
					$class = $class . ' ' . ' texpired';
				$strout = $strout . "<tr class='" . $class . "'>";
				$strout = $strout . "<td class='tdediting'>" . $dbconn->db_to_date($row["startdate"]) . "</td>";
				$strout = $strout . "<td class='tdediting acenter'>" . $dbconn->db_to_date($row["enddate"]) . "</td>";
				$strout = $strout . "<td class='tdediting acenter'>" . $row["datetext"] . "</td>";
				$strout = $strout . "<td class='tdediting acenter'>" . $row["location"] . "</td>";
				$strout = $strout . "<td class='tdediting acenter'>" . $row["description"] . "</td>";
				$strout = $strout . "<td class='tdediting acenter'>" . $row["organizer"]. "</td>";
				$strout = $strout . "<td class='tdediting acenter'>" . $row["email"]. "</td>";
				$strout = $strout . "</tr>";
				$counter++;
			}
			return $strout;
        }
        return null;

  	}

	function lastUpdate($dbconn)
	{

		$query = "SELECT * from seminar order by modified desc LIMIT 1;";
		$dbconn->dbconnect();
        $result = $dbconn->qry($query);
        $rownum = mysql_num_rows($result);
        $lastup = "--";
        if($rownum > 0){
			$row = mysql_fetch_array($result);
			$lastup = strftime("%A, %d %B %Y", strtotime($row["modified"]));
        }
		return $lastup;

	}



	function monthNextStage($dbconn)
	{
		$date = $this->nextStage($dbconn);
		if($date != null)
			return date('m', $date);
		return date('m', strtotime(Date('Y-m-d')));
	}



  }
