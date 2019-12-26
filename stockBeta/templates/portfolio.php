<div class="container">
<div class="row"><div class= "col-md-2">
<span style="background-color:yellow">
<?= "welcome!"." ".$user ; ?></span>
</br></div></div>
</div><br>
<div>
<?php include("list.php") ?>
<table class="table table-striped"> 
<thead>
<tr>
<th>Symbol</th>
<th>Name</th>
<th>Shares</th>
<th>Price</th>
<th>Total</th>
</td></thead>
<tbody>
<tr>
<?php foreach($w as $position) : ?>

<th>
<?= $position["symbol"] ?>
</th><th>
<?= $position["nam"] ?>
</th><th>
<?= $position["shares"] ?>
</th><th>
<?= $position["pric"] ?>
</th><th>
<?= $position["total"] ?>
</th></tr>
<?php endforeach ?>


<tr>
<th><b>Cash</b></th>
<th></th>
<th></th><th></th>
<th> <?= number_format($bring,2 )?></th>
</tr>
</tbody>
</table
</div>
<div>
    <a href="logout.php">Log Out</a>
</div>
