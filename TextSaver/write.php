 <?php
require_once('db_conn.php');

//$_POST["usr"] = "lhh";
//$_POST["pss"] = "123456";

if(!isset($_POST["usr"]) or !isset($_POST["pss"])){
	die("{User Incorrect (code:1001)}");
}

$usrchk = $_POST["usr"];
$psschk = $_POST["pss"];

require_once('userverify.php');

if ($userid =="-1"){
	die("{User Incorrect (code:1002)}");
}
// Create connection
$conn = mysql_connect($dbservername, $dbusername, $dbpassword) or die(mysql_error);
// Check connection
if (!$conn) {
    die("{Connection Failed}");
}

//$_POST["msg"] = "214325";

if (isset($_POST["msg"])) {
	$sql = "INSERT INTO ".$dbmessagetable." (colUserID, colMessage, colDate) VALUES (".$userid.",'".$_POST["msg"]."',now())";
	$result = mysql_db_query ($dbname ,$sql, $conn);
		
	if ($result) {
    	die("{Write Success}");
	}else{
    	die("{Write Error}");
	}
	
	//mysql_free_result($result);
}else{
    die("{No Message}");
}

?>