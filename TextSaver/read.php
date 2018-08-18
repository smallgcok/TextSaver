 <?php
require_once('db_conn.php');

//$_POST["usr"] = "LHH";
//$_POST["pss"] = "15684";

if(!isset($_POST["usr"]) or !isset($_POST["pss"])){
	die("{User Incorrect (code:1001)}");
}

$usrchk = $_POST["usr"];
$psschk = $_POST["pss"];

if (isset($_POST["lmt"])){
	$limit=$_POST["lmt"];
}else{
	$limit=0;
}

//echo $usrchk ."\||";
//echo $psschk ."\||";

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

if ($limit ==0){
	$sql = "SELECT colMessage, colDate FROM ".$dbmessagetable." WHERE colUserID='".$userid."' ORDER BY colID DESC";
}else{
	$sql = "SELECT colMessage, colDate FROM ".$dbmessagetable." WHERE colUserID='".$userid."' ORDER BY colID DESC LIMIT ".$limit;
		
}
$result = mysql_db_query ($dbname ,$sql, $conn);

if ($result) {
    // output data of each row
    while($row = mysql_fetch_assoc($result)) {
			echo "[Message=\"" . $row["colMessage"]. "\",Date=\"" . $row["colDate"]. "\"],";
    }
} else {
    echo "{None Result}";
}

mysql_free_result($result);
?> 