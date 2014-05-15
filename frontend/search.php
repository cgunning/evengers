<?php
//phpinfo();
	session_start();
?>
<html>
	<head>
		<title>Solr search</title>
		<!-- Javascript -->
		<script type="text/javascript" src='javascripts/jquery-1.11.0.min.js'></script>
		<!-- Bootstrap -->
		<script type="text/javascript" src='javascripts/bootstrap.js'></script>
		<!-- Stylesheets -->
		<link rel='stylesheet' href='stylesheets/bootstrap.css'>
		<link rel='stylesheet' href='stylesheets/bootstrap-theme.css'>
		<link rel='stylesheet' href='stylesheets/style.css'>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
		<script type="text/javascript">
			CURRENT_IP = "130.229.173.79";
			ROWS_PER_PAGE = 12;
			function ajax(page) {
				var xmlhttp;
				if (window.XMLHttpRequest) {
					// code for IE7+, Firefox, Chrome, Opera, Safari
					xmlhttp=new XMLHttpRequest();
				} else { // code for IE6, IE5
					xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
				}
				xmlhttp.onreadystatechange=function() {
					if (xmlhttp.readyState==4 && xmlhttp.status==200) {
						document.getElementById("result").innerHTML=xmlhttp.responseText;
					}
				}
				xmlhttp.open("POST","result.php",true);
				xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xmlhttp.send("query="+sessionStorage.getItem("query")+"&page="+page+"&ip="+CURRENT_IP+"&rpp="+ROWS_PER_PAGE);
			}
			function ajaxPagination() {
				var xmlhttp;
				if (window.XMLHttpRequest) {
					// code for IE7+, Firefox, Chrome, Opera, Safari
					xmlhttp=new XMLHttpRequest();
				} else { // code for IE6, IE5
					xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
				}
				xmlhttp.onreadystatechange=function() {
					if (xmlhttp.readyState==4 && xmlhttp.status==200) {
						document.getElementById("pagination").innerHTML=xmlhttp.responseText;
					}
				}
				xmlhttp.open("POST","pagination.php",true);
				xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xmlhttp.send("query="+sessionStorage.getItem("query")+"&ip="+CURRENT_IP+"&rpp="+ROWS_PER_PAGE);
			}
			function search() {
				sessionStorage.setItem("query", document.getElementById("searchField").value);
				ajax('1');
				ajaxPagination();
			}
			// function fitImages() { DID NOT WORK, USE BACKGROUND-IMAGE AND CSS INSTEAD!
			// 	$("a").each(function(){
			// 		// console.log('RESIZING IMAGES');
			// 		var thisWidth = $(this).width();
			// 		var thisHeight = $(this).height();
			// 		var img = $(this).children();
			// 		var imgWidth = img.width();
			// 		var imgHeight = img.height();

			// 		if(imgHeight > imgWidth) {
			// 		    img.css("width", "auto");
			// 		    img.css("height", "100%");
			// 		} else {
			// 		    img.css("width", "100%");
			// 		    img.css("height", "auto");
			// 		    img.css("margin-top", (thisHeight-img.height())/2);
			// 		    // var d = new Date();
			// 		    // img.attr("src", img.attr("src")+"?"+d.getTime());
			// 		}
			// 	});
			// }

		</script>
		<script>
			$(document).ready(function(){
				$('#searchField').keypress(function(e){
					if(e.keyCode==13) {
						$('#searchBtn').click();
						e.preventDefault();
					}
				});
				$('#searchBtn').click(function() {
					$('#jumbo').slideUp(1000);
				});
			});
		</script>
	</head>

	<body> 

		<form name="searchform">
			<div class="col-lg-12">
				<div class="col-md-12 col-lg-offset-3 col-lg-6 well">
					<div id="jumbo" class="jumbotron">
						<h1 class="text-center">Image search</h1>
					</div>
					<div class="input-group">
						<input id="searchField" type="text" class="form-control" placeholder="Search" autocomplete="off" autofocus>
						<span class="input-group-btn">
							<button id="searchBtn" class="btn btn-default" type="button" onclick="search()">
								<span class="glyphicon glyphicon-search"></span>
							</button>
						</span>
					</div><!-- /input-group -->
				</div><!-- /.col-lg-6 -->
			</div> <!-- ./col-lg-12 -->
			<div class="col-lg-12">
				<div class="col-md-12 col-lg-offset-1 col-lg-10" id="result">

				</div>
				<div class="col-md-12 col-lg-offset-1 col-lg-10 text-center" id="pagination">

				</div>
			</div>
		</form>
	</body>
</html>
