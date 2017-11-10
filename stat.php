<?php
	// open a client connection
	$fp = fsockopen ("192.168.0.22", 17200, $errno, $errstr);
	if (!$fp)
	{
      echo "Error: could not open socket connection";
	}
	else
	{
		// send status command
		fputs($fp, "stat\n");
		// 0 current temp
		$line = fgets ($fp, 1024);
		echo str_replace("\n", ",", $line );
		// 1 desired temp
		$line = fgets ($fp, 1024);
		echo str_replace("\n", ",", $line );
		// 2 heater temp
		$line = fgets ($fp, 1024);
		echo str_replace("\n", ",", $line );
		// 3 heater state
		$line = fgets ($fp, 1024);
		echo str_replace("\n", ",", $line );
		// 4 pump state
		$line = fgets ($fp, 1024);
		echo str_replace("\n", ",", $line );
		// 5 cover state
		$line = fgets ($fp, 1024);
		echo str_replace("\n", ",", $line );
		// 6 system status
		$line = fgets ($fp, 1024);
		echo str_replace("\n", ",", $line );
		// 7 jet 1 level
		$line = fgets ($fp, 1024);
		echo str_replace("\n", ",", $line );
		// 7 jet 2 level
		$line = fgets ($fp, 1024);
		echo str_replace("\n", ",", $line );
		// close the connection
		fclose ($fp);
	}
?>
