<div id=insidePrime>
<h2>Trådar</h2>

<div style='background-color:#C7C7C7;border:1px solid #ccc;width:95%'>
<h4 style='text-align:center; margin-top:10px;'><?php echo $forum['title'];?></h4>
</div>
<?php if($entries != null):?>
  <?php foreach($forum as $val):?>

<?php foreach($entries as $val):?>
  <?php if($val['key'] == $forum['id']):?>
<div style='background-color:#f6f6f6;border:1px solid #ccc;margin-bottom:1em;padding-top:10px;width:95%'>
<table id=forum>
  <tr>
  	<th id=forumTh><img style="height:50px; width: 67px;margin-left:15px;" src="http://www.student.bth.se/~mnsv11/project/site/themes/mytheme/wheel.png" alt=""></th>
  	<th id=forum><h4><a href='<?=create_url("forum/ViewThread/{$val['id']}")?>'><?=htmlent($val['title'])?></a></h4>
  	<th id=forum><p class='smaller-text'><em>Skapat: <?=$val['created']?> by <?=$val['owner']?></em></p>
  	    <?php $count= 1;
    	foreach($entries as $check)
    	{
    		if($check['key'] == $val['id'] && $check['deleted'] == "")
    		{
    			$count++;		
    		}
    	}
    ?>
    <th id=forumTh><p class='smaller-text'><em><?=$count;?> Inlägg</em></p></th>
    
  </tr>
</table>
</div>
  <?php endif;?>
<?php endforeach;?>
  
    
    <h1 style="width:95%"> </h1>
  <?php endforeach; ?>
  
<?php else:?>
  <p>No pages exists.</p>
<?php endif;?>
<p><a href='<?=create_url("forum/CreateThread/{$forum['id']}")?>'>Lägg till ny tråd</a>.</p>
</div>



