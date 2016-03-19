<?php
   $lati=$_POST['lati'];
   $long=$_POST['long'];       
?>
<html>
<head>
  <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<style type="text/css">
      html { height: 100% }
      body { height: 100%; margin: 0; padding: 0 }
      #map_canvas { height: 100% }
    </style>
<script type="text/javascript" 
src="http://maps.googleapis.com/maps/api/js?key=AIzaSyB3jnKqrlQGDGtVOyruG1gDrDsLj8TcT6g&sensor=false">
</script>
<script type="text/javascript">

function initialize() {
        var lat=document.getElementById('lati').value;
        var lon=document.getElementById('long').value;
        window.parseInt(lat);
        window.parseInt(lon);
        var myOptions = {
          center: new google.maps.LatLng(lon,lat),
          zoom: 18,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById("map_canvas"),
            myOptions);
}
</script>
</head>
<body>
<body onload="initialize()">
  <input type='hidden' name='lati' id='lati' value=<? echo $lati ?> />
  <input type='hidden' name='long' id='long' value=<? echo $long ?> />
  <div id="map_canvas" style="width:100% height:100%"></div>
  <div id="mydiv"></div>
<iframe src="https://www.facebook.com/plugins/like.php?href=http://localhost/login/logsuc.html"
        scrolling="no" frameborder="0"
        style="border:none; width:450px; height:80px"></iframe>
</body>
</hmtl>