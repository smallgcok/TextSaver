 <?php

$con=mysqli_connect("192.168.0.100","lhh","lhh","TextSaver");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$sql="INSERT INTO tblmessage (colMessage, colDate) VALUES ('SmallGCOk',now())";

if (!mysqli_query($con,$sql))
  {
  die('Error: ' . mysqli_error($con));
  }
echo "1 record added";

mysqli_close($con);
?>