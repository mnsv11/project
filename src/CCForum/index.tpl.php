<div id=insidePrime>
<h2>Forum</h2>
<div style='background-color:#C7C7C7;border:3px groove #ccc;width:95%'>
<h4 style='text-align:center; margin-top:10px;'>Gäster</h4>
</div>



<?php if($forum != null):?>
<?php $check = false;?>
  <?php foreach($forum as $val):?>
  <?php if($val['key'] == "gäster"):?>
  <div style='background-color:#f6f6f6;border:1px solid #ccc;padding-top:10px;width:95.2%;'>
  <table id=forum>
  <tr>
  <th id=forumThIm><img  style="height:50px; width: 67px;" src="http://www.student.bth.se/~mnsv11/project/site/themes/mytheme/wheel.png" alt=""></th>
    <th id=forum><h4><a href='<?=create_url("forum/view/{$val['id']}")?>'><?=esc($val['title'])?></a></h4></th>
    <th id=forum><p class='smaller-text'><em>Skapat: <?=$val['created']?> by <?=$val['owner']?></em></p></th>
    <?php $count= 0;
    	foreach($entry as $check)
    	{
    		if($check['key'] == $val['id'] && $check['deleted'] == "")
    		{
    			$count++;		
    		}
    	}
    ?>
    <th id=forumTh><p class='smaller-text'><em><?=$count;?> Trådar</em></p></th>
    </tr>
    </table>
    </div>
  <?php endif;?>
  <?php if($val['key'] == "medlem"){
  	 $check = true; }
  	 endforeach; 
  if($usercheck['acronym']):
  	 if($check == true):?>
  	
  	 <div style='background-color:#C7C7C7;margin-top:1em; border:3px groove #ccc;width:95%'>
	<h4 style='text-align:center; margin-top:10px;'>Medlemmar</h4>
	</div>
  	
  	 <?php endif;?>
  
  <?php foreach($forum as $val):?>
  
	  <?php if($val['key'] == "medlem"):?>
	  <div style='background-color:#f6f6f6;border:1px solid #ccc;padding-top:10px;width:95.2%'>
	    <table id=forum>
	    <tr>
	    <th id=forumThIm><img  style="height:50px; width: 67px;" src="http://www.student.bth.se/~mnsv11/project/site/themes/mytheme/wheel.png" alt=""></th>
	    <th id=forum><p><h4><a href='<?=create_url("forum/view/{$val['id']}")?>'><?=esc($val['title'])?></a></h4></p></th>
	    <th id=forum><p class='smaller-text'><em>Skapat: <?=$val['created']?> by <?=$val['owner']?></em></p></th>
	        <?php $count= 0;
    	foreach($entry as $check)
    	{
    		if($check['key'] == $val['id'] && $check['deleted'] == "")
    		{
    			$count++;		
    		}
    	}
    ?>
    <th id=forumTh><p class='smaller-text'><em><?=$count;?> Trådar</em></p></th>
	    </tr>
	    </table>
	    </div>
	  <?php endif;?>
   
  <?php endforeach; ?>
  
   <?php endif;?>
  <?php if($usercheck['groups'][0]['idGroups'] == "1"):?>
	  <h1 style="width:95%"> </h1>
	  <p>Skapa ny kategori, klicka i "rutan" om gäster skall ha tillgång.</p>

	  <?=$form->GetHTML()?>
  <?php endif;?>
<?php else:?>
  <p>No pages exists.</p>
<?php endif;?>


</div>
