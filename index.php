<html>
<?php 

  function getTemp($city, $state)
  {
    $json_string = file_get_contents("http://api.wunderground.com/api/ce5c27225aa3c267/geolookup/conditions/q/" . $state . "/" . $city . ".json");
    $parsed_json = json_decode($json_string);
    $location = $parsed_json->{'location'}->{'city'};
    $url = $parsed_json->{'current_observation'}->{'icon_url'};
    $temp_f = $parsed_json->{'current_observation'}->{'temp_f'};
    return Array((float)($temp_f), $url);
  }
  $maggie = getTemp("Carrboro","NC");
  $keith = getTemp("Madison","WI");
  $ellie = getTemp("Needham","MA");

  $min = $maggie[0];
  $minName = "maggie";
  if($keith[0] < $min)
  {
    $min = $keith[0];
    $minName = "keith";
  }
  if($ellie[0] < $min)
  {
    $min = $ellie[0];
    $minName = "ellie";
  }

?>
  <head>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
      function init()
      {
      document.getElementById("<?= $minName ?>").style.color = "blue";
      }
    </script>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <title>which kid is coldest?</title>
  </head>
  <body onload="init();">
    <div class="container text-center">
      <div class="row">
        <h1><?= $minName ?> is the coldest :'(</h1>
      </div>
      <div class="row">
        <div class="col-md-4" id="maggie">
          <div class="row">
            <h1>maggie</h1>
          </div>
          <div class="row">
            <h1><?= $maggie[0] ?>&deg;</h1>
          </div>
          <div class="row">
            <img src="<?= $maggie[1] ?>">
          </div>
        </div>
        <div class="col-md-4" id="keith">
          <div class="row">
            <h1>keith</h1>
          </div>
          <div class="row">
            <h1><?= $keith[0] ?>&deg;</h1>
          </div>
          <div class="row">
            <img src="<?= $keith[1] ?>">
          </div>
        </div>
        <div class="col-md-4" id="ellie">
          <div class="row">
            <h1>ellie</h1>
          </div>
          <div class="row">
            <h1><?= $ellie[0] ?>&deg;</h1>
          </div>
          <div class="row">
            <img src="<?= $ellie[1] ?>">
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
