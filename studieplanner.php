 <html>
 <head>
 <?php
	if(isset($_POST["id"])){
	$id = $_POST["id"];
	$pages_done = $_POST["pages_done"];
	$pages_total = $_POST["pages_total"];
	};
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
 
  <?php
 $conn = mysqli_connect("127.0.0.1", "root", "", "studieplanner");
?>
	 
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 
 
 <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="styles.css">
 <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

 <style>
.button {
    
    border: none;
    color: white;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
	border-radius: 25%;
}

.buttonplus {width: 35px; height:35px; background-color: green}
.buttonplus:hover {background-color: lightgreen}

.buttonminus {width: 35px; height:35px; background-color: red }
.buttonminus:hover {width: 35px; height:35px; background-color: darkred }

.telaat{
	font-size: 20pt;
	color: red;
	font-weight: bold;
}

</style>
 
 </head>
 
 <body>
 
 <iframe style="display:none;" name="target2"></iframe>
<div class = "w3-container w3-border" style = "padding-left: 150px; padding-top: 40px; padding-right: 150px">
	 <h1> TO DO </h1>
<?php
	$query = "SELECT * FROM tasks where `done` = 0 order by `deadline`";
	$result = mysqli_query($conn,$query);


	if(!$result){echo "GEEN RESULTAAT <br/>";}
	else{
	?>
	<p>
	<?php
	
	?>
		<table name = "informatie" class="w3-table w3-striped tablefont" style="font-size: 20pt;">
			<tr>
			  <!--<th> ID </th>-->
			  <th> Course </th>
			  <th> Text title </th>
			  <th> Number of pages </th>
			  <th> Deadline </th>
			  <th> Notes </th>
			  <th> Pages done </th> 
			  <th> Progress </th>
			</tr>
		<?php
			 $lijstmetrijen = array();
			 while($row = $result->fetch_array(MYSQLI_ASSOC)){
			 array_push($lijstmetrijen,$row);
			 $id = $row["id"];
			 $course = $row["course"];
			 $title = $row["title"];
			 $pages_total = $row["pages_total"];	 
			 $pages_done = $row["pages_done"];	 
			 $deadline_us = $row["deadline"];
			 $deadline_eu = date('d-m-Y', strtotime($row["deadline"]));
			 $notes= $row["notes"];
			 
			
			 
		 ?>
			 <tr>
			 	<?php
				//echo "<td>" .$id."</td>";
				 echo "<td>" .$course."</td>";
				 echo "<td>".$title."</td>";
				 echo "<td>".$pages_total."</td>";
				 ?>
				 
				
				<?php 
				
				$today_us = new DateTime("now");
				if($deadline_us < $today_us->format("Y-m-d")){
					
				?>	
				<td class = "telaat"><?php echo $deadline_eu ?> </td>
				
				<?php
				}else{echo "<td>".$deadline_eu." </td>";
				};
				
				echo "<td>".$notes."</td>";?>
				
				<td>
				 <form name = "changepagesread" action"<?=$_SERVER['PHP_SELF']?> method = "post">  <!--target="target2"> ALS IK VERNIEUWEN ANDERS KAN REGELEN-->
					<input type = "hidden" name = "id" id = "id" value = "<?php echo $id; ?>">
					<input type = "hidden" name = "pages_done" id = "pages_done" value = "<?php echo $pages_done; ?>">
					<input type = "hidden" name = "pages_total" id = "pages_total" value = "<?php echo $pages_total; ?>">
 					
					<div style = "padding-left: 25%; font-size: 15pt" > <?php echo $pages_done."<br/>"; ?></div>
					<input type = "submit" name = "minus" id="minus" value = "-" class="button buttonminus">
					<input type = "submit" name = "plus" id="plus" value = "+" class="button buttonplus">
				 </td>
				
				 <td><progress value="<?php echo $pages_done; ?>" max="<?php echo $pages_total; ?>" style = "height: 40px; width: 300px" ></progress></td>
				<td><input type = "submit" name = "delete" id="delete" value = "delete"/></td>
				</form>
			 </tr>
		 <?php
	};};
		 ?>
		 </table> 
		 
		 <BR/><BR/><BR/>
		</div>
		
		<div class = "w3-container w3-border" style = "padding-left: 150px; padding-top: 40px; padding-right: 150px">
	 <h1> DONE </h1>
