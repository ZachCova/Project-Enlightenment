<!--
 Project Enlightenment
 http://ZachCova.com
 Copyright 2015, Zachary Covarrubias Faizan Zafar
 Free to use under the MIT license.
 http://www.opensource.org/licenses/mit-license.php
-->
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin</title>
    <link rel="stylesheet" href="css/foundation.css" />
    <script src="js/vendor/modernizr.js"></script>
	<script src="js/vendor/jquery.js"></script>
	<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
</head>
<body>
<br><br>
<center><h2>Hey Admin!</h2></center>
<form method="post" enctype="multipart/form-data" name="form" action="enlightenment.php?switchType=setup">
<div class="row">
	 <div class="large-6 large-offset-3 columns">
              <div class="large-12 columns" style="padding: 0em;">
			  <h6 style="text-align: center;">How Many Users For the Project</h6>
			  <input type="text" name="userCount" placeholder="1, 2, 5, or 10"></input>
			  <h6 style="text-align: center;">Usernames Separated by ","</h6>
			  <textarea type="text" name="humanNames" placeholder="Zach, Christi, Faizan, Justin, Gabi"></textarea>
				<h6 style="text-align: center;">How Frequent the Questions Cycle</h6>
					<center>
					<input type="radio" onclick="toggle_visibility_hidden('daycount')" name="timeMode" value="Daily" id="daily_"><label for="daily_">Daily</label></input>
					<input type="radio" onclick="toggle_visibility_hidden('daycount')" name="timeMode" value="Weekly" id="weekly_"><label for="weekly_">Weekly</label></input>
					<input type="radio" onclick="toggle_visibility_hidden('daycount')" name="timeMode" value="Monthly" id="monthly_"><label for="monthly_">Monthly</label></input>
					<br>
					<input type="radio" onclick="toggle_visibility_hidden('daycount')" name="timeMode" value="OtherDay" id="otherday_"><label for="otherday_">Every Other Day</label></input>
					<input type="radio" onclick="toggle_visibility('daycount')" name="timeMode" value="DayCount" id="daycount_"><label for="daycount_">After "X" Days</label></input>
					</center>
					<div id="daycount" class="hidden">
						<center><h6>How often would you like the the questions to cycle in term of days?</h6></center>
						<div class="row">
							<div class="large-12 columns">
								<div class="range-slider" data-slider data-options="start: 1; end: 31;display_selector: #sliderOutput9;">
								<span class="range-slider-handle" role="slider" tabindex="16"></span>
								<span class="range-slider-active-segment"></span>
								<input type="hidden" name="DayAmount">
								<br>
							<div class="large-12 columns">
								<center><h6 class="lead">Every</h6><span id="sliderOutput9"></span><h6 class="lead">Day(s)</h6></center>
							</div>
								</div>
							</div>
						</div>
					</div>						
			  <h6 style="text-align: center;">Username for SQL</h6>
			  <input type="text" name="username" placeholder="Username For SQL"></input>
			  <h6 style="text-align: center;">Password for SQL</h6>
			  <input type="password" name="password" placeholder="Password for SQL"></input>
			  <h6 style="text-align: center;">What Would You Like Your Database to be Called</h6>
			  <input type="text" name="database" placeholder="zachfaizan"></input>
			  <h6 style="text-align: center;">Server-name</h6>
			  <input type="text" name="servername" placeholder="e.g. localhost"></input>
			<br>
              <input type="submit" id="submit" oname="Submit" class="expand button" value="Mission is a Go!">
			<br>
			</div>
	
	
	 </div>
	 </div>
	 </div>
</form>
</body>
<script type="text/javascript">
    function toggle_visibility(id) {		
       var e = document.getElementById(id);
       if(e.className == 'visible')
		  document.getElementById(id).className = "hidden";
       else
          document.getElementById(id).className = "visible";
    }
	function toggle_visibility_hidden(id) {
		document.getElementById(id).className = "hidden";
	}
</script>
	<script src="js/vendor/jquery.js"></script>
		<script src="js/foundation.min.js"></script>
		<script>
		$(document).foundation();
	</script>

</html>