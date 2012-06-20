<div id=insidePrime>
<div id=news>
<?php if($usercheck['groups'][0]['idGroups'] == "1"):?>
<a style="float:right;padding-top:20px;padding-right:10px;" href='<?=create_url("content/create")?>'>Lägg till nyhet</a>
<?php endif;?>
<h1 id=insidePrime>Nyheter</h1>




<?php if($contents != null):?>
  <?php foreach($contents as $val):?>
    <h3 id=insidePrime><?=esc($val['title'])?></h3>
    <p class='smaller-text silent'><em id=insidePrime>Posted on <?=$val['created']?> by <?=$val['owner']?>
    <a id=insidePrime href='<?=create_url("page/view/{$val['id']}")?>'>view</a></em></p>
    <h1> </h1>
  <?php endforeach; ?>
<?php else:?>
  <p>No pages exists.</p>
<?php endif;?>
</div>
</div>
