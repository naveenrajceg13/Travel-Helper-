<?
$pla=$_POST['source'];
$google_maps_key='ABQIAAAAWIiGwZ4f3ncw4oQSuvUPrBSFwycF0SlTyEowikYlS8xDoCzQghQyGAIqzHZ5BYsm1feFl-%20x_mSfC9g';
$adr = urlencode($pla);
$url = "http://maps.google.com/maps/geo?q=".$adr."&output=xml&key=$google_maps_key";
$xml = simplexml_load_file($url);
$status = $xml->Response->Status->code;
if ($status='200') 
{ 
foreach ($xml->Response->Placemark as $node) { 
$address = $node->address;
$quality = $node->AddressDetails['Accuracy'];
$coordinates = $node->Point->coordinates;
$string = $coordinates;
$tok = strtok($string,",");
    $lati=$tok;
    $tok=strtok(",");
	$long=$tok;
	$tok=strtok(",");
}
}
?>
<?
$pla=$_POST['dest'];
$google_maps_key='ABQIAAAAWIiGwZ4f3ncw4oQSuvUPrBSFwycF0SlTyEowikYlS8xDoCzQghQyGAIqzHZ5BYsm1feFl-%20x_mSfC9g';
$adr = urlencode($pla);
$url = "http://maps.google.com/maps/geo?q=".$adr."&output=xml&key=$google_maps_key";
$xml = simplexml_load_file($url);
$status = $xml->Response->Status->code;
if ($status='200') 
{ 
foreach ($xml->Response->Placemark as $node) { 
$address = $node->address;
$quality = $node->AddressDetails['Accuracy'];
$coordinates = $node->Point->coordinates;
$string = $coordinates;
$tok = strtok($string,",");
    $latis=$tok;
    $tok=strtok(",");
	$longs=$tok;
	$tok=strtok(",");
}
}
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
var map;
var directionsRenderer;
var directionsService = new google.maps.DirectionsService();
function initialize() {

        var myOptions = {
          center: new google.maps.LatLng(13.0082897,80.2349889),
          zoom: 12,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById("map_canvas"),
            myOptions);
		directionsRenderer = new google.maps.DirectionsRenderer();
	    
        directionsRenderer.setMap(map);
       

		 var lat=document.getElementById('lati').value;
        var lon=document.getElementById('long').value;
		var lats=document.getElementById('latis').value;
        var lons=document.getElementById('longs').value;
        // Use our new getLatLng with fallback and define an inline function to
        // handle the callback.
       
            var start = new google.maps.LatLng(lon,lat);
 
            // get the address the user entered
            
                // set end point
				
                var end = new google.maps.LatLng(lons,lats);
 
                // set the request options
                var request = {
                    origin: start,
                    destination: end,
                    travelMode: google.maps.DirectionsTravelMode.DRIVING
                };
 
                // make the directions request
				
                directionsService.route(request, function (result, status) {
				
                    if (status == google.maps.DirectionsStatus.OK) {

                        // Display the directions using Google's Directions
                        // Renderer.
                        directionsRenderer.setDirections(result);
 
                        // output total distance separately
 
 
                    } else {
                        error("Directions failed due to: " + status);
                    }
                });
 
            
            
            // if we used MaxMind for location, add attribution link
           
        }
</script>
</head>
<body>
<body onload="initialize()">
 <iframe src="https://www.facebook.com/plugins/like.php?href=http://localhost/login/logsuc.html"
        scrolling="no" frameborder="0"
        style="border:none; width:450px; height:80px"></iframe>
  <input type='hidden' name='lati' id='lati' value=<? echo $lati ?> />
  <input type='hidden' name='long' id='long' value=<? echo $long ?> />
  <input type='hidden' name='latis' id='latis' value=<? echo $latis ?> />
  <input type='hidden' name='longs' id='longs' value=<? echo $longs ?> />
 <div id="map_canvas" style="width:100% height:100%"></div>
  <div id="mydiv"></div>

</form>
</body>
</hmtl>