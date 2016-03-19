<?
$pla=$_POST['getpla'];
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
<html>
<head>
<title>get place</title>
</head>
<body>

<form action="http://localhost/login/getmap.php" method="post">
<p>place :<input type='text' name='place' id='place' value=<? echo $pla ?> /></p>
<p>latitude :<input type='text' name='lati' id='lati' value= <? echo $lati ?> /></p>
<p>longitude :<input type='text' name='long' id='long' value= <? echo $long ?> /></p>
<b>click submit to go to the main page </b>
<input type='submit' name='getplace' value='get place in map' />
<iframe src="https://www.facebook.com/plugins/like.php?href=http://localhost/login/logsuc.html"
        scrolling="no" frameborder="0"
        style="border:none; width:450px; height:80px"></iframe>
</form>
</body>
</html>