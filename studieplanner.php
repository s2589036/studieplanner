 <html>
	 <head>

		<?php $conn = mysqli_connect("127.0.0.1", "root", "", "studieplanner");?>
		<?php include("buttonhandling.php") ?>
		<?php include("styles.php") ?>

	 </head>
 
	<body>
 
		<iframe style="display:none;" name="target2"></iframe>
	 
		<?php 
			$page_title = "TO DO"; 
			$done_value = 0; 
		?>
		
		<?php include("todolistcontent.php") ?>
	 
		<?php 
			$page_title = "DONE";
			$done_value = 1;
		?>
		
		<?php include("todolistcontent.php") ?>
	 
			
		 <div class = "w3-container w3-border" style = "padding-left: 150px; padding-top: 40px; padding-right: 150px">
			<h1> NEW TASK </h1>
			<form name = "newtask" action="newtask.php" method="post" class="w3-container">
		 
				<label class = "w3-text"> Course: </label> 
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
		</div>
	
	</body>
</html>