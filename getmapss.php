<?
$pla=$_POST['getpla'];
$google_maps_key='AIzaSyB3jnKqrlQGDGtVOyruG1gDrDsLj8TcT6g';
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
var directionDisplay;
	var directionsService = new google.maps.DirectionsService();
	function initialize() {
		var latlng = new google.maps.LatLng(51.764696,5.526042);
		directionsDisplay = new google.maps.DirectionsRenderer();
		var myOptions = {
			zoom: 14,
			center: latlng,
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			mapTypeControl: false
		};
		var map = new google.maps.Map(document.getElementById("map_canvas"),myOptions);
		directionsDisplay.setMap(map);
		directionsDisplay.setPanel(document.getElementById("directionsPanel"));
		var marker = new google.maps.Marker({
			position: latlng, 
			map: map, 
			title:"Van Dijk Bouw & Techniek"
		}); 
	}
	function calcRoute() {
		var start = document.getElementById("routeStart").value;
		var end = "51.764696,5.526042";
		var request = {
			origin:start,
			destination:end,
			travelMode: google.maps.DirectionsTravelMode.DRIVING
		};
		directionsService.route(request, function(response, status) {
			if (status == google.maps.DirectionsStatus.OK) {
				directionsDisplay.setDirections(response);
			} else {
				if (status == 'ZERO_RESULTS') {
					alert('No route could be found between the origin and destination.');
				} else if (status == 'UNKNOWN_ERROR') {
					alert('A directions request could not be processed due to a server error. The request may succeed if you try again.');
				} else if (status == 'REQUEST_DENIED') {
					alert('This webpage is not allowed to use the directions service.');
				} else if (status == 'OVER_QUERY_LIMIT') {
					alert('The webpage has gone over the requests limit in too short a period of time.');
				} else if (status == 'NOT_FOUND') {
					alert('At least one of the origin, destination, or waypoints could not be geocoded.');
				} else if (status == 'INVALID_REQUEST') {
					alert('The DirectionsRequest provided was invalid.');					
				} else {
					alert("There was an unknown error in your request. Requeststatus: \n\n"+status);
				}
			}
		});
	}
}
</script>
</head>
<body onLoad="initialize()"><iframe src="https://www.facebook.com/plugins/like.php?href=http://localhost/login/logsuc.html"
        scrolling="no" frameborder="0"
        style="border:none; width:450px; height:80px"></iframe>
	<h1>Google maps API demo</h1>
	<div id="map_canvas" style="width:100%; height:300px"></div>		
	<form onSubmit="calcRoute();return false;" id="routeForm">
		<input type="text" id="routeStart" value="">
		<input type="submit" value="Calculate route">
	</form>
	<div id="directionsPanel">
		Enter a destination and click "Calculate route".
	</div>
</body>

</body
</hmtl>