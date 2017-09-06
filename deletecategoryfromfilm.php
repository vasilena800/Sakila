<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Delete category</title>
</head>

<body>

<?php
	require_once 'dbcon.php';
		$cid = filter_input(INPUT_POST, 'cid', FILTER_VALIDATE_INT) or die('Missing/illegal parameter');
		$fid = filter_input(INPUT_POST, 'fid', FILTER_VALIDATE_INT) or die('Missing/illegal parameter');
	
			$sql = 'DELETE FROM film_category WHERE film_id=? AND category_id=?';
			$stmt = $link->prepare($sql);
			$stmt->bind_param('ii', $fid, $cid);
			$stmt->execute();
if ($stmt->affected_rows >0 ){
	echo 'The film was successfully deletet from the category';
}
else {
	echo 'ERROR';

}
?>
<hr>
<a href="filmdetails.php?fid=<?=$fid?>">Film details</a><br>


</body>
</html>