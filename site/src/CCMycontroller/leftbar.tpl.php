<br>
<h3>Nyheter från </h3>
<p>
<img src=<?=$img?> width="200" height="40" alt="Huset" border="0">
</p>
<meta http-equiv="refresh" content="300" >

<?php $xml = simplexml_load_file("http://www.svmc.se/Templates/SvMC/Rss/RssHandler.ashx?rssid=125");


//print_r($xml);
$count = 0;
'<div>';
foreach ($xml->channel->item as $item) :
if($count < 10){?>

<a href='<?=$xml->channel->item[$count]->link?>' target= _blank>'<?=$xml->channel->item[$count]->title?>'</a>
<div id=date><?=$xml->channel->item[$count]->pubDate?></div>
<br>

<?php $count++;
}
endforeach;
'</div>';
?>

