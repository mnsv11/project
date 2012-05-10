<h1>Pages</h1>


<?php if($contents != null):?>
  <?php foreach($contents as $val):?>
    <h2><?=esc($val['title'])?></h2>
    <p class='smaller-text'><em>Posted on <?=$val['created']?> by <?=$val['owner']?></em></p>
  
    <class='smaller-text silent'><a href='<?=create_url("page/view/{$val['id']}")?>'>view</a></p>
    <h1> </h1>
  <?php endforeach; ?>
<?php else:?>
  <p>No pages exists.</p>
<?php endif;?>
<p>Pages, <a href='<?=create_url("content")?>'>view all content</a>.</p>
