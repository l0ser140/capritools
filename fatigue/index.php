<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="Jump Fatigue Calculator">
    <meta name="author" content="kiu Nakamura">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <title>EVE Tools - Fatigue Calculator</title>
    <?php include("../switcher.php"); ?>
    <link rel="stylesheet" href="/fatigue/css/bootstrap.min.css">
    <link rel="stylesheet" href="/fatigue/css/typeahead.css">
    <link rel="stylesheet" href="/fatigue/css/custom.css">
</head>

<body>

<?php include("../header.php"); ?>
<br>
<!-- Content -->
    <div class="container">
	<span id="option-travel" style="font-size:140%;">
	    <label>I travel by </label>
	    <button id="option-travel-1" class="btn btn-default btn-sm" onclick="selectTravel = 1; readjust();"><b>using a Jumpbridge</b></button>
	    <button id="option-travel-2" class="btn btn-default btn-sm" onclick="selectTravel = 2; readjust();"><b>jumping to a Cyno / being bridged by a Titan</b></button>
	    <button id="option-travel-3" class="btn btn-default btn-sm" onclick="selectTravel = 3; readjust();"><b>jumping to a Covert Cyno / being bridged by a Black Ops</b></button>
	</span>

<br>

	<span id="option-ship-covert" style="font-size:140%;" class="hide">
	    <label>I am in a </label>
	    <button id="option-ship-covert-1" class="btn btn-default btn-sm" onclick="selectShipCovert = 1; readjust();"><b>Black Ops, Covert Ops, Force Recon</b></button>
	    <button id="option-ship-covert-2" class="btn btn-default btn-sm" onclick="selectShipCovert = 2; readjust();"><b>Blockade Runner</b></button>
	</span>

	<span id="option-ship" style="font-size:140%;" class="hide">
	    <label>I am in a </label>
	    <button id="option-ship-1" class="btn btn-default btn-sm" onclick="selectShip = 1; readjust();"><b>Black Ops</b></button>
	    <button id="option-ship-2" class="btn btn-default btn-sm" onclick="selectShip = 2; readjust();"><b>Jumpfreighter</b></button>
	    <button id="option-ship-3" class="btn btn-default btn-sm" onclick="selectShip = 3; readjust();"><b>Standard-, Advanced-, Capital-Industrial, Freighter</b></button>
	    <button id="option-ship-4" class="btn btn-default btn-sm" onclick="selectShip = 4; readjust();"><b>Everything else</b></button>
	</span>

