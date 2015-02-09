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
  </head>

  <body>

	<div class="navbar navbar-inverse navbar-fixed-top">
  <a class="navbar-brand" href="./index.php"><img height="25" src="./assets/img/logo2.png"> Uncrateable</a>
  <ul class="nav navbar-nav">
    <li><a href="./index.php">Home</a></li>
	<li class="active"><a href="./about.php">About</a></li>
	</ul>
</div>
  

    <div class="container">
	<div class="jumbotron">
	<p> <h1>All About Un<b>crate</b>able</h1> </p>
	<p><br/></p>
        <p><img src="./assets/img/crate.png" class="img-rounded" align="left">Uncrateable is a website that collects data from a range of sources - backpack.tf, api.steampowered.com and the TF2 Wiki. It then puts all the data into a nice table and allows you to search for your crates.<p>
		</div>
		
		
		<h3>Development</h3>
		<h5>Current Issues</h5>
		<ul>
		<li>Crates from 1-18 showing as containing strange weapons do NOT contain strange weapons.</li>
		</ul>
		<h5>Planned Features</h5>
		<ul>
		<li>Check Backpack for best crate(s) to unbox.</li>
		<li>Add weapon images.</li>
		<li>Add data for crate prices on Steam Market Place and backpack.tf.</li>
		<li>Add rating system.</li>
		<li>Add highest/lowest value item options.</li>
		</ul>
		<p>&nbsp;</p>
		
			<footer><center>Created by <a href="http://www.greenpencillp.com/">greenpencil</a>. © 2013, all rights reserved.<br/>Special thank you to <a href="http://webchat.quakenet.org/?channels=mindcrack&uio=d4">#Mindcrack on Quakenet</a> for help <br/>And thank you to <a href="http://www.shreeyam.net/">Shreeyam</a> and <a href="https://bassh.net/">KyleXY</a> for hosting it<br/>Powered by <a href="http://backpack.tf/api/">Backpack.tf</a> and <a href="http://steamcommunity.com/dev">Steam APIs</a></center></footer>
    </div>
  </body>
</html>
