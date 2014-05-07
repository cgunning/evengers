<?php
	function curl($url){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		$data = curl_exec($ch);
		curl_close($ch);
		return $data;
	}
	// Create connection
	// TODO: GET SOLR INFO
	$query=$_POST['query'];

	//replace with your query URL
	$url = "http://127.0.0.1:8983/solr/collection1/select/?q=*%3A*&start=0&rows=10";
	 
	//Executes the URL and saves the content (json) in the variable.
	$content = curl($url);
	if($content) {
		$result = json_decode($content,true);
		//prints the content of array on the page. Instead perform the operation you ae interested.
		echo $result;
	}

	echo $query
	// while($row = mysql_fetch_array($result)) {
	// 	echo "<tr>";
	// 	echo "<td>" . $row['lan'] . "</td>";
	// 	echo "<td>" . $row['objekttyp'] . "</td>";
	// 	echo "<td>" . $row['adress'] . "</td>";
	// 	echo "<td>" . $row['area'] . "</td>";
	// 	echo "<td>" . $row['rum'] . "</td>";
	// 	echo "<td>" . $row['pris'] . "</td>";
	// 	echo "<td>" . $row['avgift'] . "</td>";
	// 	echo "</tr>";
	// }
?>