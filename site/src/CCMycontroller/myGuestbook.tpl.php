<div id=insidePrime>
<div id=guestBook>
<h1>Gästbok</h1>

<?=$form->GetHTML();?>

<h2>Latest messages</h2>

<?php foreach($entries as $val):?>
<div style='background-color:#f6f6f6;border:1px solid #ccc;margin-bottom:1em;padding:1em;width:100%;'>
  <p>At: <?=$val['created']?></p>
  <p><?=htmlent($val['entry'])?></p>
</div>
<?php endforeach;?>
</div>
</div>                            
