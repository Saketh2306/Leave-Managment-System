<?php
session_start();
$_SESSION['index'] = "";
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
	$name = $_POST['employee'];
	$query1 = "DELETE FROM users where username = '$name'";
	$result1 = mysqli_query($link , $query1);
	if($result1)
	{
		$_SESSION['index'] = "Employee Removed Successfully"; 
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Remove Page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
  <link rel="ICON" href="favicon.ico" type="image/ico" />
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
	<li class="nav-item">
      <a class="nav-link" href="home.php">Logout</a>
    </li>
  </ul>
</nav>
<br>
<div class="container">
<h2 align = "center">Remove an Employee</h2><br><br>
<div class="row">
<div class="col-sm-8 offset-sm-4">
  <form action="remove.php" method = "POST">
    <div class="form-group">
	<div class="col-6">
	<label for = "alert" class="text-danger"><?php echo $_SESSION['index'] ?></label><br>
      <label for="sel1">Select an Employee :</label>
      <select class="form-control" id="employee" name="employee">
	  <option value = 0 >---Select---</option>
        <?php  while($row = mysqli_fetch_array($result)) { ?>
      <option value = "<?php echo $row['username'] ?>" ><?php echo $row['username']?> </option>
      <?php } ?>
      </select>
	</div>
	<br>
	<br>
    &nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-primary" name = "next" id = "next" >Remove</button>
  </form>
</div>
</div>
</div>
</div>
</body>
</html>
