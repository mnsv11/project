<?php if($usercheck['groups'][0]['idGroups'] == "1"):?>
<h3>Admin Control Panel Index</h3>
<p><a href='<?=create_url("user/create")?>'>Skapa användare</a></p>
<p><a href='<?=create_url("user/remove")?>'>Ta bort användare</a></p>
<p><a href='<?=create_url("user/getUsers")?>'>Visa användare</a></p>
<?php else:?>
<h3>Du har inte behörighet för denna sidan</h3>
<?php endif;?>

