<html>

 <?php
	$conn = mysqli_connect("127.0.0.1", "root", "", "studieplanner");
	$course = mysql_real_escape_string($_POST["course"]);
	$title = mysql_real_escape_string($_POST["title"]);
	$pages = mysql_real_escape_string($_POST["pages"]);
	$deadline = mysql_real_escape_string($_POST["deadline"]);
	$notes = mysql_real_escape_string($_POST["notes"]);
	
	$query = "INSERT INTO `tasks` (`course`, `title`,`pages_total`, `pages_done`,`deadline`,`notes`,`done`) VALUES ('$course', '$title', '$pages', '0', '$deadline','$notes','0')";
	mysqli_query($conn,$query);
	
	echo $query;
?>

<meta http-equiv="refresh" content="0; URL=studieplanner.php">
</html>