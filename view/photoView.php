<div class="panel panel-default">

	<div class="panel-heading">
		<a class="btn btn-default" href="index.php?controller=photo&action=nextAction&imgId=<?= $data["prevImgId"] ?>&size=<?= $data["imgSize"] ?>"><i class="fa fa-arrow-left" aria-hidden="true"></i> Prev</a>
		<a class="btn btn-default" href="index.php?controller=photo&action=nextAction&imgId=<?= $data["nextImgId"] ?>&size=<?= $data["imgSize"] ?>">Next <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
	</div>

	<div class="panel-body">
		<p>Category : <?= $data["imgCategory"] ?></p>
		<a href="index.php?controller=photo&action=nextAction&zoom=1.25&imgId=<?= $data["imgId"] ?>&size=<?= $data["imgSize"] ?>">
			<img src="<?= $data["imgUrl"] ?>" width="<?= $data["imgSize"] ?>">
		</a>
		<p>Comment : <?= $data["imgComment"] ?></p>
	</div>

</div>
