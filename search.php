<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charstet=utf-8:" />
		<title>Search Engine - Home</title>
	</head>
<body>

	
		<h2>Search Engine</h2>
		<form action='' method='get'>
			<input type='text' name='k' size='50' value='<?php echo $_GET['k']; ?>' />
			<input type='submit' value='search'/>
		</form>
		<hr>
		<?php
			
			$k = $_GET['k'];
			
			$terms = explode(" ", $k);
			$query = "SELECT * FROM search";
			
			foreach ($terms as $each){
				$i++;
				if ($i == 1)
					$query.= "keywords LIKE '%$each%'";
				
				else 
					$query .= " OR keywords LIKE '%$each%' ";
			}
			
			echo $query;
			
			//Connect
			$connect = mysqli_connect("localhost", "root","","search");
			
			mysqli_connect("localhost", "root","","search");
			mysqli_select_db($connect,"search");
			
			
			
			$query = mysqli_query($connect,$query);
			//$result = mysqli_query($connect,$query);
			
			echo $query;
			
			$numrows = mysqli_num_rows($query);
						
			//if ($connect->connect_error) {
   // die("Connection failed: " . $conn->connect_error);
//} 
//echo "Connected successfully";
			
			if ($numrows > 0){
				
				while ($row = mysqli_fetch_assoc($query)) {
					$id = $row['id'];
					$title = $row['title'];
					$description = $row['description'];
					$keywords = $row['keywords'];
					$link = $row['links'];
					
					echo "<h2><a href='$link'>$title</a></h2> $description<br><br />";
				}
				
			}
			else 
				echo "No results found for \"<b>$k</b>\"";
			
			//Disconnect
			mysqli_close($connect);
			
		?>
	
</body>
</html>
