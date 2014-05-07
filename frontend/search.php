<?php
//phpinfo();


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
		<script type = "text/javascript">
			function inputfocus(form){
				form.search.focus()
			}
		</script>
		<script type="text/javascript">
			function ajax() {
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
				xmlhttp.send("query="+document.getElementById('searchField').value);
			}
		</script>
		<script>
			$(document).ready(function(){
				$('#searchField').keypress(function(e){
					if(e.keyCode==13) {
						$('#searchBtn').click();
						e.preventDefault();
					}
				});
			});
		</script>
	</head>

	<body> 

		<form name="searchform">
			<div class="col-lg-12">
				<div class="col-sm-12 col-lg-offset-3 col-lg-6">
					<div class="jumbotron">
						<h2 class="text-center">Image search provided by Evengers!</h2>
					</div>
					<div class="input-group">
						<input id="searchField" type="text" class="form-control" placeholder="Search" autocomplete="off">
						<span class="input-group-btn">
							<button id="searchBtn" class="btn btn-default" type="button" onclick="ajax()">
								<span class="glyphicon glyphicon-search"></span>
							</button>
						</span>
					</div><!-- /input-group -->
					<div id="result">

					</div>
					<ul class="pagination">
						<li><a href="#">&laquo;</a></li>
						<li><a href="#">1</a></li>
						<li><a href="#">2</a></li>
						<li><a href="#">3</a></li>
						<li><a href="#">4</a></li>
						<li><a href="#">5</a></li>
						<li><a href="#">&raquo;</a></li>
					</ul>
				</div><!-- /.col-lg-6 -->
			</div>
		</form>
	</body>
</html>
