<div id=insidePrime>
<?php if($forum['id']):?>
<h2>Trådar</h2>

<div style='background-color:#c7c7c7;border:1px solid #ccc;padding:10px;width:94%;'>
<h4 style='text-align:center; margin-top:10px;'><?php echo $forum['title'];?></h4>   
</div>
<div style='background-color:#f6f6f6;border:1px solid #ccc;padding:10px;width:94%;'>
<p><?=filter_data($forum['data'], $forum['filter'])?></p>
<p class='smaller-text'><em>Skapat: <?=$forum['created']?> by <?=$forum['owner']?></em></p>
</div>

<?php if($entries != null):?>


<?php foreach($entries as $val):?>
<?php if($forum['id']==$val['key'] && $val['deleted'] == ""):?>
	<div style='background-color:#f6f6f6;border:1px solid #ccc;padding:10px;width:94%;'>
	
	  <p><?=filter_data($val['data'], $val['filter'])?></p></p>
	  <p class='smaller-text'><em>Skapat: <?=$val['created']?> by <?=$val['owner']?></em>
	  
	  <?php if($val['idUser'] != 1 && $usercheck['acronym'] == $val['owner'] || $usercheck['groups'][0]['idGroups'] == 1):?>
	  <a style="float:right;" href='<?=create_url("forum/remove/{$val['id']}")?>'>Ta bort</a></p>
	  <?php endif;?>
	  
	</div>
<?php endif;?>
<?php endforeach;?>

<h1 style="width:95%;margin-top:15px;"> </h1>

  
<?php else:?>
  <p>No pages exists.</p>
<?php endif;?>
<p><a href='<?=create_url("forum/create/{$forum['id']}")?>'>Gör ett inlägg</a>
<a href='<?=create_url("forum/view/{$forum['key']}")?>'>Tillbaka</a></p></p>
<?php endif;?>
</div>
