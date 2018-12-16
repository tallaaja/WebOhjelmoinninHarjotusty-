<?php
	require "header.php";
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
          <input type="text" name="serial number" placeholder="Serial number">
					<button type="submit" name="addDevice-Submit">Lisää</button>
				</form>
			</section>
		<div>
	</main>

<?php
	require "footer.php";
?>
