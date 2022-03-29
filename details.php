<?php
if(!isset($_GET["dvd_title_id"]) || empty($_GET["dvd_title_id"]) ){
	$error = "Invalid Track Id";
}
else{
	$host = '303.itpwebdev.com';
	$user = 'johnwatt_db_user';
	$password = '3VPHiBesSSwXQ4e';
	$db = 'johnwatt_dvd_db';
}

$mysqli  = new mysqli($host, $user, $password, $db);  // create instance of mysqli class

if ($mysqli->connect_errno) {
	// display error message if error
	echo $mysqli->connect_error;
	exit();
}
$mysqli -> set_charset("utf-8");

$sql = "SELECT dvd_titles.title AS title, dvd_titles.release_date AS release_date, genres.genre AS genre, labels.label AS label, ratings.rating AS rating, sounds.sound AS sound, formats.format AS format, dvd_titles.award AS award
FROM dvd_titles
JOIN genres ON dvd_titles.genre_id = genres.genre_id
JOIN ratings ON dvd_titles.rating_id = ratings.rating_id
JOIN labels ON dvd_titles.label_id = labels.label_id
JOIN sounds ON dvd_titles.sound_id = sounds.sound_id
JOIN formats ON dvd_titles.format_id = formats.format_id
WHERE dvd_title_id =" . $_GET["dvd_title_id"] . ";"; 

$sql = $sql . ";";
$results= $mysqli->query($sql);
	if(!$results) {
		echo $mysqli->error;
		exit();
	}

$row = $results-> fetch_assoc();
// var_dump($row);

$mysqli->close();



?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Details | DVD Database</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="index.php">Home</a></li>
		<li class="breadcrumb-item"><a href="search_form.php">Search</a></li>
		<li class="breadcrumb-item"><a href="search_results.php">Results</a></li>
		<li class="breadcrumb-item active">Details</li>
	</ol>

	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4">DVD Details</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->

	<div class="container">

		<div class="row mt-4">
			<div class="col-12">

				<?php if (isset($error) && !empty($error)) : ?>
					<div class="text-danger font-italic"><?php echo $error?></div>
				<?php else : ?>

				<table class="table table-responsive">

					<tr>
						<th class="text-right">Title:</th>
						<td><?php echo $row["title"];?></td>
					</tr>

					<tr>
						<th class="text-right">Release Date:</th>
						<td><?php echo $row["release_date"];?></td>
					</tr>

					<tr>
						<th class="text-right">Genre:</th>
						<td><?php echo $row["genre"];?></td>
					</tr>

					<tr>
						<th class="text-right">Label:</th>
						<td><?php echo $row["label"];?></td>
					</tr>

					<tr>
						<th class="text-right">Rating:</th>
						<td><?php echo $row["rating"];?></td>
					</tr>

					<tr>
						<th class="text-right">Sound:</th>
						<td><?php echo $row["sound"];?></td>
					</tr>

					<tr>
						<th class="text-right">Format:</th>
						<td><?php echo $row["format"];?></td>
					</tr>

					<tr>
						<th class="text-right">Award:</th>
						<td><?php echo $row["award"];?></td>
					</tr>

				</table>
				<?php endif ; ?>


			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row mt-4 mb-4">
			<div class="col-12">
				<a href="search_results.php" role="button" class="btn btn-primary">Back to Search Results</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
	</div> <!-- .container -->
</body>
</html>