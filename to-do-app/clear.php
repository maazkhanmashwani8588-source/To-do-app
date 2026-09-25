<?php

include 'config.php';

// delete all the tasks from the database and u
mysqli_query($conn,"DELETE FROM tasks");

header("location:index.php");
exit();


?>