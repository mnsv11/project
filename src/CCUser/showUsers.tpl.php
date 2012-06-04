
<table id=userg>
   <thead>
   	<th>Användare</th>
      <tr>
         <th id=userg>Acronym</th>
         <th id=userg>Namn</th>
         <th id=userg>Email</th>
         <th id=userg>Användar grupp</th>
      </tr>
   </thead>

<?php foreach($users as $val):?>

      <tr>
 <td id=userg><?=$val['acronym'];?></td>
 <td id=userg><?=$val['name'];?></td>
 <td id=userg><?=$val['email'];?></td>
 
 <?php foreach($userGroup as $val2):?>

 	<?php if($val['id'] == $val2['idUser']):?>
	 
		<?php if($val2['idGroups'] == 1):?>
			<td id=userg>Admin</td>
		 <?php endif;?>
		 <?php if($val2['idGroups'] == 2):?>
		 	<td id=userg>User</td>
		 <?php endif;?>
	 <?php endif;?>
	 
<?php endforeach;?>	 
      </tr>

<?php endforeach;?>

</table>


