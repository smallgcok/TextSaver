 <?php
require_once('db_conn.php');

// Create connection
$conn = mysql_connect($dbservername, $dbusername, $dbpassword) or die(mysql_error);
// Check connection
if (!$conn) {
    die("{Connection Failed}");
}

//$_POST["usr"]="SmallGCOk";
//$_POST["pss"]="123456";

$usrqry = "";
$pssqry = "";


if (!empty($usrchk) and !empty($psschk)) {
	$usrqry = $usrchk;
	$pssqry = $psschk;
}elseif(isset($_POST["usr"]) and isset($_POST["pss"])){
	$usrqry = $_POST["usr"];
	$pssqry = $_POST["pss"];
}else{
	die("{User Incorrect (code:2001)}");
}

//echo $usrqry ."\||";
//echo $pssqry ."\||";


//$sql = "SELECT colID FROM ".$dbusertable;
$sql = "SELECT colID FROM ".$dbusertable." WHERE colUser='".strtolower($usrqry)."' and colPassword='".$pssqry."'";
$result = mysql_db_query ($dbname ,$sql, $conn);
$userid="-1";

//echo $sql ."\||";
//echo $result ."\||";
//echo mysql_num_rows($result) ."\||";

if (mysql_num_rows ($result) >0) {
    // output data of each row
	$data=mysql_fetch_assoc($result);
    $userid= $data["colID"];
	//$userid = mysql_result($result,0);
	echo "{Login Success}";
} else {
	die("{User Incorrect (code:2002)}");
}

mysql_free_result($result);
?>