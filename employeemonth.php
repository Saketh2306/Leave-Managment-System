
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
if(isset($_POST['next']))
{
	$year = (string)$_POST['select-year'];
	$month = $_POST['select-month'];
	if($month == 'January')
	{
		$m = '01';
	}
	if($month == 'February')
	{
		$m = '02';
	}
	if($month == 'March')
	{
		$m = '03';
	}
	if($month == 'April')
	{
		$m = '04';
	}
	if($month == 'May')
	{
		$m = '05';
	}
	if($month == 'June')
	{
		$m = '06';
	}
	if($month == 'July')
	{
		$m = '07';
	}
	if($month == 'August')
	{
		$m = '08';
	}
	if($month == 'September')
	{
		$m = '09';
	}
	if($month == 'October')
	{
		$m = '10';
	}
	if($month == 'November')
	{
		$m = '11';
	}
	if($month == 'December')
	{
		$m = '12';
	}
	$name = $_SESSION['emp_name'];
	$query1 = "SELECT username from users where username = '$name'";
	$result1 = mysqli_query($link , $query1);
	//$query = "SELECT * FROM leaves where date like '$year%' and date like '___$m'"
	$num = mysqli_num_rows($result1);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Employee Month Page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
  <link rel="ICON" href="favicon.ico" type="image/ico" />
    <script>
   $(document).ready(function(){
	   $('#show').change(function(){
	  //alert($("#leave option:selected").val());
	  if($("#show option:selected").val() == 0 )
	  {
		  $('#shower').hide();
		  //$('#shower').hide();
	  }
	  else
	  {
		  //$('#show').show();
		  $('#shower').show();
	  }
  });
	  
  });

  </script>
</head>
<body>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <!-- Brand -->
  <a class="navbar-brand" href="employeehome.php">Home</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

  <!-- Links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="employeemonth.php">Monthly Report</a>
    </li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	
	<li class="nav-item">
      <a class="nav-link" href="home.php">Logout</a>
    </li>
  </ul>
</nav>
<div class="container">
<br>
<br>
<h2 align = "center">Monthly Report</h2><br><br>
<div class="row">
<div class="col-sm-8 offset-sm-4">
  <form action="employeemonth.php" method = "POST" id="emp_name">
    <div class="form-group">
	<div class="col-6" id = "show" >
	<label for="sell">Select Year :</label>
	<select class="form-control" name = "select-year">
	<option value = 0 >---Select---</option>
	<?php $i = 0;
	while($i <= 100) {
			$year = 2018 + $i;
	?>
	<option value = "<?php echo $year; ?>" ><?php echo $year; ?></option>
	<?php $i++; } ?>
	</select>
	<br>
	<div  id = "shower" style = "display:none;">
	<label for="sell">Select Month :</label>
	<select class="form-control" name = "select-month">
	<option value = 0 >---Select---</option>
	<option value = "January">January</option>
  		<option value = "February">February</option>
  		<option value = "March">March</option>
  		<option value = "April">April</option>
  		<option value = "May">May</option>
  		<option value = "June">June</option>
  		<option value = "July">July</option>
  		<option value = "August">August</option>
  		<option value = "September">September</option>
  		<option value = "October">October</option>
  		<option value = "November">November</option>
  		<option value = "December">December</option>
	</select>
	</div>
	<br>
    <button type="submit" class="btn btn-primary" name = "next" id="next">Next</button>
  </form> 
  </div>
  </div>
  </div>
  <div class="col-sm-12">
 <?php if(isset($num)) {
	  if($num > 0) { ?>
  <div id = "showing" >
  <br>
  <div><img src="speechsoft.png" alt="Smiley face" width="300" height="100"></div><br>
  <h4><?php echo $month; ?> <?php echo $year-100; ?> Report </h4>
  <br>
  <table class="table">
    <thead class="thead-light">
      <tr>
        <th>Date</th>
		<th>Type</th>
		<th>Reason</th>
      </tr>
    </thead>
    <tbody>
	<?php $row = mysqli_fetch_array($result1);
		$name = $row['username'];
		$year = $year-100;
		$query2 = "SELECT * from leaves where date like '%$year' and date like '___$m%' and Employee_name = '$name'";
		$result2 = mysqli_query($link , $query2);
		while($row2 = mysqli_fetch_array($result2)) { 
		
  ?>
  <tr>
    <td><?php echo $row2['date'] ?></td>
    <td><?php echo $row2['type'];?></td>
    <td><?php echo $row2['comment']; ?></td>
  </tr>
  <?php } ?>
    </tbody>
  </table>
  </div>
   <?php } } ?>
</div>
</div>

</body>
</html>