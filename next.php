<?php 
$date1 = "";
require_once "db_connect.php";
db();
global $link;
if(isset($_POST['submit']))
{
	$date = $_POST['date'];
	$name = $_POST['émployee'];
	$leave = $_POST['leave'];
	$reason = $_POST['comment'];
	
$date1[6] = $date[0];
$date1[7] = $date[1];
$date1[8] = $date[2];
$date1[9] = $date[3];
$date1[5] = $date[4];
$date1[3] = $date[5];
$date1[4] = $date[6];
$date1[2] = $date[7];
$date1[0] = $date[8];
$date1[1] = $date[9];
$i = 0;
for($i = 0 ; $i < 9 ; $i++)
{
	if($date1[$i] == '-')
	{
		$date1[$i] = '/';
	}
}
if($leave == "Vacation Leave")
{
	 $query = "INSERT INTO leaves(Employee_name , date , type , comment , vacation) VALUES ('$name', '$date1','$leave' ,'$reason' , 1)";
     mysqli_query($link, $query);
     $_SESSION['index'] = "Record Added Successfully";
}
if($leave == "Optional Leave")
{
	$query = "INSERT INTO leaves(Employee_name , date , type, comment , optional) VALUES ('$name' , '$date1' , '$leave' , '$reason' , 1)";
	mysqli_query($link , $query);
	$_SESSION['index'] = "Record Added Successfully";
}
if($leave == "Sick Leave")
{
	$query = "INSERT INTO leaves(Employee_name , date , type, comment , sick) VALUES ('$name' , '$date1' , '$leave' , '$reason' , 1)";
	mysqli_query($link , $query);
	$_SESSION['index'] = "Record Added Successfully";
}
if($leave == "Others")
{
	$query = "INSERT INTO leaves(Employee_name , date , type, comment , others) VALUES ('$name' , '$date1' , '$leave' , '$reason' , 1)";
	 mysqli_query($link , $query);
	 $_SESSION['index'] = "Record Added Successfully";
}
if($leave == "Work From Home")
{
	$query = "INSERT INTO leaves(Employee_name , date , type, comment , work_from_home) VALUES ('$name' , '$date1' , '$leave' , '$reason', 1)";
	mysqli_query($link , $query);
	$_SESSION['index'] = "Record Added Successfully";
}
if($leave == "Present")
{
	$query = "INSERT INTO leaves(Employee_name , date , type, reason , present) VALUES ('$name' , '$date1' , '$leave' , '$reason' , 1)";
	mysqli_query($link , $query);
	$_SESSION['index'] = "Record Added Successfully";
}
header('location :leave.php');
}
else
{
	echo "Botcoll";
}
?>