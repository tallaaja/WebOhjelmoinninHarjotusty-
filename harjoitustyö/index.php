<?php
	require "header.php";
?>

	<main>
		<div class="wrapper-main">
			<section class="section-default">
			<?php

				if (isset($_SESSION["userId"])) {
					echo '<p> </p>'
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
