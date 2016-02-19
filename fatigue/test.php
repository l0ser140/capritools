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
    
    <link rel="stylesheet" href="/fatigue/css/bootstrap.min.css">
    <?php include("../switcher.php"); ?>
    <link rel="stylesheet" href="/fatigue/css/custom.css">
    <link href="/fatigue/css/typeahead.css" rel="stylesheet" type="text/css"/>
</head>

<script src="js/jquery-2.2.0.min.js" type="text/javascript"></script>
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<script src="js/typeahead.bundle.js" type="text/javascript"></script>
<script src="js/handlebars-v4.0.5.js" type="text/javascript"></script>

<body>
    
<div class="container">
            <div id="the-basics">
              <input id="test" class="form-control typeahead" type="text" placeholder="States of USA">
            </div>
</div>
    
<script type="text/javascript">
       var systems = new Bloodhound({
          datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
          queryTokenizer: Bloodhound.tokenizers.whitespace,
          prefetch: 'systems.json'
        });

        var suggestion = Handlebars.compile('<div><strong>{{name}}</strong><span class="region">({{additional}})</span></div>');

        $('#start-1-input').typeahead(null, {
          name: 'end-name',
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