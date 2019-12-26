<div>
<?php include("list.php")?>
<table class="table table-striped">
<thead>
<td>
<th>Symbol</th>
<th>Share</th>
<th>Type</th>
<th>Time</th>
</td></thead>
<tbody>
<tr>
<?php foreach($rows as $row) :?>
<th></th>
<th><?=$row["symbol"] ?></th>
<th><?=$row["share"] ?></th>
<th><?=$row["action"] ?></th>
<th><?=$row["time"] ?></th>
</tr>
<?php endforeach ?>
</tbody>
</table>
</div>
