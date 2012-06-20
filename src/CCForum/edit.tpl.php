<div id=insidePrime>
<div id=forum>
<script type="text/javascript" src="../../src/CCForum/jscolor/jscolor.js"></script>
<?php if($forum['type'] == "tråd"): ?>
	<?php if($title== "Edit"):?>
		<h1>Editera</h1>
	<?php else:?>
		<h1>Nytt inlägg</h1>
	<?php endif; ?>	
  <?php $top=50;?>

<?php elseif($forum['data'] == ""): ?>
  <h1>Ny tråd</h1>
  <?php $top=115;?>
  
<?php endif; ?>


<script type="text/javascript">
function addText(text){
document.getElementById('form-element-data').value += text;
}
</script>
<div style="float:right;margin-top:<?=$top?>px;margin-right:150px;width:90px;">
<a href="#" onClick="addText(':)')"><img border="0" src="../../site/themes/mytheme/icon_smile.gif"  width="18" height="18" /></a>
<a href="#" onClick="addText(':D')"><img border="0" src="../../site/themes/mytheme/icon_biggrin.gif"  width="18" height="18" /></a>
<a href="#" onClick="addText(':(')"><img border="0" src="../../site/themes/mytheme/icon_sad.gif"  width="18" height="18" /></a>
<a href="#" onClick="addText(':o')"><img border="0" src="../../site/themes/mytheme/icon_surprised.gif"  width="18" height="18" /></a>
<a href="#" onClick="addText(':|')"><img border="0" src="../../site/themes/mytheme/icon_neutral.gif"  width="18" height="18" /></a>
<a href="#" onClick="addText(';)')"><img border="0" src="../../site/themes/mytheme/icon_wink.gif"  width="18" height="18" /></a>
<a href="#" onClick="addText(':cry:')"><img border="0" src="../../site/themes/mytheme/icon_cry.gif"  width="18" height="18" /></a>
<a href="#" onClick="addText(':roll:')"><img border="0" src="../../site/themes/mytheme/icon_rolleyes.gif"  width="18" height="18" /></a>
<a href="#" onClick="addText('8O')"><img border="0" src="../../site/themes/mytheme/icon_eek.gif"  width="18" height="18" /></a>
<a href="#" onClick="addText(':x')"><img border="0" src="../../site/themes/mytheme/icon_mad.gif"  width="18" height="18" /></a>
<a href="#" onClick="addText(':?')"><img border="0" src="../../site/themes/mytheme/icon_confused.gif"  width="18" height="18" /></a>
<a href="#" onClick="addText(':p')"><img border="0" src="../../site/themes/mytheme/icon_razz.gif"  width="18" height="18" /></a>
<a href="#" onClick="addText(':oops:')"><img border="0" src="../../site/themes/mytheme/icon_redface.gif"  width="18" height="18" /></a>
<a href="#" onClick="addText('8)')"><img border="0" src="../../site/themes/mytheme/icon_cool.gif"  width="18" height="18" /></a>
<a href="#" onClick="addText(':evil:')"><img border="0" src="../../site/themes/mytheme/icon_evil.gif"  width="18" height="18" /></a>
<a href="#" onClick="addText(':twisted:')"><img border="0" src="../../site/themes/mytheme/icon_twisted.gif"  width="18" height="18" /></a>
<a href="#" onClick="addText(':!:')"><img border="0" src="../../site/themes/mytheme/icon_exclaim.gif"  width="18" height="18" /></a>
<a href="#" onClick="addText(':idea:')"><img border="0" src="../../site/themes/mytheme/icon_idea.gif"  width="18" height="18" /></a>
<a href="#" onClick="addText(':arrow:')"><img border="0" src="../../site/themes/mytheme/icon_arrow.gif"  width="18" height="18" /></a>
<a href="#" onClick="addText(':mrgreen:')"><img border="0" src="../../site/themes/mytheme/icon_mrgreen.gif"  width="18" height="18" /></a>
</div>


<?=$form->GetHTML(array('class'=>'forum-edit',))?>


<p class='smaller-text'><em>
<?php if($forum['created']): ?>
  Denna tråd var skapad <?=$forum['owner']?> <?=time_diff($forum['created'])?> ago.
<?php else: ?>
  Tråd inte skapat Ã¤n.
<?php endif; ?>

<?php if(isset($forum['updated'])):?>
  Senast uppdaterat <?=time_diff($forum['updated'])?> ago.
<?php endif; ?>
</em></p>
</div>
</div>



