<?php
if(!empty($_POST))
{
	//database settings
	include("./class.db.php");
	$db = new dbaccess();
	$db->dbconnect();	
	
	foreach($_POST as $field_name => $val)
	{
		//clean post values
		$field_userid = strip_tags(trim($field_name));
		//$v = strip_tags(trim(mysql_real_escape_string($val)));
		
		//from the fieldname:user_id we need to get user_id
		$split_data = explode(':', $field_userid);
		$field_name = $split_data[0];
		$sid = $split_data[1];
		if(!empty($sid) && !empty($field_name))
		{
			if(!empty($val)){
				//update the values
				if($field_name === "visible"){
					$intval = $db->onoff_to_db($val);
					$sql = "UPDATE seminar SET $field_name = ". $intval . " WHERE id = " . $sid;
				}	
			}
			echo $sql;
			$db->qry($sql);
		} else 
			echo "Errore"; 
	}
} else {
	echo "Errore";
}
?>
