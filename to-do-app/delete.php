<?php
include 'config.php';

// get the id from the form button

$task_id = (int)($_POST['id'] ?? 0);

// if valid id delete the task

if ($task_id > 0 ) {
	
	mysqli_query($conn,"DELETE FROM tasks where id=$task_id");
}


header("location:index.php");
exit();

?>