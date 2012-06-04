<div id=insidePrime>
<?php if($forum['created']): ?>
  <h1>Nytt inlägg</h1>

<?php else: ?>
  <h1>Ny tråd</h1>
<?php endif; ?>

<?=$form->GetHTML(array('class'=>'forum-edit'))?>

<p class='smaller-text'><em>
<?php if($forum['created']): ?>
  Denna tråd var skapad <?=$forum['owner']?> <?=time_diff($forum['created'])?> ago.
<?php else: ?>
  Tråd inte skapat än.
<?php endif; ?>

<?php if(isset($forum['updated'])):?>
  Senast uppdaterat <?=time_diff($forum['updated'])?> ago.
<?php endif; ?>
</em></p>
</div>




