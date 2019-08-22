<?php 
session_start();
$_SESSION['index'] = "";
$_SESSION['message5'] = "";
$_SESSION['message6'] = "";
$_SESSION['message7'] = "";
$date1  = "";
require_once "db_connect.php";
db();
global $link;
if($_SESSION['login'] == 0)
{
	$_SESSION['message2'] = "Please Login to access the content";
	header('location: home.php');
}
$query = "SELECT username from users";
$result = mysqli_query($link , $query);
if(isset($_POST['next']))
{
	//$date1 = $_POST['date'];
	//print_r($date);
	$date1 = date('d-m-Y', strtotime($_POST['date']));
	$date1 = (string)$date1;
	$date2 = (string)$date1;
	$len = strlen($date1);
	$subdate3 = substr($date2 , 6 , $len);
	$subdate2 = substr($date2,-7, -5);
	//echo $subdate2;
	//echo $subdate3;
	$name = $_POST['employee'];
	$leave = $_POST['leave'];
	$reason = $_POST['comment'];
	$query1 = "SELECT * from leaves where date like '___$subdate2%' and date like '%$subdate3' and Employee_name = '$name'";
	$result1 = mysqli_query($link , $query1);
	$query2 = "SELECT * from leaves where date = '$date1' and Employee_name = '$name'";
	$result2 = mysqli_query($link , $query2);
	$nums = mysqli_num_rows($result2);
	if($nums == 1)
	{
		$_SESSION['message7'] = "Record with same entry already exists Please Check the records!";
	}
	else{
	$sick = 0;
	$work = 0;
	while($row = mysqli_fetch_array($result1))
	{
		if($row['sick'] == 1)
		{
			$sick = $sick + 1;
		}
		if($row['work_from_home'] == 1)
		{
			$work = $work + 1;
		}
	}
	if($sick == 1 && $leave == 'Sick Leave')
	{
		$_SESSION['message5'] = "This Employee used his Sick Leave for this month , Please Check the records!";
	}
	else if($work == 1 && $leave == 'Work From Home')
	{
		$_SESSION['message6'] = "This Employee used his Work From Home Leave for this month , Please Check the records!";
	}
	else {
	
if($leave == "Vacation Leave")
{
	//$date1 = (string)$date1;
	//print_r($date1);
	$query = "INSERT INTO leaves(Employee_name , date , type , comment , vacation) VALUES ('$name', '$date1','$leave' ,'$reason' , 1)";
    mysqli_query($link, $query);
    $_SESSION['index'] = "Record Added Successfully";
}
else if($leave == "Optional Leave")
{
	$query = "INSERT INTO leaves(Employee_name , date , type, comment , optional) VALUES ('$name' , '$date1' , '$leave' , '$reason' , 1)";
	mysqli_query($link , $query);
	$_SESSION['index'] = "Record Added Successfully";
}
else if($leave == "Sick Leave")
{
	$query = "INSERT INTO leaves(Employee_name , date , type, comment , sick) VALUES ('$name' , '$date1' , '$leave' , '$reason' , 1)";
	mysqli_query($link , $query);
	$_SESSION['index'] = "Record Added Successfully";
}
else if($leave == "Others")
{
	$query = "INSERT INTO leaves(Employee_name , date , type, comment , others) VALUES ('$name' , '$date1' , '$leave' , '$reason' , 1)";
	 mysqli_query($link , $query);
	 $_SESSION['index'] = "Record Added Successfully";
}
else if($leave == "Work From Home")
{
	$query = "INSERT INTO leaves(Employee_name , date , type, comment , work_from_home) VALUES ('$name' , '$date1' , '$leave' , '$reason', 1)";
	mysqli_query($link , $query);
	$_SESSION['index'] = "Record Added Successfully";
}
else if($leave == "Present")
{
	$query = "INSERT INTO leaves(Employee_name , date , type, comment , present) VALUES ('$name' , '$date1' , '$leave' , '$reason' , 1)";
	mysqli_query($link , $query);
	$_SESSION['index'] = "Record Added Successfully";
}
}
}
}
ini_set('display_errors', 'Off');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Leave Page</title>
  <link rel="ICON" href="favicon.ico" type="image/ico" />
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
  <script>
  $(document).ready(function(){
	   $('#leave').change(function(){
	  //alert($("#leave option:selected").val());
	  if($("#leave option:selected").val() != "Present" )
	  {
		  $('#comment').show();
	  }
	  else
	  {
		  $('#comment').hide();
	  }
  });
	  
  });

  </script>
</head>
<body>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <!-- Brand -->
  <a class="navbar-brand" href="leave.php">Home</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

  <!-- Links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="employee.php">Employee Report</a>
    </li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <li class="nav-item">
      <a class="nav-link" href="month.php">Monthly Report</a>
    </li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

    <!-- Dropdown -->
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        Employees
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="add.php">Add an Employee</a>
        <a class="dropdown-item" href="remove.php">Remove an Employee</a>
        <a class="dropdown-item" href="user.php">Check Your Employees</a>
      </div>
    </li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<li class="nav-item" class = "top-nav-right">
      <a class="nav-link" href="home.php">Logout</a>
    </li>
  </ul>
</nav>
<br>
  
<div class="container">
<h2 align = "center">Attendance Form</h2><br><br>
<div class="row">
<div class="col-sm-8 offset-sm-4">
  <form action="leave.php" method = "POST">
    <div class="form-group">
	<div class = "col-6">
	<label for = "alert" class="text-danger"><?php echo $_SESSION['index']; ?></label>
	<label for = "alert" class="text-danger"><?php echo $_SESSION['message5']; $_SESSION['message5'];	?></label>
	<label for = "alert" class="text-danger"><?php echo $_SESSION['message6']; $_SESSION['message6'];   ?></label>
	<label for = "alert" class="text-danger"><?php echo $_SESSION['message7']; $_SESSION['message7'];   ?></label>
	<br>
		<label for = "sell">Select Date :</label>
		<input type="date" class="form-control" id="date" name="date">
    </div>
	<br>
	<div class="col-6">
      <label for="sel1">Select an Employee :</label>
      <select class="form-control" id="employee" name="employee">
	  <option value = 0 >---Select---</option>
        <?php  while($row = mysqli_fetch_array($result)) { ?>
      <option value = "<?php echo $row['username'] ?>" ><?php echo $row['username']?> </option>
      <?php } ?>
      </select>
	</div>
	<br>
	<div class="col-6">
      <label for="sel1">Type :</label>
      <select class="form-control" id="leave" name="leave">
		<option value = 0 >---Select---</option>
        <option value = "Present">Present</option>
        <option value = "Vacation Leave" >Vacation Leave</option>
        <option value = "Optional Leave">Optional Leave</option>
        <option value = "Sick Leave">Sick Leave</option>
		<option value = "Work From Home">Work From Home</option>
		<option value = "Others">Others</option>
      </select>
	</div>
	<br>
	<div class = "col-6" id = "comment" style = "display:none;">
		<label for="comment" >Comment:</label>
      <textarea class="form-control" rows="5" id="comment" name="comment"></textarea>
    </div>
	<br>
    &nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-primary" name = "next" id = "next" >Submit</button>
  </form>
</div>
</div>
</div>
</div>
</body>
</html>