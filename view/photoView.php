<p>
	<a href="index.php?controller=photo&action=prevAction&imgId=<?= $data["imgId"] ?>&size=<?= $data["imgSize"] ?>">Prev</a>
	<a href="index.php?controller=photo&action=nextAction&imgId=<?= $data["imgId"] ?>&size=<?= $data["imgSize"] ?>">Next</a>
</p>

<p>Category : <?= $data["imgCategory"] ?></p>
	<a href="index.php?controller=photo&action=nextAction&zoom=1.25&imgId=<?= $data["imgId"] ?>&size=<?= $data["imgSize"] ?>">
	<img src="<?= $data["imgUrl"] ?>" width="<?= $data["imgSize"] ?>">
</a>

<p>Comment : <?= $data["imgComment"] ?></p>