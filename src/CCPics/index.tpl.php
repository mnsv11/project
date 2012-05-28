<script src="http://www.student.bth.se/~mnsv11/project/site/src/CCMycontroller/js/jquery-1.7.2.min.js"></script>
<script src="http://www.student.bth.se/~mnsv11/project/site/src/CCMycontroller/js/lightbox.js"></script>
<link href="http://www.student.bth.se/~mnsv11/project/site/src/CCMycontroller/css/lightbox.css" rel="stylesheet" />


<fieldset style="width:650px;margin-left:50px;">
<table style="width:650px;">

<?php foreach($pictures as $val):?>



<tr style="float:left;">
<td style="padding-left:50px;">
<h3 style="width: 200px;margin-bottom:5px;"><?=$val['comments']?></h3>
<a  href=<?=$picParth . $val['name']?> rel="lightbox" title="<?=$val['data']?>"><img  style="width: 200px;" src=<?=$picParth . $val['nameSmall']?> alt=""></a>
</td>
</tr>


<?php endforeach; ?>

</table>
</fieldset>


<?php if($usercheck['groups'][0]['idGroups'] == "1"):?>
<p style="padding-left:70px;"><a href='<?=create_url("pics/addPics")?>'>Lägg till bild</a>.</p>
<?php endif;?>

