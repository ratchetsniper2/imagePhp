<div class="panel panel-default">

	<div class="panel-heading">
		<a class="btn btn-default" href="index.php?controller=photo&action=prevAction&imgId=<?= $data["imgId"] ?>&size=<?= $data["imgSize"] ?>&category=<?= urlencode($data["selectedCategory"]) ?>"><i class="fa fa-arrow-left" aria-hidden="true"></i> Prev</a>
		<a class="btn btn-default" href="index.php?controller=photo&action=nextAction&imgId=<?= $data["imgId"] ?>&size=<?= $data["imgSize"] ?>&category=<?= urlencode($data["selectedCategory"]) ?>">Next <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
		<a class="btn btn-default center like" id="<?php echo $data["imgId"]; ?>" onclick="likeImg(this, <?php echo $data["imgId"]; ?>)" style="cursor: pointer;"><i class="fa fa-heart" aria-hidden="true"></i></a>
		<span id="categories" class="dropdown pull-right">
			<button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
				Categorie : <span class=""><?= $data["selectedCategory"] ?: "Toutes" ?></span>
				<span class="caret"></span>
			</button>
			<ul class="dropdown-menu">
				<?php if ($data["selectedCategory"] != null){ ?>
					<li><a href="index.php?controller=photo&action=categoryAction&imgId=<?= $data["imgId"] ?>&size=<?= $data["imgSize"] ?>">Toutes</a></li>
					<?php
				}
				foreach ($data["availableCategories"] as $item){
					?>
					<li><a href="index.php?controller=photo&action=categoryAction&imgId=<?= $data["imgId"] ?>&size=<?= $data["imgSize"] ?>&category=<?= urlencode($item) ?>"><?= $item ?></a></li>
				<?php } ?>
			</ul>
		</span>
	</div>

	<div class="panel-body">
		<p>Category : <?= $data["imgCategory"] ?></p>
		<a href="index.php?controller=photo&action=zoomAction&zoom=1.25&imgId=<?= $data["imgId"] ?>&size=<?= $data["imgSize"] ?>&category=<?= urlencode($data["selectedCategory"]) ?>">
			<img src="<?= $data["imgUrl"] ?>" width="<?= $data["imgSize"] ?>">
		</a>
		<p>Comment : <?= $data["imgComment"] ?></p>
	</div>

	<script type="text/javascript">
	$(function() {
		console.log($('.like').prop('id'));
		if ($.cookie('likedImg') != undefined) {
			if ($.inArray($('.like').attr('id'),$.cookie('like'))) {
				//déja like
				$('.like').prop("disabled", true);
			} else {
				//pas déja like
			}
		} else {
			//pas de cookie
		}
	});

	function likeImg(elem, id) {
		$.post( "controller/ajax.like.php",
		{data: id},
		function(data) {
			if (data == 0) {
				console.log(data);
				if ($.cookie('likedImg') != undefined) {
					$.cookie('likedImg', [id], { expires: 365});
				} else {
					$.cookie('likedImg', $.cookie('likedImg').push(id), {expires: 365});
				}
				$(elem).prop("disabled", true);
			} else {
				console.log(data);
				console.log('Erreur Ajax');
			}

		});
	}
	</script>

</div>
