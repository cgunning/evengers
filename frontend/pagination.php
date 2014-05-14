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

	$query=$_POST['query'];
	$ip=$_POST['ip'];
	$rowsPerPage=$_POST['rpp'];

	$query = urlencode("(".$query.")");

	// Create connection
	$url = "http://".$ip.":8983/solr/testCore/select?q=descr:".$query."&wt=json";


	$result = json_decode(curl($url),true);

	$numFound = $result['response']['numFound'];
	if($numFound == 0) {
		echo "<p class=\"text-center\">No matches were found.</p>";
	} else {
		$pages = ceil($numFound / $rowsPerPage);
		echo "<ul class=\"pagination\">";
		for($i=1; $i<=$pages; $i++) {
			echo "<li><a href=\"#\" onclick=\"ajax('".$i."')\">".$i."</a></li>";
		}
		echo "</ul>";
	}
?>