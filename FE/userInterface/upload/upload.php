<?php 
	session_start();
	$cnt = $_SESSION['noticnt'];
	$output = $_SESSION['noti'];

	include ("php/connectDB2.php");
	$bID = $_SESSION['bID'];

	include ("notif.php");	
?>

<!DOCTYPE html>
<html>
<title> Upload File into Database | iShop for Business </title>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" crossorigin="anonymous">
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" crossorigin="anonymous"></script>
    	<script type="text/javascript" src="upload.js"></script>
</head>

<body>
	<div class="container">
	<div class="row">
	<div class="col-md-12">
	<h2><img src="../images/upload.png" width="50px"/>Import CSV/Excel file into your Inventory</h2>
	<div id="response" class="<?php if(!empty($type)) { echo $type . " display-block"; } ?>"><?php if(!empty($message)) { echo $message; } ?>
	</div>
	<div class="outer-scontainer">
		<div class="row">
			<form class="form-horizontal" action="import.php" method="post" name="frmCSVImport" id="frmCSVImport" enctype="multipart/form-data">
				<div class="input-row">
					<label class="col-md-4 control-label">Choose CSV File</label> 
						<input type="file" name="file" id="file" accept=".csv"> <br>
						<?php echo"<h3>".$message."</h3>\n";?>
 					<button type="submit" id="submit" name="import" class="btn btn-success">Import</button> <br />
				</div>
			</form>
		</div>
	<?php
		$conn      = mysqli_connect("10.0.2.11","user1","user1pass","ishopdb");
		$sqlSelect = "SELECT * FROM businessinv
			      WHERE businessID = '$bID'";
		$result    = mysqli_query($conn, $sqlSelect);
		
		if (mysqli_num_rows($result) > 0) 
		{
	?>
			<table id='userTable'>
				<thead>
					<tr>
						<th>brand</th>
						<th>product</th>
						<th>qty</th>
						<th>businessID</th>
					</tr>
				</thead>

				<?php
					while ($row = mysqli_fetch_array($result)) 
					{
				?>
				
						<tbody>
							<tr>
								<td><?php echo $row['brand']; ?></td>
								<td><?php echo $row['product']; ?></td>
								<td><?php echo $row['qty']; ?></td>
								<td><?php echo $row['businessID']; ?></td>
							</tr>
					
				<?php
					}
				?>

						</tbody>
			</table>

	<?php 
		} 
	?>
	</div>
	</div>
	</div>
	</div>
</body>
</html>