<?php
	$query = "SELECT * FROM tasks where `done` = 1 order by `deadline`";
	$result = mysqli_query($conn,$query);


	if(!$result){echo "GEEN RESULTAAT <br/>";}
	else{
	?>
	<p>
	<?php
	
	?>
		<table name = "informatie" class="w3-table w3-striped" >
			<tr>
			  <!--<th> ID </th>-->
			  <th> Course </th>
			  <th> Text title </th>
			  <th> Number of pages </th>
			  <th> Deadline </th>
			  <th> Notes </th>
			  <th> Pages done </th> 
			  <th> Progress </th>
			</tr>
		<?php
			 $lijstmetrijen = array();
			 while($row = $result->fetch_array(MYSQLI_ASSOC)){
			 array_push($lijstmetrijen,$row);
			 $id = $row["id"];
			 $course = $row["course"];
			 $title = $row["title"];
			 $pages_total = $row["pages_total"];	 
			 $pages_done = $row["pages_done"];	 
			 $deadline = $row["deadline"];
			 $notes= $row["notes"];
			 
			 
			 
		 ?>
			 <tr>
			 	<?php
				//echo "<td>" .$id."</td>";
				 echo "<td>" .$course."</td>";
				 echo "<td>".$title."</td>";
				 echo "<td>".$pages_total."</td>";
				 ?>
				 
				<?php echo "<td>".$deadline."</td><td>".$notes."</td>";?>
				
				<td>
				 <form name = "changepagesread" action"<?=$_SERVER['PHP_SELF']?> method = "post">
					<input type = "hidden" name = "id" id = "id" value = "<?php echo $id; ?>">
					<input type = "hidden" name = "pages_done" id = "pages_done" value = "<?php echo $pages_done; ?>">
					<input type = "hidden" name = "pages_total" id = "pages_total" value = "<?php echo $pages_total; ?>">
 					
					<div style = "padding-left: 25%; font-size: 15pt" > <?php echo $pages_done."<br/>"; ?></div>
					<input type = "submit" name = "minus" id="minus" value = "-"/ class="button buttonminus">
					<input type = "submit" name = "plus" id="plus" value = "+"/ class="button buttonplus">
				 </td>
				
				 <td><progress value="<?php echo $pages_done; ?>" max="<?php echo $pages_total; ?>" style = "height: 40px; width: 300px" ></progress></td>
				<td><input type = "submit" name = "delete" id="delete" value = "delete"/></td>
				</form>
			 </tr>
		 <?php
	};};
		 ?>
		 </table> 
		 
		 <BR/><BR/><BR/>
		</div>
	 
	 <div class = "w3-container w3-border" style = "padding-left: 150px; padding-top: 40px; padding-right: 150px">
	 <h1> NEW TASK </h1>

	 
	 <form name = "newtask" action="newtask.php" method="post" class="w3-container">
	 
		<label class = "w3-text-teal"> Course: </label> 
		<input type = "text" name = "course" id = "course" class = "w3-input w3-border w3-light-grey" style = "width: 70%">
		
		<label class = "w3-text-teal"> Text title: </label>  
		<input type = "text" name = "title" id = "title" class = "w3-input w3-border w3-light-grey" style = "width: 70%">
	 
		<label class = "w3-text-teal"> Number of pages: </label>  
		<input type = "number" name = "pages" id = "pages" min= "1" class = "w3-input w3-border w3-light-grey" style = "width: 70%">
		
		<label class = "w3-text-teal"> Deadline: </label>  
		<input type = "date" name = "deadline" id = "deadline" class = "w3-input w3-border w3-light-grey" style = "width: 70%">
		
		<label class = "w3-text-teal"> Notes: </label>  
		<input type = "text" name = "notes" id = "notes" class = "w3-input w3-border w3-light-grey" style = "width: 70%">
	 
	 <input type="submit" name = "ok">
	 </form>
	 
	 </br></br></br>
	 </div>
	 	 
			 </body>
		 </html>