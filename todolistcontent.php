
 <div class = "w3-container w3-border" style = "padding-left: 150px; padding-top: 40px; padding-right: 150px">
	 

	 
	 <h1> <?php echo $page_title ?> </h1>
<?php
	$query = "SELECT * FROM tasks where `done` = ".$done_value." order by `deadline`";
	$result = mysqli_query($conn,$query);


	if(!$result){echo "GEEN RESULTAAT <br/>";}
	else{
	?>
	<p>

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
				if($deadline_us <= $today_us->format("Y-m-d")){
					
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
					<br/>
					<input type = "submit" name = "minus5" id="minus5" value = "-5" class="button buttonminus">
					<input type = "submit" name = "plus5" id="plus5" value = "+5" class="button buttonplus">
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