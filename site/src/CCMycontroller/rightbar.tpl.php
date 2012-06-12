<div id=insidePrime>
<div style="float:left;margin-right:60px;margin-left:10px;width:220px;">
<br>
<br><p>
<img style="padding-top:10px;" src=<?=$img?> width="190" height="50" alt="logo" border="0">
</p>


<?php $xml = simplexml_load_file("http://www.webbikeworld.com/motorcycles/rss.xml");
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
</div>
</div>
