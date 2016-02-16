<!DOCTYPE html>
<html lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="Jump Fatigue Calculator">
    <meta name="author" content="kiu Nakamura">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <title>EVE Tools - Fatigue Details</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <?php include("../switcher.php"); ?>
    <link rel="stylesheet" href="/dscan/css/custom.css">
  </head>

<body>

<?php include("../header.php"); ?>
<br>

<!-- Content -->
    <div class="container">
	<h3>Mechanic</h3>
	<p>Jump fatigue is not limited to capital pilots, it also affects anyone using a jumpbridge. Please <a href="http://community.eveonline.com/news/dev-blogs/phoebe-travel-change-update/">read up</a> on the topic as its important for everyone to understand the new mechanic.</p>
	<br>
	<p><b>Cooldown</b> = Timer preventing you from jumping</p>
	<p><b>Fatigue</b> = Penalty timer used as a basis for the cooldown timer</p>
	<p><u>Everytime you travel using a jump mechanic this happens:</u></p>
	<ul>
	    <li>Your current fatigue timer is taken and divided by ten. The result is compared against the distance you travelled in lightyears + 1 and whichever is greater will be your cooldown timer after the jump.</li>
	<li>Your current fatigue timer or at least 10 minutes is taken and multiplied by the distance you travelled in lightyears + 1. If the timer exceeds 5 days it will be capped. This will be your new fatigue timer.</li>
	</ul>

	<h3>Calculation</h3>
	<p><b>Cooldown (minutes)</b> = Max ( fatigue / 10, 1 + ( distance in lightyears * ( 1 - bonus ) ) )</p>
	<p><b>Fatigue (minutes)</b> = Min ( 60 * 24 * 5, Max ( fatigue, 10 ) * ( 1 + ( distance in lightyears * ( 1 - bonus ) ) ) )</p>
	<p><small>Be aware that there is <b>no benefit</b> in waiting for fatigue to decay <b>below 10 minutes</b></small></p>

	<h3>Bonus</h3>
	<table class="table table-striped table-hover table-condensed">
	    <thead>
		<tr><th>Ship</th><th>Jumping to Cyno<br>Bridged by Titan<br>Using Jumpbridge</th><th>Jumping to Covert Cyno<br>Bridged by Black Ops</th></tr>
	    </thead>
	    <tbody>
		<tr>	<td>Black Ops</td>											<td class="text-warning">50%</td>	<td class="text-warning">50%</td></tr>
		<tr>	<td>Covert Ops, Force Recon</td>									<td class="text-danger">0%</td>		<td class="text-warning">50%</td></tr>
		<tr>	<td>Blockade Runner</td>										<td class="text-success">90%</td>	<td class="text-success">95%</td></tr>
		<tr>	<td>Standard Industrial, Deep Space Transport, Capital Industrial, Jumpfreighter, Freighter</td>	<td class="text-success">90%</td>	<td class="text-muted">N/A</td></tr>
		<tr>	<td>Everything else</td>										<td class="text-danger">0%</td>		<td class="text-muted">N/A</td></tr>
	    </tbody>
	</table>

	<h3>Jump Range</h3>
	<table class="table table-striped table-hover table-condensed">
	    <thead>
		<tr><th>Ship</th><th>Range (ly)</th></tr>
	    </thead>
	    <tbody>
		<tr>	<td>Jumpfreighter</td>					<td>5.0 - 10.0</td></tr>
		<tr>	<td>Black Ops</td>					<td>4.0 -  8.0</td></tr>
		<tr>	<td>Carrier, Dreadnought, Super, Titan, Rorqual</td>	<td>2.5 -  5.0</td></tr>
	    </tbody>
	</table>

    </div>
<!-- Content -->

    <div style="font-size:70%; position:fixed; bottom:1px; left:5px; z-index:23;">Based on the <a href="http://community.eveonline.com/news/dev-blogs/phoebe-travel-change-update/">CCP devblog</a> released 30.10.2014 17:19</div>
    <div style="font-size:70%; position:fixed; bottom:1px; right:1px; z-index:23;">Brought to you by <a href="http://evewho.com/pilot/kiu+Nakamura">kiu Nakamura</a> / <a href="http://evewho.com/alli/Brave+Collective">Brave Collective</a></div>

    <script src="js/jquery-1.10.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

</body>
</html>
