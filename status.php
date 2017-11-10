<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<title>Hot Tub Status</title>
<!-- <meta http-equiv="refresh" content="5"> -->
<meta name="viewport" content="user-scalable = no">
<style media="screen" type="text/css">
img{border:0px;}
table.center {
    margin-left:auto; 
    margin-right:auto;
	margin-top:0px;
  }
</style>
</head>

<body style="text-align: center; background-color: #B6B6DA">
<script type="text/javascript">
function changeUp() {
	document.getElementById("up").src = "upPressed.gif";
}
function changeDown() {
	document.getElementById("down").src = "downPressed.gif";
}
</script>
<?php
	$PA = "<span style=\"font-size:48px;\">";
	$PB = "<span style=\"font-size:64px;\">";
	$PC = "</span><span style=\"font-size:2px;\"><BR><BR></span>";
	
	echo "<p style=\"text-align: center;\">"; 
	echo $PA . "<B>Hot Tub Status</B>" . $PC;
	
	// open a client connection
	$fp = fsockopen ("192.168.0.22", 17200, $errno, $errstr);

	if (!$fp)
	{
      echo $PA . "Error: could not open socket connection<BR>";
      echo "errno: " . $errno . "   " . $errstr;
	}
	else
	{
		$col = 0;
		// send status command
		fputs ($fp, "stat\n");

		$line = fgets ($fp, 1024);
		echo $PA . "Current temp: </span>" . $PB . $line . $PC;

		$line = fgets ($fp, 1024);
		echo $PA . "Desired temp: </span>" . $PB . $line . $PC;

		echo "<a href=\"command.php?cmd=tempdown\"><img src=\"down.gif\" alt=\"down\" id=\"down\" onclick='changeDown();'></a>\n";
		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n";
		echo "<a href=\"command.php?cmd=tempup\"><img src=\"up.gif\" alt=\"up\" id=\"up\" onclick='changeUp();'></a>\n";
		echo $PB . "</span><BR>\n";
		
		$line = fgets ($fp, 1024);
		echo $PA . "Heater temp: </span>" .$PB . $line . "</span><BR>\n";
		
		$line = fgets ($fp, 1024);
		echo $PA . "Heater is ";
		if ($line[0]=="1")
			echo "ON<BR>";
		else 
			echo "OFF<BR>";

		$line = fgets ($fp, 1024);
		echo "Pump is ";
		if ($line[0]=="1")
			echo "ON<BR>";
		else 
			echo "OFF<BR>";

		$line = fgets ($fp, 1024);
		/*echo "Cover is ";
		if ($line[0]=="1")
			echo "OPEN<BR>";
		else 
			echo "CLOSED<BR>";*/
		
		$line = fgets ($fp, 1024);
		echo "Status: " . $line . "<BR>";
	
		// close the connection
		fclose ($fp);
	}
?>
		<a href="command.php?cmd=jet1"><img src="jet1.gif"></a>
		&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="command.php?cmd=jet2"><img src="jet2.gif"></a><BR>
		<BR>
		
		<a href="command.php?cmd=reset"><img src="reset.gif"></a><BR>
		<BR>		

<img src="up.gif" alt="x" width=1 height=1>
<img src="down.gif" alt="x" width=1 height=1>
<img src="upPressed.gif" alt="x" width=1 height=1>
<img src="downPressed.gif" alt="x" width=1 height=1>
</body>
</html>