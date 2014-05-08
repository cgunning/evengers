<?php

	function curl($url) {
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

		$data = curl_exec($ch);
		if(curl_error($ch)) {
			echo "CURL ERROR:" .curl_error($ch);
		}
		curl_close($ch);

		return $data;
	}

	function startsWith($haystack, $needle){ return (substr($haystack, 0, strlen($needle)) === $needle);}

	function endsWith($haystack, $needle){ return (substr($haystack, -strlen($needle)) === $needle);}

	$query=$_POST['query'];
	$page=$_POST['page'];
	$ip=$_POST['ip'];
	$rowsPerPage=$_POST['rpp'];
	// Lucene characters that need escaping with \ are + - && || ! ( ) { } [ ] ^ " ~ * ? : \
	// $luceneReservedCharacters = preg_quote('+-&|!(){}[]^"~*?:\\');
	// $query = preg_replace_callback('/([' . $luceneReservedCharacters . '])/', function($matches) {
 //        	return '\\' . $matches[0];
 //   		}, $query);
	$query = urlencode($query);

	$start = ($page-1) * NUM_ROWS;

	// Create connection
	$url = "http://".$ip.":8983/solr/newCore/select?q=".$query."&start=".$start."&rows=".$rowsPerPage."&wt=json";
	 
	//Executes the URL and saves the content (json) in the variable.
	$content = curl($url);
	echo "raw content:" .$content. "<br/>";
	if($content) {
		$result = json_decode($content,true);
		//prints the content of array on the page. Instead perform the operation you ae interested.
		foreach($result['response']['docs'] as $doc) {
			echo "image url: " .$doc['imageurl']. "<br/>";
		}
	}

	echo "query: " .$query. "<br/>";
	echo "<div class=\"col-lg-12\">";
	$files = scandir('badges/');
	foreach($files as $file) {
		if(endsWith($file, ".png")) {
			echo "<div class=\"col-lg-3 col-md-4 col-sm-6 col-xs-12\">";
			echo "<a class=\"thumbnail\"><img src='badges/".$file."'></a>";
			echo "</div>";
		}
	}
	echo "</div>";
	
	//style=\"height:150px;
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