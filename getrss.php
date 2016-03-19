<?php
//get the q parameter from URL
$q=$_POST['group1'];
?>
<html>
<body>
<iframe src="https://www.facebook.com/plugins/like.php?href=http://localhost/login/logsuc.html"
        scrolling="no" frameborder="0"
        style="border:none; width:450px; height:80px"></iframe>
<form action="logsuc.html" method="post">
<h3>click main to go to main page again </h3>
<input type='submit' name='Submit' value='main' />
</form>

<?php
//find out which feed was selected
$xml=("http://feeds.feedburner.com/NDTV-Cricket?format=xml");
if($q=="top")
  {  ?>
   <h1>top stories today </h1>
    <?
  $xml=("http://feeds.feedburner.com/NdtvNews-TopStories?format=xml");
  }
elseif($q=="cricket")
  {
     ?>
   <h1>cricket news today </h1>
    <?
  $xml=("http://feeds.feedburner.com/NDTV-Cricket?format=xml");
  }
  elseif($q=="india")
  {
      ?>
   <h1>india top stories today </h1>
    <?
  $xml=("http://feeds.feedburner.com/ndtv/Lsgd?format=xml");
  }
  elseif($q=="tech")
  {
    ?>
   <h1>technonogy news today </h1>
    <?
  $xml=("http://feeds.feedburner.com/NDTV-Tech?format=xml");
  }
   elseif($q=="movies")
  {
    ?>
   <h1>movies stories today </h1>
    <?
  $xml=("http://feeds.feedburner.com/NDTV-Ent?format=xml");
  }
   elseif($q=="cities")
  {
    ?>
   <h1>cities stories today </h1>
    <?
  $xml=("http://feeds.feedburner.com/NdtvNews-Cities?format=xml");
  }
  
$xmlDoc = new DOMDocument();
$xmlDoc->load($xml);

//get elements from "<channel>"
$channel=$xmlDoc->getElementsByTagName('channel')->item(0);
$channel_title = $channel->getElementsByTagName('title')
->item(0)->childNodes->item(0)->nodeValue;
$channel_link = $channel->getElementsByTagName('link')
->item(0)->childNodes->item(0)->nodeValue;
$channel_desc = $channel->getElementsByTagName('description')
->item(0)->childNodes->item(0)->nodeValue;

//output elements from "<channel>"
echo("<p><a href='" . $channel_link
  . "'>" . $channel_title . "</a>");
echo("<br />");
echo($channel_desc . "</p>");

//get and output "<item>" elements
$x=$xmlDoc->getElementsByTagName('item');
for ($i=0; $i<=20; $i++)
  {
  $item_title=$x->item($i)->getElementsByTagName('title')
  ->item(0)->childNodes->item(0)->nodeValue;
  $item_link=$x->item($i)->getElementsByTagName('link')
  ->item(0)->childNodes->item(0)->nodeValue;
  $item_desc=$x->item($i)->getElementsByTagName('description')
  ->item(0)->childNodes->item(0)->nodeValue;

  echo ("<p><a href='" . $item_link
  . "'>" . $item_title . "</a>");
  echo ("<br />");
  echo ($item_desc . "</p>");
  }
?>
</body>
</html>