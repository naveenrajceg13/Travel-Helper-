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
          directionsRenderer.setPanel(document.getElementById("directionsPanel"));

          google.maps.event.addListener(directionsRenderer, 'directions_changed', function() {});       

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
 
            
            var service = new google.maps.DistanceMatrixService();
        service.getDistanceMatrix(
          {
            origins: [start],
            destinations: [end],
            travelMode: google.maps.TravelMode.DRIVING,
            unitSystem: google.maps.UnitSystem.METRIC,
            avoidHighways: false,
            avoidTolls: false
          }, callback);
		  service.getDistanceMatrix(
          {
            origins: [start],
            destinations: [end],
            travelMode: google.maps.TravelMode.WALKING,
            unitSystem: google.maps.UnitSystem.METRIC,
            avoidHighways: false,
            avoidTolls: false
          }, callbacks);
		   // if we used MaxMind for location, add attribution link
           
        }
function callback(response, status) {
        if (status != google.maps.DistanceMatrixStatus.OK) {
          alert('Error was: ' + status);
        } else {
          var origins = response.originAddresses;
          var destinations = response.destinationAddresses;
          var outputDiv = document.getElementById('directions');
         
          for (var i = 0; i < origins.length; i++) {
            var results = response.rows[i].elements;
            
            for (var j = 0; j < results.length; j++) {
              
              outputDiv.innerHTML +="<h3>"+origins[i]+"</h3>"+"to" +"<h3>"+ destinations[j]+"</h3>"
                  + " <h2>distance: " + results[j].distance.text +"</h2>"
                  + " <h2>when going in driving can reach in : " +results[j].duration.text +"</h2>";
				  break;
            }
          }
        }
      }
	  function callbacks(response, status) {
        if (status != google.maps.DistanceMatrixStatus.OK) {
          alert('Error was: ' + status);
        } else {
          var origins = response.originAddresses;
          var destinations = response.destinationAddresses;
          var outputDiv = document.getElementById('directions');
         
          for (var i = 0; i < origins.length; i++) {
            var results = response.rows[i].elements;
            
            for (var j = 0; j < results.length; j++) {
              
              outputDiv.innerHTML +="<h2>when going by walk can reach in : " +results[j].duration.text +"</h2>"+ "<br />";
				  break;
            }
          }
        }
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
  <div id="directions"></div>
  <div id="directionsPanel">
</form>
</body>
</hmtl>