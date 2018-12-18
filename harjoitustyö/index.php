<?php
	require "includes/dbh.inc.php";
	require "header.php";
?>
<style>
table, th, td {
  border: 1px solid black;
}</style>
	<main>
		<div class="wrapper-main">
			<section class="section-default">
			<?php

				if (isset($_SESSION["userId"])) {

					echo '<p> </p>';
					$sql = "SELECT `ID`, `nameDevices`, `modelDevices`, `brandDevices`, `descriptionDevices`,
					 `addressDevices`, `ownerDevices`, `categoryDevices`, `bookerIdDevices` FROM devices";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
						// output data of each row
						echo '<table>';
						echo '<tr>';
						echo '<th>Name</th>';
						echo '<th>Model</th>';
						echo '<th>Brand</th>';
						echo '<th>Description</th>';
						echo '<th>Address</th>';
						echo '<th>Owner</th>';
						echo '<th>Category</th>';
						while($row = $result->fetch_assoc()) {
								echo '<tr>';
								echo '<td>'.$row['nameDevices'].'</td>';
								echo '<td>'.$row['modelDevices'].'</td>';
								echo '<td>'.$row['brandDevices'].'</td>';
								echo '<td>'.$row['descriptionDevices'].'</td>';
								echo '<td>'.$row['addressDevices'].'</td>';
								echo '<td>'.$row['ownerDevices'].'</td>';
								echo '<td>'.$row['categoryDevices'].'</td>';

								if($row['bookerIdDevices'] == NULL){
									echo $row['ID'];
									echo '<td><form action="includes/book.inc.php" method="post">
												<input type="hidden" name="bookId" value='.$row['ID'].'>
												<input type="submit" name="bookthis" value="Book" />
										</form></td>';
								}

								echo '</tr>';
						}
					} else {
						echo "0 results";
						header("Location: ../index.php?error=youhavenoorders");
					}
				}


				else {
					echo '<p> You must sign in to use the page!  </p>';
				}
			?>

			</section>
		<div>
	</main>

<?php
	require "footer.php";
?>
