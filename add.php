<?php
session_start();
require "db_connect.php";
db();
global $link;
if($_SESSION['login'] == 0)
{
	$_SESSION['message2'] = "Please Login to access the content";
	header('location: home.php');
}
$_SESSION['message3'] = "";
$_SESSION['message4'] = "";
if(isset($_POST['submit']))
{
	$name = $_POST['name'];
	$experience = $_POST['experience'];
	$query1 = "SELECT * from users";
	$result1 = mysqli_query($link , $query1);
	$i = 0;
	while($row = mysqli_fetch_array($result1))
	{
		if($row['username'] == $name)
		{
			$i = 1;
			break;
		}
	}
	if($i == 0)
	{
		$query = "INSERT INTO users (username , experience) VALUES ('$name' , '$experience')";
		$result = mysqli_query($link , $query);
		if($result)
		{
			$_SESSION['message3'] = "Employee Added Successfully";
		}
		else{
			$_SESSION['message3'] = "Employee Not Added Successfully";
		}
	}
	else{
		$_SESSION['message4'] = "Employee already exists";
	}
}
?>
<html lang="en">
<head>
  <title>Add Page</title>
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
<div class="container">
<br>
<br>
<br>
<h2 align = "center"> Add an Employee </h2><br>
<div class="row">
<div class="col-sm-8 offset-sm-4">
  <form action="add.php" method = "POST">
    <div class="form-group">
	<div class="col-6">	
	<label for = "alert" class="text-danger"><?php echo $_SESSION['message3'] ?></label><br>
	<label for = "alert" class="text-danger"><?php echo $_SESSION['message4'] ?></label><br>
      <label for="email">Employee Name : </label>
      <input type="text" class="form-control" id="name" placeholder="Employee Name" name="name" required>
	</div>
    </div>
    <div class="form-group">
	<div class="col-6">	
      <label for="email">Experience : </label>
      <input type="text" class="form-control" id="experience" placeholder="Experience" name="experience" required>
	</div>
    </div>
	<br>
    &nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-primary" name = "submit" id = "submit">Add</button>
  </form>
</div>
</div>
</div>
</body>
</html>