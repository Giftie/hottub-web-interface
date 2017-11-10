<html>
<body>
<?php
	// open a client connection
	$fp = fsockopen ("192.168.0.22", 17200, $errno, $errstr);
	if (!$fp)
	{
      echo "Error: could not open socket connection<BR>" ;
      echo "errno: " . $errno . "   " . $errstr;
	}
	else
	{
		// write the user string to the socket
		fputs ($fp, $_GET['cmd'] . "\n");
		// get the result
		while ($line = fgets ($fp, 1024))
		{
			$result = $line . "<BR>";
		}
		// close the connection
		fclose ($fp);
		// go back to devices page
		if ($_GET['cmd'] == "reset")
		{
			sleep(1);
		}
		header('Location: status.php');
	}
?>
</body>
</html>