<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
</head>

<body>

<?php

$fid = filter_input(INPUT_GET, 'fid', FILTER_VALIDATE_INT) 
	or die('Missing/illegal parameter');
require_once 'dbcon.php';
$sql = 'SELECT f.title, f.description, f.release_year, f.length, l.name as lang
FROM film f, language l
WHERE f.film_id=?
AND f.language_id = l.language_id';
$stmt = $link->prepare($sql);
$stmt->bind_param('i', $fid);
$stmt->execute();
$stmt->bind_result($ftitle, $fdesc, $fyear, $flength, $flang);
while($stmt->fetch()) { }
echo '<h1>'.$ftitle.' ('.$flang.')</h1>';
echo '<p>Release year: '.$fyear.'<br />Length: '.$flength.' minutes </p>';
echo '<p>'.$fdesc.'</p>';
?>

<h2>Categories</h2>
<ul>
<?php
$sql = 'SELECT c.category_id, c.name
FROM film_category fc, category c
WHERE film_id=?
AND fc.category_id = c.category_id';
$stmt = $link->
	prepare($sql);
$stmt->bind_param('i', $fid);
$stmt->
	execute();
$stmt->bind_result($cid, $cnam);
//deletecategoryfromfilm.php
while($stmt->fetch()) {
	echo '<li><a href="filmlist.php?cid='.$cid.'">'.$cnam.'</a>';
	?>
<form action="deletecategoryfromfilm.php" method="post">
<input type="hidden" name="fid" value="<?=$fid?>">
<input type="hidden" name="cid" value="<?=$cid?>">
<input type="submit" value="Delete">
</form>	
	<?php
	echo '</li>';
}
?>
</ul>



<form action="addcategorytofilm.php" method="post">
	<input type="hidden" name="fid" value="<?=$fid?>">
    <select name="cid">
<?php
$sql = 'SELECT name, category_id FROM category';
$stmt = $link->prepare($sql);
$stmt->execute();
$stmt->bind_result($cnam, $cid);
while ($stmt->fetch()){
	echo '<option value="'.$cid.'">'.$cnam.'</option>'.PHP_EOL;
}
?>
    </select>
    <input type="submit" value="Add to category">
</form>

<h2>Actors</h2>
<ul>
<?php
$sql = 'SELECT a.first_name, a.last_name, a.actor_id
FROM film_actor fa, actor a
WHERE film_id=?
AND fa.actor_id = a.actor_id';
$stmt = $link->prepare($sql);
$stmt->bind_param('i', $fid);
$stmt->execute();
$stmt->bind_result($afirstname, $alastname, $aid);
while($stmt->fetch()) {
	echo '<li><a href="actordetails.php?aid='.$aid.'">'.$afirstname.' '.$alastname.'</a></li>';
}
?>
</ul>



</body>
</html>