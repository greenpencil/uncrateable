<?php
	require("./core.php"); 
	$core = new core();
?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Uncrateable</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
	<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
    <!-- Le styles -->
    <link href="./assets/css/bootstrap.css" rel="stylesheet">
	<link href="./assets/css/bootstrap-glyphicons.css" rel="stylesheet">
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>
    <link href="./assets/css/bootstrap-responsive.css" rel="stylesheet">
	
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="./assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons-->
    <script src="./assets/js/bootstrap.js"></script>

	<link rel="icon" type="image/png" href="./assets/img/crate.png">
	<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-9536417-9', 'uncrateable.com');
  ga('send', 'pageview');

</script>
  </head>

  <body>

	<div class="navbar navbar-inverse navbar-fixed-top">
  <a class="navbar-brand" href="./index.php"><img height="25" src="./assets/img/logo2.png"> Uncrateable</a>
  <ul class="nav navbar-nav">
    <li class="active"><a href="./index.php">Home</a></li>
	<li><a href="./about.php">About</a></li>
	</ul>
</div>
  

    <div class="container">
	<div class="jumbotron">
	<p> <h1>Welcome to Un<b>crate</b>able</h1> </p>
	<p><br/></p>
        <p><img src="./assets/img/crate.png" class="img-rounded" align="left">Uncrateable is a tool which calculates the best crate to unbox based on the value of items it contains. It will first give you a simple yes or no answer, however for more information you can find current prices, percentages and profits based on the current cost of keys and refined metal. If you want to know the best crate to unbox that you have or the top lists please use the navigational links. To begin select a crate number from the list.</p>
		<p><br/></p>
		<p><?php $core->createcratedropdown(); ?></p>
		</div>
		<h3>Your Crate</h3>
		<?php if(isset($_GET['crate']))
		{
			$core->createyourcrate($_GET['crate']);
		} else {
			?>
			<table class="table table-bordered"><thead><tr><th></th><th>Crate Number</th><th>Value</th><th>Info</th></tr></thead><tbody><tr><td></td><td>No crate selected</td><td></td><td></td></tr></tbody></table>
			<?php
		} ?>
		<div class="container"><h3>Top Value Crates</h3>
		<?php echo $core->createtopcrates(); ?>
			
		
			<footer><center>Created by <a href="http://www.greenpencillp.com/">greenpencil</a>. © 2013, all rights reserved.<br/>Special thank you to <a href="http://webchat.quakenet.org/?channels=mindcrack&uio=d4">#Mindcrack on Quakenet</a> for help (S<br/>And thank you to <a href="http://www.shreeyam.net/">Shreeyam</a> and <a href="https://bassh.net/">KyleXY</a> for hosting it<br/>Powered by <a href="http://backpack.tf/api/">Backpack.tf</a> and <a href="http://steamcommunity.com/dev">Steam APIs</a></center></footer>
    </div>
  </body>
</html>
