<h1>Guestbook Example</h1>
<p>Showing off how to implement a guestbook in Lydia. Now saving to database.</p>

<form action="<?=$formAction?>" method='post'>
  <p>
    <label>Message: <br/>
    <textarea name='newEntry'></textarea></label>
  </p>
  <p>
    <input type='submit' name='doAdd' value='Add message' />
    <input type='submit' name='doClear' value='Clear all messages' />
  </p>
</form>

<h2>Current messages</h2>

<?php foreach($entries as $val):?>
<div id=guestbookSquare>
  <p>At: <?=$val['created']?></p>
  <p><?=htmlent($val['entry'])?></p>
</div>
<?php endforeach;?>
