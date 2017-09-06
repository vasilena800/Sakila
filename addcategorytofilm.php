<!doctype html>
<html>
<head>

<title>Add film category</title>
</head>

<body>
<?php
$cid = filter_input(INPUT_POST, 'cid', FILTER_VALIDATE_INT) or die('Missing/illegal parameter');
$fid = filter_input(INPUT_POST, 'fid', FILTER_VALIDATE_INT) or die('Missing/illegal parameter');
require_once 'dbcon.php';
$sql = 'INSERT INTO film_category (film_id, category_id) VALUES (?, ?)';
$stmt = $link->prepare($sql);
$stmt->bind_param('ii', $fid, $cid);
$stmt->execute();
if ($stmt->affected_rows >0 ){
	echo 'Film added to the category';
}
else {
	echo 'No change - film allready added to category';
//	echo $stmt->error;
}
?>
<hr>
<a href="filmdetails.php?fid=<?=$fid?>">Film details</a><br>
<a href="filmlist.php?cid=<?=$cid?>">Films in same category</a><br>

</body>
</html>