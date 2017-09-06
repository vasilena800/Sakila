<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Filmlist</title>
</head>

<body>

<?php
	$cid = filter_input(INPUT_GET, 'categoryid', FILTER_VALIDATE_INT)
		or die('Missing/illegal categoryid parameter');
?>

	<h1>Films in category <?=$cid?></h1>
	
	<ul>
	
<?php
	require_once 'dbcon.php';
		
$sql = 'SELECT f.film_id, f.title, f.release_year

FROM film f, film_category fc
WHERE fc.category_id=?
AND f.film_id=fc.film_id';
		
		$stmt = $link->prepare($sql);
		$stmt->bind_param('i', $cid);
		$stmt->execute();
		$stmt->bind_result($fid, $ftitle, $fyear);
		
			while($stmt->fetch()) {
				
				echo '<li><a href="filmdetails.php?fid='.$fid.'">'.$ftitle.' ('.$fyear.')</a></li>'.PHP_EOL;
				
}
?>

	</ul>

</body>
</html>