<?php
	require("../core.php"); 
	$core = new core();
	
	$i = 0;
	
while($i<70)
  {
  $i++;
  $core->calccrateaverage($i);
  }
?>