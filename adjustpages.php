<html>

 <?php
	$id = $_POST["id"];
	$pages_done = $_POST["pages_done"];
	$pages_total = $_POST["pages_total"];
	
	$conn = mysqli_connect("127.0.0.1", "root", "", "studieplanner");
	
	if(isset($_POST["plus"])){
		$newpages_done = $pages_done+1;
		if($newpages_done == $pages_total){
			$query1 = "UPDATE `tasks` SET `pages_done` = '$newpages_done', `done` = '1' WHERE `tasks`.`id` = $id";		  
			mysqli_query($conn,$query1);}
			
		else{
				$query1 = "UPDATE `tasks` SET `pages_done` = '$newpages_done' WHERE `tasks`.`id` = $id";
				mysqli_query($conn,$query1);};
			}
		
		
	if(isset($_POST["minus"])){
		$newpages_done = $pages_done-1;
		if($newpages_done < $pages_total){
			$query1 = "UPDATE `tasks` SET `pages_done` = '$newpages_done', `done` = '0' WHERE `tasks`.`id` = $id";		  
			mysqli_query($conn,$query1);}
		else{
			$query = "UPDATE `tasks` SET `pages_done` = '$newpages_done' WHERE `tasks`.`id` = $id";
			mysqli_query($conn,$query);};
		}
		
	if(isset($_POST["delete"])){
			$query1 = "delete from `tasks` where `id` = '$id'";		  
			mysqli_query($conn,$query1);}
			
	
	
?>

<meta http-equiv="refresh" content="0; URL=studieplanner.php">
</html>
