<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name='viewport' content='width=device-width, initial-scale=1'>
<title>文字備忘錄</title>
<style>
body {
	overflow-x: hidden;
}
.mytext {
	border: 0;
	padding: 10px;
	background: whitesmoke;
}
.text {
	width: 100%;
	display: flex;
	flex-direction: column;
}
.text > p:first-of-type {
	width: 100%;
	margin-bottom: auto;
	line-height: 13px;
	font-size: 12px;
}
.text > p:last-of-type {
	width: 100%;
	text-align: center;
	color: Gray;
	padding-left: 65px;
	text-align: left;
	margin-bottom: -20px;
	margin-top: 0px;
}
.text-l {
	float: left;
	padding-right: 10px;
}
.text-r {
	float: right;
	padding-left: 10px;
}
.avatar {
	display: flex;
	justify-content: center;
	align-items: center;
	width: 50px;
	float: left;
	padding-right: 10px;
}
.macro {
	margin-top: 20px;
	width: fit-content;
	border-radius: 15px;
	display: flex;
	max-width: 90%;
}
.msj-rta {
	float: right;
	background: whitesmoke;
}
.msj {
	float: left;
	background: white;
}
.frame {
	background: #99ccff;
	height: 450px;
	overflow: hidden;
	padding: 0;
}
.frame > div:last-of-type {
	position: absolute;
	bottom: 0;
	width: 100%;
	display: flex;
}
body > div > div > div:nth-child(2) > span {
	bgcolor: #99ccff;
	padding: 10px;
	font-size: 21px;
	border-radius: 50%;
}
body > div > div > div.msj-rta.macro {
	margin: auto;
	margin-left: 1%;
}
ul {
	width: 100%;
	list-style-type: none;
	padding: 18px;
	position: absolute;
	bottom: 47px;
	display: flex;
	flex-direction: column;
	top: 0;
	overflow-y: scroll;
}
.msj:before {
	width: 0;
	height: 0;
	content: "";
	left: -12px;
	position: relative;
	border-style: solid;
	border-width: 0 25px 25px 0;
	border-color: transparent #ffffff transparent transparent;
}
.msj-rta:after {
	width: 0;
	height: 0;
	content: "";
	top: -5px;
	left: 14px;
	position: relative;
	border-style: solid;
	border-width: 13px 13px 0 0;
	border-color: whitesmoke transparent transparent transparent;
}
#inputMessage {
	border-radius: 25px;
	border: 2px solid #9cf;
	padding: 5px 5px 5px 15px;
	font-size: 18px;
	height: 30px;
	width: 88%;
	position: fixed;
	bottom: 0.5%;
	left: 0.5%;
}
#sendMessage {
	margin-bottom: -15px;
	height: 50px;
	width: 50px;
	position: fixed;
	right: 1%;
	bottom: 2.5%;
}
#frmLogin {
	position: fixed;
	top: 0%;
	left: 0%;
	background-color: #000;
	width: 100%;
	border-color: #000;
}
#inpUser {
	border-radius: 25px;
	border: 2px solid;
	padding: 5px 5px 5px 15px;
	font-size: 18px;
	height: 25px;
	width: 44%;
	left: 0.5%;
	top: 0.5%;
}
#inpPassword {
	border-radius: 25px;
	border: 2px solid;
	padding: 5px 5px 5px 15px;
	font-size: 18px;
	height: 25px;
	width: 44%;
	position: fixed;
	left: 47%;
}
#sendLogin {
	margin-bottom: -13px;
	height: 35px;
	width: 35px;
	position: fixed;
	right: 1%;
}
input:focus {
	outline: none;
}
::-webkit-input-placeholder { /* Chrome/Opera/Safari */
 color: #d4d4d4;
}
::-moz-placeholder { /* Firefox 19+ */
 color: #d4d4d4;
}
:-ms-input-placeholder { /* IE 10+ */
 color: #d4d4d4;
}
:-moz-placeholder { /* Firefox 18- */
 color: #d4d4d4;
}
</style>
<script type="text/javascript">
function focusFieldOne() {
	<?php
	if (isset($_POST['inpUser'])){
		echo "document.forms[ 'frmLogin' ].elements[ 'inputMessage' ].focus();";
	}else{
		echo "document.forms[ 'frmLogin' ].elements[ 'inpUser' ].focus();";
	}
	?>

}
</script>
</head>
<body  bgcolor="#99ccff" onLoad="focusFieldOne();">
<br />
<br />
<?php
   
ob_start();
require_once('db_conn.php');

if(isset($_POST["inpUser"]) or isset($_POST["inpPassword"])){
	
$usrchk = $_POST["inpUser"];
$psschk = $_POST["inpPassword"];

//echo $usrchk ."\||";
//echo $psschk ."\||";

require_once('userverify.php');

if ($userid =="-1"){
	die("{User Incorrect (code:3002)}");
}

ob_end_clean();
// Create connection
$conn = mysql_connect($dbservername, $dbusername, $dbpassword) or die(mysql_error);
// Check connection
if (!$conn) {
    die("{Connection Failed}");
}


if (isset($_POST['inputMessage']) and !empty($_POST['inputMessage'])){
	$sql = "INSERT INTO ".$dbmessagetable." (colUserID, colMessage, colDate) VALUES (".$userid.",'".$_POST["inputMessage"]."',now())";
	$result = mysql_db_query ($dbname ,$sql, $conn);
}

	$sql = "SELECT colMessage, colDate FROM ".$dbmessagetable." WHERE colUserID='".$userid."' ORDER BY colID ASC";
	
$result = mysql_db_query ($dbname ,$sql, $conn);

if ($result) {
    // output data of each row
    while($row = mysql_fetch_assoc($result)) {
			echo "<li style='width:100%'>
    <div class='avatar'><img src='../img/Logo.png' width='50px'  /></div>
  <div class='msj macro'>
    <div class='text-l'>
      <p>";
$reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

// The Text you want to filter for urls
$text =  $row["colMessage"];

// Check if there is a url in the text
if(preg_match($reg_exUrl, $text, $url)) {
       // make the urls hyper links
       echo preg_replace($reg_exUrl, "<a target='_blank' rel='noopener noreferrer' href='".$url[0]."'>".$url[0]."</a> ", $text);
} else {
       // if no urls in the text just return the text
       echo $text;
}
	  echo "</p>
    </div>
  </div>
  <div class='text'>
      <p><small>".  $row["colDate"]. "</small></p>
      </div>
</li><br />";
    }
} else {
    echo "{None Result}";
}

mysql_free_result($result);
}

?>
<form id="frmLogin" action="chat.php" method="post">
  <input id="inpUser" name="inpUser" placeholder="帳號" type="text" value=
  "<?php
  if (isset($_POST['inpUser'])){ 
	  echo $_POST['inpUser']; 
  }else{
	  echo ''; 
  }
  ?>"
        />
  <input id="inpPassword" name="inpPassword" placeholder="密碼" type="password" value=
  "<?php 
  if (isset($_POST['inpPassword'])){ 
      echo $_POST['inpPassword']; 
  }else{ 
      echo ''; 
  }
  ?>"/>
  <input id="sendLogin" type="image" id="image" alt="submit" src="../img/ic_send.png">
  <input id="inputMessage" name="inputMessage" placeholder="輸入訊息…" value="" type="text" />
  <input id="sendMessage" type="image" id="image" alt="submit" src="../img/ic_send.png">
</form>
<div id="copyright" style="color:gray; text-align:right;"> <small>Copyright By SmallGCOk</small> </div>
<br />
<br />
<script>
window.location.hash = "copyright";
</script>
</body>
</html>
