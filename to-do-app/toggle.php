<?php
include 'config.php';

// get the id from the form button

$task_id = (int)($_POST['id'] ?? 0);

// if valid id flip the id_done value from 0-1 or 1-0

if ($task_id > 0 ) {
	mysqli_query($conn,"UPDATE tasks SET is_done = IF(is_done=1, 0, 1) where id = $task_id");
}

header("location:index.php");
exit();

?>