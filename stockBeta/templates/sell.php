<div>
<form  action ="../sell.php" method="GET">
<div>
<?php include("list.php") ?>
<select name="symbol">
<?php foreach($select as $sel) :?>
<option value ="<?= $sel["symbol"] ?>"><?= $sel["symbol"]?></option>
<?php endforeach ?>
</select><br>
<br><br>
<input type="submit" value="sell" name="submit">
</form>

</div>