<br>

	<span id="option-jdc" style="font-size:140%;" class="hide">
	    <label>I or the bridging pilot have </label>
	    <button id="option-jdc-1" class="btn btn-default btn-sm" onclick="selectJdc = 1; readjust();"><b>JDC I</b></button>
	    <button id="option-jdc-2" class="btn btn-default btn-sm" onclick="selectJdc = 2; readjust();"><b>JDC II</b></button>
	    <button id="option-jdc-3" class="btn btn-default btn-sm" onclick="selectJdc = 3; readjust();"><b>JDC III</b></button>
	    <button id="option-jdc-4" class="btn btn-default btn-sm" onclick="selectJdc = 4; readjust();"><b>JDC IV</b></button>
	    <button id="option-jdc-5" class="btn btn-default btn-sm" onclick="selectJdc = 5; readjust();"><b>JDC V</b></button>
	</span>

	<hr>

	<span class="pull-left">
	    Fatigue Bonus: <b id="fatigue-bonus">6nbsp;</b> <button class="btn btn-default btn-xs btn-danger" onclick="location.href='/fatigue/details.php'"><b>Details</b></button>
	</span>
	<span class="pull-right">
	    Set all distances to 
	    <button class="btn btn-default btn-xs btn-danger" onclick="resetMin();"><b>MIN</b></button>
	    <button class="btn btn-default btn-xs btn-danger" onclick="resetMax();"><b>MAX</b></button>
	</span>

	<br>
	<br>

	<table class="table table-hover table-striped">
	    <thead>
		<tr>
		    <th>Jump<br>&nbsp;</th>
		    <th class="text-right">Cooldown<br>&nbsp;</th>
		    <th class="text-center">Wait Period<br><span class="text-muted"><small>(optional)</small></span></th>
		    <th class="text-right">Fatigue*<br><span class="text-muted"><small>(before jump)</small></span></th>
		    <th class="text-center">Jump Distance<br>&nbsp;</th>
		    <th class="text-right">Fatigue*<br><span class="text-muted"><small>(after jump)</small></span></th>
		    <th class="text-right">Travel Time<br><span class="text-muted"><small>(sum)</small></span></th>
		</tr>
	    </thead>
	    <tbody>
		<tr id="row-1">
		    <td style="vertical-align:middle;"><span style="font-size:140%;">#1</span></td>
		    <td class="text-right" style="vertical-align:middle;"><b><span style="font-size:140%;" class="text-muted">N/A</span></b></td>
		    <td class="text-center" style="vertical-align:middle;"><b><span style="font-size:140%;" class="text-muted">N/A</span></b></td>
		    <td class="text-right col-md-2" style="vertical-align:middle;">
			<form class="form-inline">
			    <div class="form-group">
				<div class="input-group">
				    <input id="prefatigue-input-h" type="number" class="form-control text-right" onchange="recalc();" onkeyup="recalc();" placeholder="HH" max="120" min="0" step="1" style="width: 50%;">
				    <input id="prefatigue-input-m" type="number" class="form-control text-right" onchange="recalc();" onkeyup="recalc();" placeholder="MM" max="59"  min="0" step="1" style="width: 50%;">
				</div>
			    </div>
			</form>
		    </td>
		    <td class="text-center">
			<br>
                        <input id="start-1-input" type="text" class="form-control text-right tt-input typeahead" onchange="system_changed();" placeholder="From">
			<input id="distance-1-input" style="display: inline;" onchange="slider_changed();"  type="range" min="0" max="0" step="0.01">
			    <span id="distance-1-min" class="pull-left text-muted"></span>
			    <span id="distance-1-value"></span>
			    <span id="distance-1-max" class="pull-right text-muted"></span>
                        <input id="end-1-input" type="text" class="form-control text-right tt-input typeahead" onchange="system_changed();" placeholder="To">
		    </td>
		    <td class="text-right" style="vertical-align:middle;"><b><span id="result-1-fatigue-after" style="font-size:140%;">&nbsp;</span></b></td>
		    <td class="text-right" style="vertical-align:middle;"><b><span id="result-1-time" style="font-size:140%;">&nbsp;</span></b></td>
		</tr>
		<tr id="row-2">
		    <td style="vertical-align:middle;"><span style="font-size:140%;">#2</span></td>
		    <td class="text-right" style="vertical-align:middle;"><b><span id="result-2-cooldown" style="font-size:140%;">&nbsp;</span></b></td>
		    <td class="text-center">
			<br>
			<input id="wait-2-input" style="display: inline;" onchange="recalc();" onkeyup="recalc();" type="range" min="0" max="0" step="1">
			    <span id="wait-2-min" class="pull-left text-muted"></span>
			    <span id="wait-2-value"></span>
			    <span id="wait-2-max" class="pull-right text-muted"></span>
		    </td>
		    <td class="text-right" style="vertical-align:middle;"><b><span id="result-2-fatigue-before" style="font-size:140%;">&nbsp;</span></b></td>
		    <td class="text-center">
			<br>
			<input id="distance-2-input" style="display: inline;" onchange="recalc();" onkeyup="recalc();" type="range" min="0" max="0" step="0.01">
			    <span id="distance-2-min" class="pull-left text-muted"></span>
			    <span id="distance-2-value"></span>
			    <span id="distance-2-max" class="pull-right text-muted"></span>
		    </td>
		    <td class="text-right" style="vertical-align:middle;"><b><span id="result-2-fatigue-after" style="font-size:140%;">&nbsp;</span></b></td>
		    <td class="text-right" style="vertical-align:middle;"><b><span id="result-2-time" style="font-size:140%;">&nbsp;</span></b></td>
		</tr>
		<tr id="row-3">
		    <td style="vertical-align:middle;"><span style="font-size:140%;">#3</span></td>
		    <td class="text-right" style="vertical-align:middle;"><b><span id="result-3-cooldown" style="font-size:140%;">&nbsp;</span></b></td>
		    <td class="text-center">
			<br>
			<input id="wait-3-input" style="display: inline;" onchange="recalc();" onkeyup="recalc();" type="range" min="0" max="0" step="1">
			    <span id="wait-3-min" class="pull-left text-muted"></span>
			    <span id="wait-3-value"></span>
			    <span id="wait-3-max" class="pull-right text-muted"></span>
		    </td>
		    <td class="text-right" style="vertical-align:middle;"><b><span id="result-3-fatigue-before" style="font-size:140%;">&nbsp;</span></b></td>
		    <td class="text-center">
			<br>
			<input id="distance-3-input" style="display: inline;" onchange="recalc();" onkeyup="recalc();" type="range" min="0" max="0" step="0.01">
			    <span id="distance-3-min" class="pull-left text-muted"></span>
			    <span id="distance-3-value"></span>
			    <span id="distance-3-max" class="pull-right text-muted"></span>
		    </td>
		    <td class="text-right" style="vertical-align:middle;"><b><span id="result-3-fatigue-after" style="font-size:140%;">&nbsp;</span></b></td>
		    <td class="text-right" style="vertical-align:middle;"><b><span id="result-3-time" style="font-size:140%;">&nbsp;</span></b></td>
		</tr>
		<tr id="row-4">
		    <td style="vertical-align:middle;"><span style="font-size:140%;">#4</span></td>
		    <td class="text-right" style="vertical-align:middle;"><b><span id="result-4-cooldown" style="font-size:140%;">&nbsp;</span></b></td>
		    <td class="text-center">
			<br>
			<input id="wait-4-input" style="display: inline;" onchange="recalc();" onkeyup="recalc();" type="range" min="0" max="0" step="1">
			    <span id="wait-4-min" class="pull-left text-muted"></span>
			    <span id="wait-4-value"></span>
			    <span id="wait-4-max" class="pull-right text-muted"></span>
		    </td>
		    <td class="text-right" style="vertical-align:middle;"><b><span id="result-4-fatigue-before" style="font-size:140%;">&nbsp;</span></b></td>
		    <td class="text-center">
			<br>
			<input id="distance-4-input" style="display: inline;" onchange="recalc();" onkeyup="recalc();" type="range" min="0" max="0" step="0.01">
			    <span id="distance-4-min" class="pull-left text-muted"></span>
			    <span id="distance-4-value"></span>
			    <span id="distance-4-max" class="pull-right text-muted"></span>
		    </td>
		    <td class="text-right" style="vertical-align:middle;"><b><span id="result-4-fatigue-after" style="font-size:140%;">&nbsp;</span></b></td>
		    <td class="text-right" style="vertical-align:middle;"><b><span id="result-4-time" style="font-size:140%;">&nbsp;</span></b></td>
		</tr>
		<tr id="row-5">
		    <td style="vertical-align:middle;"><span style="font-size:140%;">#5</span></td>
		    <td class="text-right" style="vertical-align:middle;"><b><span id="result-5-cooldown" style="font-size:140%;">&nbsp;</span></b></td>
		    <td class="text-center">
			<br>
			<input id="wait-5-input" style="display: inline;" onchange="recalc();" onkeyup="recalc();" type="range" min="0" max="0" step="1">
			    <span id="wait-5-min" class="pull-left text-muted"></span>
			    <span id="wait-5-value"></span>
			    <span id="wait-5-max" class="pull-right text-muted"></span>
		    </td>
		    <td class="text-right" style="vertical-align:middle;"><b><span id="result-5-fatigue-before" style="font-size:140%;">&nbsp;</span></b></td>
		    <td class="text-center">
			<br>
			<input id="distance-5-input" style="display: inline;" onchange="recalc();" onkeyup="recalc();" type="range" min="0" max="0" step="0.01">
			    <span id="distance-5-min" class="pull-left text-muted"></span>
			    <span id="distance-5-value"></span>
			    <span id="distance-5-max" class="pull-right text-muted"></span>
		    </td>
		    <td class="text-right" style="vertical-align:middle;"><b><span id="result-5-fatigue-after" style="font-size:140%;">&nbsp;</span></b></td>
		    <td class="text-right" style="vertical-align:middle;"><b><span id="result-5-time" style="font-size:140%;">&nbsp;</span></b></td>
		</tr>
		<tr id="row-6">
		    <td style="vertical-align:middle;"><span style="font-size:140%;">#6</span></td>
		    <td class="text-right" style="vertical-align:middle;"><b><span id="result-6-cooldown" style="font-size:140%;">&nbsp;</span></b></td>
		    <td class="text-center">
			<br>
			<input id="wait-6-input" style="display: inline;" onchange="recalc();" onkeyup="recalc();" type="range" min="0" max="0" step="1">
			    <span id="wait-6-min" class="pull-left text-muted"></span>
			    <span id="wait-6-value"></span>
			    <span id="wait-6-max" class="pull-right text-muted"></span>
		    </td>
		    <td class="text-right" style="vertical-align:middle;"><b><span id="result-6-fatigue-before" style="font-size:140%;">&nbsp;</span></b></td>
		    <td class="text-center">
			<br>
			<input id="distance-6-input" style="display: inline;" onchange="recalc();" onkeyup="recalc();" type="range" min="0" max="0" step="0.01">
			    <span id="distance-6-min" class="pull-left text-muted"></span>
			    <span id="distance-6-value"></span>
			    <span id="distance-6-max" class="pull-right text-muted"></span>
		    </td>
		    <td class="text-right" style="vertical-align:middle;"><b><span id="result-6-fatigue-after" style="font-size:140%;">&nbsp;</span></b></td>
		    <td class="text-right" style="vertical-align:middle;"><b><span id="result-6-time" style="font-size:140%;">&nbsp;</span></b></td>
		</tr>
		<tr id="row-7">
		    <td style="vertical-align:middle;"><span style="font-size:140%;">#7</span></td>
		    <td class="text-right" style="vertical-align:middle;"><b><span id="result-7-cooldown" style="font-size:140%;">&nbsp;</span></b></td>
		    <td class="text-center">
			<br>
			<input id="wait-7-input" style="display: inline;" onchange="recalc();" onkeyup="recalc();" type="range" min="0" max="0" step="1">
			    <span id="wait-7-min" class="pull-left text-muted"></span>
			    <span id="wait-7-value"></span>
			    <span id="wait-7-max" class="pull-right text-muted"></span>
		    </td>
		    <td class="text-right" style="vertical-align:middle;"><b><span id="result-7-fatigue-before" style="font-size:140%;">&nbsp;</span></b></td>
		    <td class="text-center">
			<br>
			<input id="distance-7-input" style="display: inline;" onchange="recalc();" onkeyup="recalc();" type="range" min="0" max="0" step="0.01">
			    <span id="distance-7-min" class="pull-left text-muted"></span>
			    <span id="distance-7-value"></span>
			    <span id="distance-7-max" class="pull-right text-muted"></span>
		    </td>
		    <td class="text-right" style="vertical-align:middle;"><b><span id="result-7-fatigue-after" style="font-size:140%;">&nbsp;</span></b></td>
		    <td class="text-right" style="vertical-align:middle;"><b><span id="result-7-time" style="font-size:140%;">&nbsp;</span></b></td>
		</tr>
		<tr id="row-8">
		    <td style="vertical-align:middle;"><span style="font-size:140%;">#8</span></td>
		    <td class="text-right" style="vertical-align:middle;"><b><span id="result-8-cooldown" style="font-size:140%;">&nbsp;</span></b></td>
		    <td class="text-center">
			<br>
			<input id="wait-8-input" style="display: inline;" onchange="recalc();" onkeyup="recalc();" type="range" min="0" max="0" step="1">
			    <span id="wait-8-min" class="pull-left text-muted"></span>
			    <span id="wait-8-value"></span>
			    <span id="wait-8-max" class="pull-right text-muted"></span>
		    </td>
		    <td class="text-right" style="vertical-align:middle;"><b><span id="result-8-fatigue-before" style="font-size:140%;">&nbsp;</span></b></td>
		    <td class="text-center">
			<br>
			<input id="distance-8-input" style="display: inline;" onchange="recalc();" onkeyup="recalc();" type="range" min="0" max="0" step="0.01">
			    <span id="distance-8-min" class="pull-left text-muted"></span>
			    <span id="distance-8-value"></span>
			    <span id="distance-8-max" class="pull-right text-muted"></span>
		    </td>
		    <td class="text-right" style="vertical-align:middle;"><b><span id="result-8-fatigue-after" style="font-size:140%;">&nbsp;</span></b></td>
		    <td class="text-right" style="vertical-align:middle;"><b><span id="result-8-time" style="font-size:140%;">&nbsp;</span></b></td>
		</tr>
		<tr id="row-9">
		    <td style="vertical-align:middle;"><span style="font-size:140%;">#9</span></td>
		    <td class="text-right" style="vertical-align:middle;"><b><span id="result-9-cooldown" style="font-size:140%;">&nbsp;</span></b></td>
		    <td class="text-center">
			<br>
			<input id="wait-9-input" style="display: inline;" onchange="recalc();" onkeyup="recalc();" type="range" min="0" max="0" step="1">
			    <span id="wait-9-min" class="pull-left text-muted"></span>
			    <span id="wait-9-value"></span>
			    <span id="wait-9-max" class="pull-right text-muted"></span>
		    </td>
		    <td class="text-right" style="vertical-align:middle;"><b><span id="result-9-fatigue-before" style="font-size:140%;">&nbsp;</span></b></td>
		    <td class="text-center">
			<br>
			<input id="distance-9-input" style="display: inline;" onchange="recalc();" onkeyup="recalc();" type="range" min="0" max="0" step="0.01">
			    <span id="distance-9-min" class="pull-left text-muted"></span>
			    <span id="distance-9-value"></span>
			    <span id="distance-9-max" class="pull-right text-muted"></span>
		    </td>
		    <td class="text-right" style="vertical-align:middle;"><b><span id="result-9-fatigue-after" style="font-size:140%;">&nbsp;</span></b></td>
		    <td class="text-right" style="vertical-align:middle;"><b><span id="result-9-time" style="font-size:140%;">&nbsp;</span></b></td>
		</tr>
	    </tbody>
	</table>
	<p><small>* Be aware that there is <b>no benefit</b> in waiting for fatigue to decay <b>below 10 minutes</b></small></p>
	<br>
    </div>
