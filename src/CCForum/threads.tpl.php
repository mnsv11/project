<div id=insidePrime>
<div style="margin-bottom:10px;">
	<h2 style="float:left;width:150px;">Trådar</h2>
	
	<div style="float:left">
		<img  style="height:50px; width: 67px;"src="http://www.student.bth.se/~mnsv11/project/site/themes/mytheme/wheel.png" alt="Icon">
		<h3 style="float:left;margin-right:5px;padding-top:12px;">Besökta</h3>
	</div>
	
	
	<div>
		<img  style="height:50px; width: 67px;"src="http://www.student.bth.se/~mnsv11/project/site/themes/mytheme/wheelRed.png" alt="Icon">
		<h3 style="float:left;margin-left:15px;padding-top:12px;"> Ej besökta</h3>
	</div>
</div>

<div style='background-color:#C7C7C7;border:3px groove #ccc;width:95%'>
<h4 style='text-align:center; margin-top:10px;'><?php echo $forum['title'];?></h4>
</div>
<?php if($entries != null):?>
  <?php foreach($forum as $val):?>

<?php foreach($entries as $val):?>
  <?php if($val['key'] == $forum['id'] && $val['deleted'] == ""):?>
  
  <?php
  	$checkVisit = false;
  	if($usercheck){
  	
  	foreach($visit as $v){
  		if($v['thread'] == $val['id']){
  			$checkVisit = true;
  		}
  	}
  	}
  	if($checkVisit == true || $usercheck ==""){
  	
  		$visited = "http://www.student.bth.se/~mnsv11/project/site/themes/mytheme/wheel.png";
  	}
  	else
  	{
  		$visited = "http://www.student.bth.se/~mnsv11/project/site/themes/mytheme/wheelRed.png";
  	}
  ?>
  
<div style='background-color:#f6f6f6;border:1px solid #ccc;padding-top:10px;width:95.2%'>
<table id=forum>
  <tr>
  	<th id=forumTh><img style="height:50px; width: 67px;" src=<?=$visited?> alt=""></th>
  	<th id=forum><h4><a href='<?=create_url("forum/ViewThread/{$val['id']}")?>'><?=htmlent($val['title'])?></a></h4>
  	<th id=forum><p class='smaller-text'><em><?php if($val['updated']==""):?>Skapat:<?=$val['created']?><?php else:?>Uppdaterad:<?=$val['updated']?><?php endif;?> by <?=$val['owner']?></em></p>
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


<input style="border-radius: 10px" type="button" value="tillbaka" onClick="top.location='<?=create_url("forum")?>'">
<?php if($usercheck['groups'][0]['idGroups'] != ""):?>
<input style="border-radius: 10px" type="button" value="Lägg till ny tråd" onClick="top.location='<?=create_url("forum/CreateThread/{$forum["id"]}")?>'">
<?php endif;?>


</div>



