<?php
include "config.php";

// fetch all the  data from the databse
$fetch_result = mysqli_query($conn,"SELECT id,title,is_done from tasks order by id DESC");

// storing the data in the array to use later
$task_rows = [];
while ($task_row = mysqli_fetch_assoc($fetch_result)) {
	// converting is_done to an integer from string

	$task_row['is_done'] = (int)$task_row['is_done'];
	$task_rows[] = $task_row;
}

// count the totals for the todo counter
$total_task_count = count($task_rows);
$completed_task_count = 0;

foreach ($task_rows as $task) {
	if ($task['is_done'] == 1) {
		$completed_task_count++;
	}
}



?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>To Do App</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
	<main>
		<div class="container">
			<div class="todo-tracker">
				<div class="task-tracker-text">
					<h2>Tasks Completed</h2>
					<p class="completed-subheading">Keep it up</p>
				</div>
				<div class="taks-counter">
					<?php echo $completed_task_count;?><span class="spacer">/</span><?php echo $total_task_count;?>
				</div>
			</div>
			<form class="task-form" action="add.php" method="post">
				<input type="text" class="task-input" name="title" placeholder="Your next task is...">
				<button class="submit-btn" type="submit" name="submit"><i class="fa-solid fa-plus"></i></button>
			</form>
			<ul class="task-list">
				<!-- check if any tasks have been created -->
				<?php if(empty($task_rows)): ?>
					<!-- if no tasks show them a message -->
					<li class="task-item">
						<div class="li-text">Add a task to get started</div>
					</li>
					<?php else: ?>
						<?php foreach($task_rows as $task): ?>
				<li class="task-item">
					<!-- add a done class if check mark has been clicked -->
					<div class="li-text<?php echo $task['is_done'] ? ' done' : '';?>"><?php echo $task['title'];?></div>
					<div class="task-icons">
						<!-- add logic for icons to cross out the tasks completed -->
						<form method="post" action="toggle.php" class="inline-form">
							<input type="hidden" name="id" value="<?php echo $task['id'];?>">
						<button class="icon-btn" type="submit" title="toggle complete">
							<i class="fa-solid fa-circle-check fa-2xl"></i>
						</button>
						</form>
						<form action="delete.php" method="post" class="inline-form">
							<input type="hidden" name="id" value="<?php echo $task['id'];?>">
						<button class="icon-btn">
							<i class="fa-solid fa-trash fa-2xl"></i>
						</button>
						</form>
					</div>
				</li>
			<?php endforeach; ?>
			<?php endif; ?>
			</ul>
			<form id="clear" action="clear.php" method="post" class="inline-form">
			<button class="clear-all" type="submit">Clear All Tasks</button>
			</form>
		</div>
	</main>

	<script type="text/javascript" src="main.js"></script>
</body>
</html>