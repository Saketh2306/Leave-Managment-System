<?php
session_start();
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
	$employee = $_SESSION['emp_name'];
	$year = (string)$_POST['select-year'];
	//echo $year;
	//echo $employee;
	$query1 = "SELECT * FROM leaves where date like '%$year' and Employee_name = '$employee'";
	//echo $query1;
	$query2 = "SELECT * from users where username = '$employee'";
	//echo $query2;
	$result2 = mysqli_query($link , $query2);
	$result1 = mysqli_query($link , $query1);
	$vacation = 0;
	$sick = 0;
	$optional = 0;
	$work = 0;
	$others = 0;
	$vacationmax = 0;
	$total = 0;
	$num = mysqli_num_rows($result2);
	$row1 = mysqli_fetch_array($result2);
	if($row1['experience'] >= 3)
	{
		$vacationmax = 15;
	}
	else{
		$vacationmax = 12;
	}
	while($row = mysqli_fetch_array($result1))
	{
		if($row['vacation'] == 1)
		{
			$vacation = $vacation + 1;
		}
		if($row['sick'] == 1)
		{
			$sick = $sick + 1;
		}
		if($row['optional'] == 1)
		{
			$optional = $optional + 1;
		}
		if($row['work_from_home'] == 1)
		{
			$work = $work + 1;
		}
		if($row['others'] == 1)
		{
			$others = $others + 1;
		}
	}
	$total = $vacation + $sick + $optional + $work + $others;
	$query3 = "SELECT * FROM leaves where date like '%$year' and Employee_name = '$employee' and type != 'Present' " ;
	$result3 = mysqli_query($link , $query3);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Employee Home Page</title>
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
  <a class="navbar-brand" href="employeehome.php">Home</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

  <!-- Links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="employeemonth.php">Monthly Report</a>
    </li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="navbar-brand" href="employeehome.php">Hello    <?php echo $_SESSION['emp_name'] ?>!</a>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	
	<li class="nav-item">
      <a class="nav-link" href="home.php">Logout</a>
    </li>
  </ul>
</nav>
<br>
<div class="container">
<h2 align = "center">Employee Yearly Report</h2><br><br>
<div class="row">
<div class="col-sm-8 offset-sm-4">
  <form action="employeehome.php" method = "POST" id="emp_name">
    <div class="form-group">
	<div class="col-6">
	<label for="sell">Select Year:</label>
	<select class="form-control" name = "select-year" id = "show">
	<option value = 0 >---Select---</option>
	<?php $i = 0;
	while($i <= 100) {
			$year = 2018 + $i;
	?>
	<option value = "<?php echo $year; ?>" ><?php echo $year; ?></option>
	<?php $i++; } ?>
	</select>
	</div>
	<br>
    &nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-primary" name = "next" id="next">Next</button>
  </form>
 
</div>
</div>
<div class="col-sm-12">
 <?php if(isset($num)) {
	  if($num > 0) { ?>
  <div id = "showing">
  <div><img src="speechsoft.png" alt="Smiley face" width="300" height="100"></div>
  <br>
  <h4>Employee Name: <?php echo $employee; ?>    (Year : <?php echo $year-100 ?>)</h4>
  <br>
  <table class="table">
    <thead class="thead-light">
      <tr>
        <th>Leaves</th>
        <th>Number of Leaves</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Leaves Entitled :</td>
        <td><?php echo $vacationmax + 8; ?></td>
      </tr>
      <tr>
        <td>Leaves Outstanding :</td>
        <td><?php echo $total ; ?></td>
      </tr>
      <tr>
        <td>Vacation Leaves</td>
        <td><?php echo $vacation; ?></td>
      </tr>
	  <tr>
		<td>Optional Leaves</td>
		<td><?php echo $optional; ?></td>
	  </tr>
	  <tr>
		<td>Sick Leaves</td>
		<td><?php echo $sick ?></td>
	  </tr>
	  <tr>
		<td>Work From Home</td>
		<td><?php echo $work ?></td>
	  </tr>
	  <tr>
		<td>Others</td>
		<td><?php echo $others ?></td>
	  </tr>
    </tbody>
  </table>
  <br>
  </div>
  <?php } } ?>
</div>
<br>
<div class="col-sm-12">
 <?php if(isset($num)) {
	  if($num > 0) { ?>
  <div id = "showing">
  <div><img src="speechsoft.png" alt="Smiley face" width="300" height="100"></div>
  <br>
  <h4>Employee Name : <?php echo $employee; ?>  (Year : <?php echo $year-100 ?>)</h4>
  <br>
  <table class="table">
    <thead class="thead-light">
      <tr>
        <th>Date</th>
        <th>Type of Leave</th>
      </tr>
    </thead>
    <tbody>
    	<?php while($row3 = mysqli_fetch_array($result3)) {
    	$date = $row3['date'];
    	$type = $row3['type']; 
    		?>
      <tr>
        <td><?php echo $date ?></td>
        <td><?php echo $type ?></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
  </div>
  <?php } } ?>
</div>
</div>
</div>
</body>
</html>