<!-- Content -->
    <div style="font-size:70%; position:fixed; bottom:1px; left:5px; z-index:23;">Based on the <a href="http://community.eveonline.com/news/dev-blogs/phoebe-travel-change-update/">CCP devblog</a> released 30.10.2014 17:19</div>
    <div style="font-size:70%; position:fixed; bottom:1px; right:5px; z-index:23;">Brought to you by <a href="http://evewho.com/pilot/kiu+Nakamura">kiu Nakamura</a> / <a href="http://evewho.com/alli/Brave+Collective">Brave Collective</a></div>

    <script type="text/javascript" src="js/jquery-2.2.0.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/bootstrap3-typeahead.min.js"></script>
    <script type="text/javascript" src="js/handlebars-v4.0.5.js"></script>
    <script type="text/javascript" src="js/jfc.js"></script>
    <script type="text/javascript">
        
var systems = new Bloodhound({
  datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
  queryTokenizer: Bloodhound.tokenizers.whitespace,
  prefetch: 'systems.json'
});

var suggestion = Handlebars.compile('<div><strong>{{name}}</strong><span class="region">({{additional}})</span></div>');

$('#start-1-input').typeahead(null, {
  name: 'start-name',
  display: 'name',
  highlight: true,
  source: systems,
    templates: {
    suggestion: suggestion
  }
});

$('#end-1-input').typeahead(null, {
  name: 'end-name',
  display: 'name',
  highlight: true,
  source: systems,
    templates: {
    suggestion: suggestion
  }
});

$('#test').typeahead(null, {
  name: 'end-name',
  display: 'name',
  highlight: true,
  source: systems,
    templates: {
    suggestion: suggestion
  }
});
</script>

</body>
</html>
