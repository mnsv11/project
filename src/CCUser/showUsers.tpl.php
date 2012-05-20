<?php if($usercheck['groups'][0]['idGroups'] == "1"):?>
<table>
   <thead>
   	<th>Användare</th>
      <tr>
         <th>Acronym</th>
         <th>Namn</th>
         <th>Email</th>
      </tr>
   </thead>

<?php foreach($users as $val):?>

      <tr>
 <td id=tdmain><?=$val['acronym'];?></td>
 <td id=tdmain><?=$val['name'];?></td>
 <td id=tdmain><?=$val['email'];?></td>
      </tr>
<br>
<?php endforeach;?>

</table>
<?php else:?>
<h3>Du har inte behörighet för denna sidan</h3>
<?php endif;?>
