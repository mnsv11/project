<?php if($contents != null):?>

  <?php foreach($contents as $val):?>
  <div id=view>
    <h2><?=esc($val['title'])?></h2>
    
    <p class='smaller-text'><em>Posted on <?=$val['created']?> by <?=$val['owner']?></em></p>
    	<p><?=filter_data($val['data'], $val['filter'])?></p>
    </div> 
    <p class='smaller-text silent'><a href='<?=create_url("content/edit/{$val['id']}")?>'>edit</a>
    <class='smaller-text silent'><a href='<?=create_url("page")?>'>back</a></p>
  <?php endforeach; ?>

<?php else:?>
  <p>404: No such page exists.</p>
<?php endif;?>
<p>Pages, <a href='<?=create_url("content")?>'>view all content</a>.</p>

