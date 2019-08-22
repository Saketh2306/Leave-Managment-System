<?php 
session_start();
$_SESSION['message'] = "";
$_SESSION['next'] = "";
$_SESSION['login'] = 0;
$_SESSION['emp_name'] = "";
require_once "db_connect.php";
db();
global $link;
if(isset($_POST['submit']))
{
	$username = $_POST['email'];
	$password = $_POST['pswd'];
	$query = "SELECT * FROM admin where username = '$username' and password = '$password'";
	$query1 = "SELECT * FROM employee where employee_id = '$username' and employee_password = '$password'";
	$result1 = mysqli_query($link , $query1);
	$result = mysqli_query($link , $query);
	$row = mysqli_fetch_array($result);
	$row1 = mysqli_fetch_array($result1);
	if($row['username'] == $username AND $row['password'] == $password)
	{
		$_SESSION['message'] = "Login Successfull";
		$_SESSION['next'] = "leave.php";
		$_SESSION['login'] = 1;
	}
	else if($row1['employee_id'] == $username AND $row1['employee_password'] == $password)
	{
		$_SESSION['message'] = "Login Successfull";
		$_SESSION['next'] = "employeehome.php";
		$_SESSION['login'] = 1;
		$_SESSION['emp_name'] = $row1['Employee_name'];
	}
	else
	{
		$_SESSION['message'] = "Invalid username or password";
		$_SESSION['next'] = "home.php";
	}
	if($_SESSION['next'] == "leave.php")
	{
		header('location: leave.php');
	}
	if($_SESSION['next'] == "employeehome.php")
	{
		header('location: employeehome.php');
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Speech Soft India Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
  <link rel="ICON" href="favicon.ico" type="image/ico" />
  <script>
window.location.hash="no-back-button";
window.location.hash="Again-No-back-button";//again because google chrome don't insert first hash into history
window.onhashchange=function(){window.location.hash="no-back-button";}
</script> 
</head>
<body>
<div class="container">
<br>
<br>
<br>
<div class="row">
<div class="col-sm-8 offset-sm-4">
<div><img src="speechsoft.png" alt="Smiley face" width="300" height="100"></div>
<br>
  <form action="home.php" method = "POST">
    <div class="form-group">
	<div class="col-6">
	  <label for = "alert" class="text-danger"><?php echo $_SESSION['message'] ?></label><br>
	  <?php 
	  if(isset($_SESSION['message2']))
		{ ?>	
	   <label for = "alert" class="text-danger"><?php echo $_SESSION['message2'] ?></label><br>

	  <?php $_SESSION['message2'] = "" ;} ?>	
      <label for="email">Username:</label>
      <input type="text" class="form-control" id="email" placeholder="Enter username" name="email">
	</div>
    </div>
    <div class="form-group">
	<div class="col-6">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pswd">
	</div>
    </div>
    <div class="form-group form-check">
      <label class="form-check-label">
        &nbsp;&nbsp;&nbsp;&nbsp;<input class="form-check-input" type="checkbox" name="remember"> Remember me
      </label>
    </div>
    &nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-primary" name = "submit" id = "submit">Login</button>
  </form>
</div>
</div>
</div>

</body>
</html>