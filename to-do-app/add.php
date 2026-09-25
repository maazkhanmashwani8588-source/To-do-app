<?php
include "config.php";

if (isset($_POST['submit'])) {

// get the form input data 
$new_task_title = trim($_POST['title'] ?? '');

// insert if not empty
if ($new_task_title !== '') {
	// escape the text to make it safe for the sql
	$escaped_title = mysqli_real_escape_string($conn,$new_task_title);


	// insert to the database the new task

	mysqli_query($conn,"INSERT INTO tasks(title)values('$escaped_title')");
}

// redirect to the index page after inserting new task to show

header("location:index.php");

}



?>