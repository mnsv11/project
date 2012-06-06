<div style="margin-left:300px;">
<h1>Login</h1>
<p style="width:300px;">Login using your acronym or email.</p>
<?=$login_form->GetHTML('form')?>
  <fieldset>
    <?=$login_form['acronym']->GetHTML()?>
    <?=$login_form['password']->GetHTML()?>  
    <?=$login_form['login']->GetHTML()?>
    <?php if($allow_create_user) : ?>
    <?php endif; ?>
  </fieldset>
</form>
</div>
