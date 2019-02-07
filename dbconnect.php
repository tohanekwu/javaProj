<?php 
	$username='projects';
	$password='projects123';
	$db='(DESCRIPTION =
	(ADDRESS = (PROTOCOL = TCP)(HOST = localhost)(PORT = 1522))
	(CONNECT_DATA =
	(SERVER = DEDICATED)
	(SERVICE_NAME = oradb)
	)
	)';
	
	$connection = oci_connect($username, $password, $db);
	if (!$connection) {
		$e = oci_error(); 
		echo htmlentities($e['message']);
	} 
	else
	{
		echo "Connection was okay";
		$sql = "Select dob, postalcode, salary from students where Quadrant = "."'NE'";
		$stmt = oci_parse($connection, $sql);
		//$quadrant='NE';
		//oci_bind_by_name($stmt, ":quadrant", $quadrant);
		$r = oci_execute($stmt);
		$nrows = oci_fetch_all($stmt, $results);
		
		if($nrows>0){
				echo "Number of records returned = ". $nrows;
				echo "<table border><tr><th>DOB</th><th>Postal Code</th><th>Salary</th></tr>";
				for ($i = 0; $i < $nrows; $i++) {
					echo "<tr>\n";
					foreach ($results as $data) {
						echo "<td>$data[$i]</td>\n";
					}
					echo "</tr>\n";
				}
				echo "</table>";
				
		}
		else 
			echo "Number of records returned = ". $nrows;
	}
?>