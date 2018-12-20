<main>
  <div class="wrapper-main">
    <section class="section-default">
<?php
if (isset($_POST['history-submit']))
{
  require 'includes/dbh.inc.php';
  require 'header.php';
  $id = $_POST['ID'];
  $sql = "SELECT * FROM history WHERE deviceId = '$id'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
  echo '<h2> History</h2>';
  echo '<table>';
  echo '<tr>';
  echo '<th>Time</th>';
  echo '<th>Event</th>';
  while ($row = $result->fetch_assoc()) {
    echo '<tr>';
    echo '<td>'.$row['timestampBorrowHistory'].'</td>';
    echo '<td>'.$row['Event'].'</td>';
    echo '<tr>';

  }
  echo '</table>';
  }
  else {
    echo 'No history available';
  }
}

else {
  header("Location: index.php");
  exit();
}
 ?>
</section>
<div>
</main>
