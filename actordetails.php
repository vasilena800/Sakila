<!doctype html>

<html>

<head>



<title>Actor details</title>

</head>



<body>



<?php

	$aid = filter_input(INPUT_GET, 'aid', FILTER_VALIDATE_INT) or die('Missing/illegal parameter');

	

	require_once 'dbcon.php';

	

	$sql = 'SELECT actor.actor_id, actor.first_name, actor.last_name

			FROM actor

			WHERE actor_id = ?';

	

	$stmt = $link->prepare($sql);

	$stmt->bind_param('i', $aid);

	$stmt->execute();

	$stmt->bind_result($aid, $firstname, $lastname);

	while($stmt->fetch()) {

		

		echo '<h2> '.$firstname.' '.$lastname.' </h2>';

	}

?>






</body>

</html>