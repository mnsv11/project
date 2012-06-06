<script src="site/src/CCMycontroller/js/jquery-1.7.2.min.js"></script>
<script src="site/src/CCMycontroller/js/lightbox.js"></script>
<link href="site/src/CCMycontroller/css/lightbox.css" rel="stylesheet" />


<fieldset style="width:900px;margin-left:200px;">
<table style="width:900px;">

<?php foreach($pictures as $val):?>



<tr id=picture>
<td>
<h3 style="width: 200px;margin-bottom:5px;padding-top:20px;"><?=$val['comments']?></h3>
<a  href="site/themes/mytheme/<?=$val['name']?>" rel="lightbox" title="<?=$val['data']?>"><img  style="height:130px; width: 200px;" src="site/themes/mytheme/<?=$val['name']?>" alt=""></a>
<?=$val['sub']?>
</td>
</tr>


<?php endforeach; ?>

</table>
</fieldset>


<?php if($usercheck['groups'][0]['idGroups'] == "1"):?>
<p style="margin-left:100px;padding-left:70px;"><a href='<?=create_url("pics/addPics")?>'>Lägg till bild</a>
<a href='<?=create_url("pics/removePics")?>'>Tabort bild</a></p>
<?php endif;?>

