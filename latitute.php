<?
$google_maps_key='AIzaSyB3jnKqrlQGDGtVOyruG1gDrDsLj8TcT6g';
$adr = urlencode("anna university,chennai");
$url = "http://maps.google.com/maps/geo?q=".$adr."&output=xml&key=$google_maps_key";
$xml = simplexml_load_file($url);
$status = $xml->Response->Status->code;
if ($status='200') 
{ 
foreach ($xml->Response->Placemark as $node) { 
$address = $node->address;
$quality = $node->AddressDetails['Accuracy'];
$coordinates = $node->Point->coordinates;
echo ("Quality: $quality. $address. $coordinates<br/>");
}
?>
<hmtl>
<head>
</head>
<body>
<p><h1> <?php echo $coordinates ?></p></h1>
</body>
</html>
<?
} else { // address couldn't be geocoded show error message
echo ("The address $adr could not be geocoded<br/>");
}
$myFile = "new.txt";
$fh = fopen($myFile, 'w') or die("can't open file");
fwrite($fh, $coordinates);
fclose($fh);
?>
