<?php
//Open database connection
include "../conecta.php";
include "../valida_cookies.php";
set_time_limit(0);


		//Get records from database
		$rs = $mysqli->query("select * from tipousuario order by nome");
		
		
		//Add all records to an array
		echo '{
   "Result":"OK",
   "Options":[
';
$i=0;
		while ($registro = $rs->fetch_array()) {
			
			echo '{
     			    "DisplayText":"'.addslashes($registro[1]).'",
      			   "Value":"'.addslashes($registro[0]).'"
   				   }';
		    if(($i+1) != $rs->num_rows){
				echo ',';	
			}
			$i++;
		}
		
		echo ' ]
}
';
	
	
?>