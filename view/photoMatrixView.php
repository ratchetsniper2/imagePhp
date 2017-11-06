<div class="panel panel-default">

	<div class="panel-heading">
		<a class="btn btn-default" href="index.php?controller=photoMatrix&action=prevAction&imgId=<?php echo $data["img"][0]["imgId"]; ?>&nbImg=<?php echo $_GET["nbImg"]; ?>"><i class="fa fa-arrow-left" aria-hidden="true"></i> Prev</a>
		<a class="btn btn-default" href="index.php?controller=photoMatrix&action=nextAction&imgId=<?php echo $data["img"][0]["imgId"]; ?>&nbImg=<?php echo $_GET["nbImg"]; ?>">Next <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
	</div>

	<div class="panel-body row">
		<?php foreach ($data["img"] as $img) { ?>
			<div class="col-md-4 heightEqual">
				<a class="thumbnail" href="index.php?controller=photo&action=zoomAction&zoom=1.25&imgId=<?php echo $img["imgId"]; ?>">
					<img src="<?php echo $img["imgUrl"]; ?>">
				</a>
			</div>
		<?php } ?>
	</div>
	<script type="text/javascript">
	$(function() {
		$('.heightEqual').matchHeight();
	});
	</script>

</div>
