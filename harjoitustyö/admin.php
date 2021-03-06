
	<?php
	require "header.php";
	require 'includes/dbh.inc.php';
	?>

		<main>
			<div class="wrapper-main">
				<section class="section-default">
					<h1>Add device</h1>
					<form action="includes/addDevice.inc.php" method="post">
						<input type="text" name="name" placeholder="Name">
						<input type="text" name="model" placeholder="Model">
						<input type="text" name="brand" placeholder="Brand">
						<input type="text" name="description" placeholder="Description">
	          <input type="text" name="address" placeholder="Address">
	          <input type="text" name="owner" placeholder="Owner">
	          <input type="text" name="category" placeholder="Category">
						<button type="submit" name="addDevice-Submit">Add</button>
					</form>
	<?php
	require 'includes/dbh.inc.php';
	if (isset($SESSION_['userId'])) {
		$userId = $_SESSION['userId'];
	}
	else {
		$userId = "null";
	}
	$sql = "SELECT `ID`, `nameDevices`, `modelDevices`, `brandDevices`, `descriptionDevices`,
	 `addressDevices`, `ownerDevices`, `categoryDevices`, `bookerIdDevices`, `STATUS` FROM devices";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
			echo '<h2> Edit or delete devices </h2>';
			echo '<table>';
			echo '<tr>';
			echo '<th>Name</th>';
			echo '<th>Model</th>';
			echo '<th>Brand</th>';
			echo '<th>Description</th>';
			echo '<th>Address</th>';
			echo '<th>Owner</th>';
			echo '<th>Category</th>';
			echo '<th>Status</th>';
			echo '<th>History</th>';
			while($row = $result->fetch_assoc()) {
				echo '<tr>';
				echo '<td>'.$row['nameDevices'].'</td>';
				echo '<td>'.$row['modelDevices'].'</td>';
				echo '<td>'.$row['brandDevices'].'</td>';
				echo '<td>'.$row['descriptionDevices'].'</td>';
				echo '<td>'.$row['addressDevices'].'</td>';
				echo '<td>'.$row['ownerDevices'].'</td>';
				echo '<td>'.$row['categoryDevices'].'</td>';
				echo '<td>'.$row['STATUS'].'</td>';
				echo '<td><form action="history.php" method="post">
				<input type="hidden" name="ID" value='.$row['ID'].'>
				<input type="submit" name="history-submit" value="View History" />
				</form></td>';
				if($row['STATUS'] == "BORROWED" ){
					echo '<td><form action="includes/deleteBorrow.inc.php" method="post">
					<input type="hidden" name="deleteId" value='.$row['ID'].'>
					<input type="submit" name="deleteborrow-submit" value="Delete borrowning" />
					</form></td>';
					echo '<td><form action="includes/returnDevice.inc.php" method="post">
						<input type="hidden" name="returnId" value='.$row['ID'].'>
						<input type="submit" name="return-submit" value="Return device" />
					</form></td>';
				}

				if($row['STATUS'] == "BOOKED" ){
					echo '<td><form action="includes/deleteBOOK.inc.php" method="post">
					<input type="hidden" name="deleteId" value='.$row['ID'].'>
					<input type="submit" name="deletebook-submit" value="Remove booking" />
					</form></td>';
					echo '<td><form action="includes/borrowDevice.inc.php" method="post">
					<input type="hidden" name="borrowId" value='.$row['ID'].'>
					<input type="submit" name="borrow-submit" value="Borrow this" />
					</form></td>';
				}

				if($row['bookerIdDevices'] == NULL){
					echo '<td><form action="includes/deleteDevices.inc.php" method="post">
								<input type="hidden" name="deleteId" value='.$row['ID'].'>
								<input type="submit" name="delete-submit" value="Delete device" />
						</form></td>';
				}
				echo '<td><form action="editDevices.php" method="post">
							<input type="hidden" name="editId" value='.$row['ID'].'>
							<input type="submit" name="edit-submit" value="Edit device" />
					</form></td>';
				}
				echo '</tr>';
			}


	?>
</section>
<div>
</main>
	</form>
