<div class="panel panel-default">

	<div class="panel-heading">
		<a class="btn btn-default" href="index.php?controller=photo&action=prevAction&imgId=<?= $data["imgId"] ?>&size=<?= $data["imgSize"] ?>"><i class="fa fa-arrow-left" aria-hidden="true"></i> Prev</a>
		<a class="btn btn-default" href="index.php?controller=photo&action=nextAction&imgId=<?= $data["imgId"] ?>&size=<?= $data["imgSize"] ?>">Next <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
	</div>

	<div class="panel-body row">
		<?php foreach ($data["img"] as $img) { ?>
			<div class="col-md-4">
				<a class="thumbnail" href="index.php?controller=photo&action=zoomAction&zoom=1.25&imgId=<?= $img["imgId"] ?>">
					<img src="<?php echo $img["imgUrl"]; ?>">
				</a>
			</div>
		<?php } ?>
	</div>

</div>
