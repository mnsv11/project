<div id=insidePrime>
<h1 id=insidePrime>Nyheter</h1>
<?php if($usercheck['groups'][0]['idGroups'] == "1"):?>
<p><a id=insidePrime href='<?=create_url("content/create")?>'>Lägg till nyhet</a></p>
<?php endif;?>

<?php if($contents != null):?>
  <?php foreach($contents as $val):?>
    <h2 id=insidePrime><?=esc($val['title'])?></h2>
    <p class='smaller-text'><em id=insidePrime>Posted on <?=$val['created']?> by <?=$val['owner']?></em></p>
  
    <class='smaller-text silent'><a id=insidePrime href='<?=create_url("page/view/{$val['id']}")?>'>view</a></p>
    <h1> </h1>
  <?php endforeach; ?>
<?php else:?>
  <p>No pages exists.</p>
<?php endif;?>
</div>

