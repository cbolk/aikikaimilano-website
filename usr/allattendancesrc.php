
<?php
	include("../admin/class.db.php");

	$ay = $_GET["ay"];

    $sql = "SELECT aikidoka.lastname, aikidoka.firstname, aikidoka_fk, year(date) as YY, DATE_FORMAT( date, '%%m' ) as MM, DATE_FORMAT( date, '%%Y-%%m-01' ) AS YM, sum(hours) as MH from attendance a inner join aikidoka on a.aikidoka_fk = aikidoka.id where active = 1 and date > '" . $ay . "-09-01' GROUP BY aikidoka.lastname, aikidoka.firstname, aikidoka_fk, year(date), month(date) order by aikidoka.lastname, aikidoka.firstname, year(date), month(date);";
    //echo $sql;

//    $sql = "SELECT YEAR( date ) AS YY, DATE_FORMAT( date, '%%m' ) AS MM, DATE_FORMAT( date, '%%Y-%%m-01' ) AS yearmonth, SUM( hours ) AS MH FROM aikidoka LEFT JOIN attendance ON aikidoka.id = attendance.aikidoka_fk WHERE id=" . $aid . " AND date > aikidoka.last_exam GROUP BY YEAR( date ), MONTH( date )";lastname like 'bolc%%' and 


	$db = new dbaccess();
	$db->dbconnect();
	$query = $db->qry($sql);
    
    $numrows = mysql_num_rows($query); 
    $data = array();
/*
    $row = mysql_fetch_assoc($query);
    for ($x = 1, $j = 0; $x < $numrows;) {
    	$data[$j]['fullname'] = $row['lastname'] . " " . $row['firstname'];
    	$data[$j]['aid'] =  $row['aikidoka_fk']; 
    	$nh = 0;   	
	    $dataaik = array();
    	while($x < $numrows && $row['aikidoka_fk'] == $data[$j]['aid']){
    		array_push($dataaik, array($row['YM'],$row['MH']));
    		$nh = $nh + $row['MH'];
	        $row = mysql_fetch_assoc($query);
	        $x++;
    	}
    	$data[$j]['attendance'] =  $dataaik;
    	$data[$j]['total'] = $nh;
    	$j++;
    }
*/
	for ($x = 0; $x < $numrows; $x++)
	  	array_push($data,mysql_fetch_assoc($query));

    echo json_encode($data);     
?>
