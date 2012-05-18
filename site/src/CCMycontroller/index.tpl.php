<H3 id=indexNews>Välkommen till en sida för oss som gillar Suzuki sporthojar</h3>
<div id=indexNews>
<h5 id=indexNews>Senaste nyheten</h5>
<?php print_r($contents[0]['title']);?>
<br>
<?php print_r($contents[0]['created']);?>
<br>
<class='smaller-text silent'><a href='<?=create_url("page/view/{$contents[0]['id']}")?>'>view</a>
</div>
<p>
<img id=indexNews src=<?=$img?> width="500" height="330" alt="Mc" border="0">

</p> 

