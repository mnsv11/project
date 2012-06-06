<div id=indexNews>
<h5 id=indexNews>Senaste nyheten</h5>
<?php print_r($contents[0]['title']);?>
<br>
<?php print_r($contents[0]['created']);?>
<br>
<class='smaller-text silent'><a href='<?=create_url("page/view/{$contents[0]['id']}")?>'>view</a>
</div>
