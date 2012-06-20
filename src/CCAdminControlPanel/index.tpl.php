<div id=insidePrime>
<div id=admin>
<?php if($usercheck['groups'][0]['idGroups'] == "1"):?>
<h3>Admin Control Panel Index</h3>
<P><input style="border-radius: 10px;width:150px;" type="button" value="Skapa användare" onClick="top.location='<?=create_url("user/create")?>'"></P>
<P><input style="border-radius: 10px;width:150px;" type="button" value="Ta bort användare" onClick="top.location='<?=create_url("user/remove")?>'"></P>
<P><input style="border-radius: 10px;width:150px;" type="button" value="Visa användare" onClick="top.location='<?=create_url("user/getUsers")?>'"></P>
<?php else:?>
<h3>Du har inte behörighet för denna sidan</h3>
<?php endif;?>
</div>
</div>
