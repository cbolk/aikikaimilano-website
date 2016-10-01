<?php
	include("../admin/class.db.php");

	$aid = $_GET["aid"];

    $sql = "SELECT YEAR( date ) AS YY, DATE_FORMAT( date, '%%m' ) AS MM, DATE_FORMAT( date, '%%Y-%%m-01' ) AS yearmonth, SUM( hours ) AS MH FROM aikidoka LEFT JOIN attendance ON aikidoka.id = attendance.aikidoka_fk WHERE id=" . $aid . " AND date > '2012-07-01' GROUP BY YEAR( date ), MONTH( date )";

//    $sql = "SELECT YEAR( date ) AS YY, DATE_FORMAT( date, '%%m' ) AS MM, DATE_FORMAT( date, '%%Y-%%m-01' ) AS yearmonth, SUM( hours ) AS MH FROM aikidoka LEFT JOIN attendance ON aikidoka.id = attendance.aikidoka_fk WHERE id=" . $aid . " AND date > aikidoka.last_exam GROUP BY YEAR( date ), MONTH( date )";


	$db = new dbaccess();
	$db->dbconnect();
	$query = $db->qry($sql);
    
    $numrows = mysql_num_rows($query); 
    $data = array();
    for ($x = 0; $x < $numrows; $x++) {
        $data[] = mysql_fetch_assoc($query);
    }

    echo json_encode($data);     
?>