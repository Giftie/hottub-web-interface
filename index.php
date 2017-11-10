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
	<script type="text/javascript">
        
		function doUpdate(statustext)
		{
			parts = statustext.split(",");

			document.getElementById("current").innerHTML = "Current: " + parts[0];
			document.getElementById("desired").innerHTML = "Desired: " + parts[1];
			///document.getElementById("heater").innerHTML = parts[2];
			document.getElementById("heater-stat").innerHTML = parts[3];
			document.getElementById("pump-stat").innerHTML = parts[4];
			//document.getElementById("cover-stat").innerHTML = parts[5];
			document.getElementById("status").innerHTML = parts[6];
			document.getElementById("jet1-stat").innerHTML = parts[7];
			document.getElementById("jet2-stat").innerHTML = parts[8];
		}
		
		function updateStatus()
		{
			if (window.XMLHttpRequest)
			{// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp=new XMLHttpRequest();
			}
			else
			{// code for IE6, IE5
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange =
				function()
				{
					if (xmlhttp.readyState==4 && xmlhttp.status==200)
					{
						///alert(xmlhttp.responseText);
						doUpdate(xmlhttp.responseText);
					}
				}
			xmlhttp.open("GET", "stat.php", false );
			xmlhttp.send();    
		}

		function hottubCommand(cmd)
		{
			if (window.XMLHttpRequest)
			{// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp=new XMLHttpRequest();
			}
			else
			{// code for IE6, IE5
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.open("GET", "command.php?cmd="+cmd, false );
			xmlhttp.send();    
		}
		
		function changeUp() {
			document.getElementById("up").src = "upPressed.gif";
			hottubCommand("tempup");
			setTimeout(function() {
									document.getElementById("up").src = "up.gif";
									updateStatus();
								  } ,500);
		}
		
		function changeDown() {
			document.getElementById("down").src = "downPressed.gif";
			hottubCommand("tempdown");
			setTimeout(function() {
									document.getElementById("down").src = "down.gif";
									updateStatus();
								  } ,500);
		}
		
		function changeJet1() {
			document.getElementById("jet1").src = "jet1Pressed.gif";
			hottubCommand("jet1");
			setTimeout(function() {
									document.getElementById("jet1").src = "jet1.gif";
									updateStatus();
								  } ,500);
		}
		
		function changeJet2() {
			document.getElementById("jet2").src = "jet2Pressed.gif";
			hottubCommand("jet2");
			setTimeout(function() {
									document.getElementById("jet2").src = "jet2.gif";
									updateStatus();
								  } ,500);
		}
		
		function doReset() {
			document.getElementById("reset").src = "resetPressed.gif";
			hottubCommand("reset");
			setTimeout(function() {
									document.getElementById("reset").src = "reset.gif";
									updateStatus();
								  } ,500);
		}
		
		setInterval(updateStatus, 10000);
	</script>
</head>

<body onload="updateStatus();" style="text-align: center; background-color: #B6B6DA">
<script type="text/javascript">

</script>
<div style="margin: auto; font-size: x-large;">
	<div id="title" style="font-size: 175%;">
		<b>Ted's Hot Tub</b>
	</div>
	<div id="current" style="font-size: 200%; margin-top: 30px;">
		Current: 106.9
	</div>
	<div id="desired" style="font-size: 200%; margin-top: 30px;">
		Desired: 109.9
	</div>
	<div id="buttons" style="width: 650px; margin-left: auto; margin-right: auto; margin-top: 30px;">
		<div style="float: left;">
			<a href="#"><img src="down.gif" alt="down" id="down" onclick='changeDown();'></a>
		</div>
		<div style="float: right;">
			<a href="#"><img src="up.gif" alt="up" id="up" onclick='changeUp();'></a>
		</div>
		<div style="clear: both;"></div>
	</div>
	<div id="states" style="font-size: 200%;">
		<center><table>
		<tr>
			<td align="right">
				Heater: &nbsp; 
			</td>
			<td>
				<div id="heater-stat">ON</div>
			</td>
		<tr>
		<tr>
			<td align="right">
				Pump: &nbsp; 
			</td>
			<td>
				<div id="pump-stat">ON</div>
			</td>
		<tr>
		<tr>
			<td align="right">
				Status: &nbsp; 
			</td>
			<td>
				<div id="status">FUBAR</div>
			</td>
		<tr>
		</table></center>
	</div>
	<div name="jets" style="width: 650px; margin-left: auto; margin-right: auto; margin-top: 30px;">
		<div style="float: left;">
			<a href="#"><img src="jet1.gif" id="jet1" onclick='changeJet1();'></a><br>
			<div id="jet1-stat" style="font-size: 150%;">Off</div>
		</div>
		<div style="float: right;">
			<a href="#"><img src="jet2.gif" id="jet2" onclick='changeJet2();'></a></br>
			<div id="jet2-stat" style="font-size: 150%;">Off</div>
		</div>
		<div style="clear: both;"></div>
	</div>
	<div style="margin-top: 50px;">
		<a href="#"><img src="reset.gif" id="reset" onclick='doReset();'></a>
	</div>
</div>
</body>
</html>