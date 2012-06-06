
<table id=userg>
   <thead>
   	<th>Användare</th>
      <tr>
      <th style="width:15%">Acronym</th>
         <th style="width:40%">Namn</th>
         <th style="width:30%">Email</th>
         <th style="width:15%">Grupp</th>
      </tr>
   </thead>

<?php foreach($users as $val):?>

      <tr>
 <td><?=$val['acronym'];?></td>
 <td><?=$val['name'];?></td>
 <td ><?=$val['email'];?></td>
 
 <?php foreach($userGroup as $val2):?>

 	<?php if($val['id'] == $val2['idUser']):?>
	 
		<?php if($val2['idGroups'] == 1):?>
			<td>Admin</td>
		 <?php endif;?>
		 <?php if($val2['idGroups'] == 2):?>
		 	<td>User</td>
		 <?php endif;?>
	 <?php endif;?>
	 
<?php endforeach;?>	 
      </tr>

<?php endforeach;?>

</table>


